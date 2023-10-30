<?php

use Dotenv\Dotenv;

include 'vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable('./')->load();

class ConexaoBD {

    private string $host;
    private string $schema;
    private string $user;
    private string $password;
    private mysqli|false $conexao;

    public function __construct() {
        $this->host = getenv('DATABASE_URL');
        $this->schema = getenv('DATABASE_SCHEMA');
        $this->user = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');

        $this->conexao = mysqli_connect($this->host, $this->user, $this->password);
        mysqli_select_db($this->conexao, $this->schema);
    }

    public function getConexao(): false|mysqli
    {
        return $this->conexao;
    }
}