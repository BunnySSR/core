<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Util\Api\Getter as ApiGetter;

$api = new ApiGetter();
echo '<pre>';

echo '# Test with string';
echo PHP_EOL;
print_r($api->load('https://raw.githubusercontent.com/boxsnake-php/simple-api-ssr/master/example/new.json'));
echo PHP_EOL . str_repeat('-', 80) . PHP_EOL;

echo '# Test with invalid config';
echo PHP_EOL;
print_r($api->load([
    'https://raw.githubusercontent.com/boxsnake-php/simple-api-ssr/master/example/new.json'
]));
echo PHP_EOL . str_repeat('-', 80) . PHP_EOL;

echo '# Test config without url';
echo PHP_EOL;
print_r($api->load([
    '_old' => [],
    '_new' => [
        'url' => 'https://raw.githubusercontent.com/boxsnake-php/simple-api-ssr/master/example/new.json'
    ]
]));
echo PHP_EOL . str_repeat('-', 80) . PHP_EOL;

echo '# Test config with bad json';
echo PHP_EOL;
print_r($api->load([
    '_new' => [
        'url' => 'https://raw.githubusercontent.com/boxsnake-php/simple-api-ssr/master/example/new.json'
    ],
    '_bad' => [
        'url' => 'https://raw.githubusercontent.com/boxsnake-php/simple-api-ssr/master/example/bad.json'
    ]
]));
echo PHP_EOL . str_repeat('-', 80) . PHP_EOL;

echo '</pre>';
