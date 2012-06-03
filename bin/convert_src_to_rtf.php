<?php

/**
 * Convert the src/ directory to .rft files highlighted by 'highlight'
 */

define('SOURCE_DIR', './src/');
$ALLOWED_EXTENSIONS = array(
    'inc',
    'php'
);

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(SOURCE_DIR),
    RecursiveIteratorIterator::CHILD_FIRST
);
foreach ($iterator as $path) {
    $filePath = (string)$path;
    $ext = array_pop(explode('.', $filePath));
    if (!in_array($ext, $ALLOWED_EXTENSIONS)) {
        continue;
    }

    $command = "/usr/local/bin/highlight -s moe -S php -O rtf -k \"Consolas\" -K 36 $filePath > $filePath.rtf";
    echo $command . PHP_EOL;
    exec($command);
}