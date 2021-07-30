<?php
use Monolog\Logger as MonologLogger;

$url = parse_url('mysql://b505b21199e632:634eb2a3@us-cdbr-east-04.cleardb.com/heroku_534a038bf628016');
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

return [
    'database' => [
        'name' => $db,
        'username' => $username,
        'password' => $password,
        'connection' => 'mysql:host='.$server,
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
