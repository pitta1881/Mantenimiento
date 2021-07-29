<?php
use Monolog\Logger as MonologLogger;

$url = parse_url('mysql://b505b21199e632:634eb2a3@us-cdbr-east-04.cleardb.com/heroku_534a038bf628016');

return [
    'database' => [
        'name' => 'heroku_534a038bf628016',
        'username' => 'b505b21199e632',
        'password' => '634eb2a3',
        'connection' => 'us-cdbr-east-04.cleardb.com',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'logger' => [
        'level' => MonologLogger::INFO
    ],
    'twig' => [
        'templates_dir' => __DIR__ . '/app/views',
        'templates_cache_dir' => __DIR__ . '/app/views/cache'
    ]
];
