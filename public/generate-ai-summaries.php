<?php
/**
 * Script to generate AI summaries for published articles
 * Run once and delete after use
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;
use App\Services\EmbeddingsService;

echo "<h1>Generando Resúmenes IA para Artículos</h1>";
echo "<pre>";

$embeddings = app(EmbeddingsService::class);

// Get published articles without AI summary
$articles = Article::published()
    ->whereNull('ai_summary')
    ->orWhere('ai_summary', '')
    ->get();

echo "Artículos sin resumen: " . $articles->count() . "\n\n";

foreach ($articles as $article) {
    echo "Procesando: {$article->title}\n";

    try {
        $summary = $embeddings->generateSummary($article);

        $article->ai_summary = $summary;
        $article->save();

        echo "✓ Resumen generado:\n{$summary}\n\n";
    } catch (Exception $e) {
        echo "✗ Error: " . $e->getMessage() . "\n\n";
    }

    // Small delay to avoid rate limits
    usleep(500000); // 0.5 seconds
}

echo "\n¡Listo! Resúmenes generados.\n";
echo "IMPORTANTE: Elimina este archivo después de usarlo.\n";
echo "</pre>";
