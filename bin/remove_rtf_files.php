<?php

/**
 * Convert the src/ directory to .rft files highlighted by 'highlight'
 */

define('SOURCE_DIR', './src/');
$ALLOWED_EXTENSIONS = array(
    'rtf'
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

    echo "Removing: $filePath" . PHP_EOL;
    unlink($filePath);
}