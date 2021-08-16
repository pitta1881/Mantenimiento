<?php
use Monolog\Logger as MonologLogger;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'database' => [
        'name' => $_ENV['DBNAME'],
        'username' => $_ENV['DBUSER'],
        'password' => $_ENV['DBPASSWORD'],
        'connection' => $_ENV['DBCONNECTION'],
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
