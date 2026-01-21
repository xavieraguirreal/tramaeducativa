<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Article;
use Exception;

class EmbeddingsService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://api.openai.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->model = config('services.openai.embedding_model', 'text-embedding-3-small');
    }

    /**
     * Genera embedding para un texto
     */
    public function generateEmbedding(string $text): array
    {
        $text = $this->prepareText($text);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->timeout(30)->post($this->baseUrl . '/embeddings', [
            'model' => $this->model,
            'input' => $text,
            'encoding_format' => 'float',
        ]);

        if (!$response->successful()) {
            throw new Exception("Error OpenAI Embeddings: " . $response->body());
        }

        $result = $response->json();

        return [
            'embedding' => $result['data'][0]['embedding'],
            'tokens' => $result['usage']['total_tokens'] ?? 0,
        ];
    }

    /**
     * Genera embedding para un articulo
     */
    public function generateArticleEmbedding(Article $article): array
    {
        $text = $this->prepareArticleText($article);
        return $this->generateEmbedding($text);
    }

    /**
     * Calcula similitud de coseno entre dos embeddings
     */
    public static function cosineSimilarity(array $a, array $b): float
    {
        if (count($a) !== count($b)) {
            throw new Exception("Los embeddings deben tener la misma dimension");
        }

        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        for ($i = 0; $i < count($a); $i++) {
            $dotProduct += $a[$i] * $b[$i];
            $normA += $a[$i] * $a[$i];
            $normB += $b[$i] * $b[$i];
        }

        $normA = sqrt($normA);
        $normB = sqrt($normB);

        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dotProduct / ($normA * $normB);
    }

    /**
     * Busqueda semantica de articulos
     */
    public function searchArticles(string $query, int $limit = 10, float $threshold = 0.3): array
    {
        // Buscar en cache
        $cacheKey = 'semantic_search_' . md5($query);
        $cached = Cache::get($cacheKey);

        if ($cached) {
            return array_merge($cached, ['cached' => true]);
        }

        // Generar embedding de la query
        $queryResult = $this->generateEmbedding($query);
        $queryEmbedding = $queryResult['embedding'];

        // Obtener articulos con embeddings
        $articles = Article::published()
            ->whereNotNull('embedding')
            ->with(['category', 'author'])
            ->get();

        if ($articles->isEmpty()) {
            return [
                'results' => [],
                'total' => 0,
                'tokens' => $queryResult['tokens'],
                'cached' => false,
            ];
        }

        // Calcular similitud con cada articulo
        $results = [];
        foreach ($articles as $article) {
            $articleEmbedding = json_decode($article->embedding, true);
            $similarity = self::cosineSimilarity($queryEmbedding, $articleEmbedding);

            if ($similarity >= $threshold) {
                $results[] = [
                    'article' => $article,
                    'similarity' => round($similarity, 4),
                    'similarity_percent' => round($similarity * 100, 1) . '%',
                ];
            }
        }

        // Ordenar por similitud
        usort($results, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        // Limitar
        $results = array_slice($results, 0, $limit);

        $response = [
            'results' => $results,
            'total' => count($results),
            'tokens' => $queryResult['tokens'],
            'cached' => false,
        ];

        // Guardar en cache por 1 hora
        Cache::put($cacheKey, $response, 3600);

        return $response;
    }

    /**
     * Encuentra articulos relacionados usando embeddings (sin llamada a API)
     */
    public function findRelatedArticles(Article $article, int $limit = 3): array
    {
        // Si el articulo no tiene embedding, retornar vacio
        if (!$article->embedding) {
            return [];
        }

        $cacheKey = 'related_articles_' . $article->id;
        $cached = Cache::get($cacheKey);

        if ($cached) {
            return $cached;
        }

        $articleEmbedding = json_decode($article->embedding, true);

        // Obtener otros articulos con embeddings
        $otherArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->whereNotNull('embedding')
            ->with(['category', 'author'])
            ->get();

        if ($otherArticles->isEmpty()) {
            return [];
        }

        // Calcular similitud
        $results = [];
        foreach ($otherArticles as $other) {
            $otherEmbedding = json_decode($other->embedding, true);
            $similarity = self::cosineSimilarity($articleEmbedding, $otherEmbedding);

            $results[] = [
                'article' => $other,
                'similarity' => $similarity,
                'similarity_percent' => round($similarity * 100, 1) . '%',
            ];
        }

        // Ordenar por similitud
        usort($results, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        // Limitar
        $results = array_slice($results, 0, $limit);

        // Cache por 24 horas
        Cache::put($cacheKey, $results, 86400);

        return $results;
    }

    /**
     * Prepara el texto del articulo para embedding
     */
    protected function prepareArticleText(Article $article): string
    {
        $parts = [];

        $parts[] = "Titulo: " . $article->title;

        if ($article->category) {
            $parts[] = "Categoria: " . $article->category->name;
        }

        if ($article->tags && $article->tags->count() > 0) {
            $parts[] = "Tags: " . $article->tags->pluck('name')->implode(', ');
        }

        if ($article->excerpt) {
            $parts[] = "Resumen: " . $article->excerpt;
        }

        if ($article->body) {
            $parts[] = "Contenido: " . strip_tags($article->body);
        }

        return implode("\n\n", $parts);
    }

    /**
     * Prepara texto limpiando HTML y espacios
     */
    protected function prepareText(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);

        // Truncar a ~6000 palabras
        $words = explode(' ', $text);
        if (count($words) > 6000) {
            $words = array_slice($words, 0, 6000);
            $text = implode(' ', $words);
        }

        return trim($text);
    }
}
