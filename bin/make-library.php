<?php
include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';

if (empty($argv[1])) {
    exit("Usage: {$_ENV['_']} {$argv[0]} [LibrarySrcDir]" . PHP_EOL);
}

try {
    $builder = new SwooleLibrary\Builder($argv[1]);
    $builder->make();
} catch (\SwooleLibrary\Exception $e) {
    swoole_error($e->getMessage());
}
