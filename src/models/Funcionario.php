<?php

require_once 'src/models/Cargo.php';

class Funcionario {
    private int $matricula;
    private string $nome;
    private string $sobrenome;
    private string $nascimento;
    private float $salario;
    private string $cargo;
    private int $cargoId;


    public function getMatricula(): int {
        return $this->matricula;
    }

    public function setMatricula(int $matricula): void {
        $this->matricula = $matricula;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getSobrenome(): string {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): void {
        $this->sobrenome = $sobrenome;
    }

    public function getNascimento(): string {
        return $this->nascimento;
    }

    public function setNascimento(string $nascimento): void {
        $this->nascimento = $nascimento;
    }

    public function getSalario(): float {
        return $this->salario;
    }

    public function setSalario(float $salario): void {
        $this->salario = $salario;
    }

    public function getCargo(): string {
        return $this->cargo;
    }

    public function setCargo(string $cargo): void {
        $this->cargo = $cargo;
    }

    public function getCargoId(): int {
        return $this->cargoId;
    }

    public function setCargoId(int $cargoId): void {
        $this->cargoId = $cargoId;
    }

}