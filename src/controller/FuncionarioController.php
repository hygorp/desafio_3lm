<?php

include 'src/dao/FuncionarioDAO.php';

class FuncionarioController {

    private FuncionarioDAO $funcionarioDAO;


    public function __construct() {
        $this->funcionarioDAO = new FuncionarioDAO();
    }

    public function listarFuncionarios() : array {
        return $this->funcionarioDAO->listarFuncionarios();
    }

    public function inserirFuncionario(Funcionario $funcionario) : bool {
        return $this->funcionarioDAO->inserirFuncionario($funcionario);
    }

    public function alterarFuncionario(Funcionario $funcionario, int $matricula) : bool {
        return $this->funcionarioDAO->alterarFuncionario($funcionario, $matricula);
    }

    public function deletarFuncionario(int $matricula) : bool {
        return $this->funcionarioDAO->deletarFuncionario($matricula);
    }

}