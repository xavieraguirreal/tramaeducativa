<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<pre>";
echo "Limpiando cache...\n\n";

$kernel->call('config:clear');
echo "config:clear - OK\n";

$kernel->call('cache:clear');
echo "cache:clear - OK\n";

$kernel->call('route:clear');
echo "route:clear - OK\n";

$kernel->call('view:clear');
echo "view:clear - OK\n";

echo "\n✓ Cache limpiada!\n";
echo "\nAhora borra este archivo del servidor.";
