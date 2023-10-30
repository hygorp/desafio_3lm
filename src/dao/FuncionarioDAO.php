<?php

require_once 'src/config/ConexaoBD.php';

class FuncionarioDAO {
    private ConexaoBD $conexao;

    public function __construct() {
        $this->conexao = new ConexaoBD();
    }

    public function listarFuncionarios() : array {
        $sql = "SELECT f.matricula, f.nome, f.sobrenome, f.nascimento, f.salario, c.id, c.titulo, c.descricao
                        FROM funcionario f
                        JOIN cargo c ON f.cargo_id = c.id ORDER BY f.matricula";

        $result = mysqli_query($this->conexao->getConexao(), $sql);

        if ($result) {
            $funcionarios = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $funcionario = new Funcionario();
                $funcionario->setMatricula($row['matricula']);
                $funcionario->setNome($row['nome']);
                $funcionario->setSobrenome($row['sobrenome']);
                $funcionario->setNascimento($row['nascimento']);
                $funcionario->setSalario($row['salario']);
                $funcionario->setCargo($row['titulo']);
                $funcionario->setCargoId($row['id']);
                $funcionarios[] = $funcionario;
            }
            return $funcionarios;
        } else {
            throw new RuntimeException("Erro ao listar Funcionarios");
        }
    }

    public function inserirFuncionario(Funcionario $funcionario) : bool {
        $sql = "INSERT INTO funcionario (nome, sobrenome, nascimento, salario, cargo_id) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);
            if ($stmt) {
                $nomeParam = $funcionario->getNome();
                $sobrenomeParam = $funcionario->getSobrenome();
                $nascimentoParam = $funcionario->getNascimento();
                $salarioParam = $funcionario->getSalario();
                $cargoIdParam = $funcionario->getCargoId();
                mysqli_stmt_bind_param($stmt, "ssssi", $nomeParam, $sobrenomeParam, $nascimentoParam, $salarioParam, $cargoIdParam  );
                $resultado = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($resultado) {
                    return true;
                } else {
                    throw new RuntimeException("Erro ao inserir o Funcionario.");
                }
            } else {
                throw new RuntimeException("Erro ao preparar.");
            }
        } catch (RuntimeException $exception) {
            echo $exception;
            return false;
        }
    }

    public function alterarFuncionario(Funcionario $funcionario, int $matricula) : bool {
        $sql = "UPDATE funcionario SET 
                       nome = ?, 
                       sobrenome = ?,
                       cargo_id = ?,
                       nascimento = ?,
                       salario = ? 
                   WHERE matricula = ?";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);

            if($stmt) {
                $nomeParam = $funcionario->getNome();
                $sobrenomeParam = $funcionario->getSobrenome();
                $cargoIdParam = $funcionario->getCargoId();
                $nascimentoParam = $funcionario->getNascimento();
                $salarioParam = $funcionario->getSalario();
                mysqli_stmt_bind_param($stmt, "ssisss", $nomeParam, $sobrenomeParam, $cargoIdParam, $nascimentoParam, $salarioParam, $matricula);
                $resultado = mysqli_stmt_execute($stmt);

                if($resultado) {
                    return true;
                }else {
                    throw new RuntimeException("Erro ao alterar Funcionario.");
                }
            }else {
                throw new RuntimeException("Erro ao preparar.");
            }
        }catch(RuntimeException $exception) {
            echo $exception;
            return false;
        }
    }

    public function deletarFuncionario(int $matricula) : bool {
        $sql = "DELETE FROM funcionario WHERE matricula = ?";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);

            if($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $matricula);
                $resultado = mysqli_stmt_execute($stmt);

                if($resultado) {
                    return true;
                }else {
                    throw new RuntimeException("Erro ao deletar Funcionario.");
                }
            }else {
                throw new RuntimeException("Erro ao preparar");
            }
        }catch(RuntimeException $exception) {
            echo $exception;
            return false;
        }
    }

}