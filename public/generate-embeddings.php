<?php
/**
 * Genera embeddings para articulos
 * BORRAR DESPUES DE USAR
 */

set_time_limit(300); // 5 minutos max

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;
use App\Services\EmbeddingsService;

echo "<pre style='font-family: monospace; padding: 20px;'>";
echo "===========================================\n";
echo "Generando Embeddings para Articulos\n";
echo "===========================================\n\n";

try {
    $apiKey = config('services.openai.api_key');
    if (empty($apiKey)) {
        throw new Exception("OPENAI_API_KEY no configurada en .env");
    }
    echo "✓ API Key configurada\n\n";

    $embeddings = new EmbeddingsService();

    $articles = Article::published()
        ->whereNull('embedding')
        ->get();

    $total = $articles->count();

    if ($total === 0) {
        echo "No hay articulos sin embedding.\n";
        echo "Todos los articulos ya tienen embeddings generados.\n";
        exit;
    }

    echo "Procesando {$total} articulos...\n\n";

    $success = 0;
    $errors = 0;
    $totalTokens = 0;

    foreach ($articles as $index => $article) {
        $num = $index + 1;
        echo "[{$num}/{$total}] {$article->title}... ";

        try {
            $contentHash = hash('sha256', $article->title . $article->body . $article->excerpt);
            $result = $embeddings->generateArticleEmbedding($article);

            $article->update([
                'embedding' => json_encode($result['embedding']),
                'embedding_hash' => $contentHash,
            ]);

            $totalTokens += $result['tokens'];
            $success++;
            echo "OK ({$result['tokens']} tokens)\n";

        } catch (Exception $e) {
            $errors++;
            echo "ERROR: " . $e->getMessage() . "\n";
        }

        // Pausa para no exceder rate limits
        usleep(200000); // 200ms
        flush();
    }

    echo "\n===========================================\n";
    echo "Completado!\n";
    echo "- Exitosos: {$success}\n";
    echo "- Errores: {$errors}\n";
    echo "- Tokens usados: {$totalTokens}\n";
    echo "===========================================\n";
    echo "\n⚠️  BORRA ESTE ARCHIVO DEL SERVIDOR\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "</pre>";
