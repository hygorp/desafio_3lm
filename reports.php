<?php

require_once 'vendor/autoload.php';

use PHPJasper\PHPJasper;

$input = __DIR__ . '/reports/templates/relatorio_funcionarios.jasper';
$output = __DIR__ . '/reports/output';
$options = [
    'format' => ['pdf'],
    'locale' => 'pt_BR',
    'params' => [],
    'db_connection' => [
        'driver' => 'mysql',
        'username' => getenv('DATABASE_USER'),
        'password' => getenv('DATABASE_PASSWORD'),
        'host' => getenv('DATABASE_URL'),
        'database' => getenv('DATABASE_SCHEMA'),
        'port' => '3306',
        'jdbc_driver' => 'com.mysql.jdbc.Driver',
        'jdbc_dir' => 'vendor/geekcom/phpjasper/bin/jasperstarter/jdbc'
    ]
];

$jasper = new PHPJasper();

$jasper->process(
    $input,
    $output,
    $options
)->execute();