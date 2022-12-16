#!/usr/bin/env php
<?php
$possibleFiles = [
    dirname(__DIR__) . '/vendor/autoload.php',
    dirname(__DIR__) . '/../../autoload.php',
    dirname(__DIR__) . '/../autoload.php',
];
$file = null;
foreach ($possibleFiles as $possibleFile) {
    if (file_exists($possibleFile)) {
        $file = $possibleFile;
        break;
    }
}

if (null === $file) {
    throw new RuntimeException('Unable to locate autoload.php file.');
}

require_once $file;

if (empty($argv[1])) {
    $_ = $_ENV['_'] == $argv[0] ? $argv[0] : "{$_ENV['_']} {$argv[0]}";
    exit("Usage: $_ [LibrarySrcDir]" . PHP_EOL);
}

try {
    $builder = new SwooleLibrary\Builder($argv[1]);
    $builder->make();
} catch (\SwooleLibrary\Exception $e) {
    swoole_error($e->getMessage());
}
