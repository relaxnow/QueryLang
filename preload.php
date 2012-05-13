<?php

// Find all PHP files in ./src/
$files = new RegexIterator(
    new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(__DIR__ . '/src/')
    ),
    '/^.+\.php$/i',
    RecursiveRegexIterator::GET_MATCH
);

// and require them
foreach ($files as $file) {
    $file = $file[0];
    echo "Preloading: $file" . PHP_EOL;
    require $file;
}
