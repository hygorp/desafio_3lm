<?php

require_once 'src/config/ConexaoBD.php';

class CargoDAO {

    private ConexaoBD $conexao;

    public function __construct() {
        $this->conexao = new ConexaoBD();
    }

    public function listarCargos() : array {
        $sql = "SELECT * FROM cargo";

        $result = mysqli_query($this->conexao->getConexao(), $sql);

        if ($result) {
            $cargos = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cargo = new Cargo();
                $cargo->setId($row['id']);
                $cargo->setTitulo($row['titulo']);
                $cargo->setDescricao($row['descricao']);
                $cargos[] = $cargo;
            }
            return $cargos;
        } else {
            throw new RuntimeException("Erro ao listar cargos");
        }
    }

    public function listarCargoPorId(int $id) : array {
        $sql = "SELECT * FROM cargo WHERE id = {$id}";

        $result = mysqli_query($this->conexao->getConexao(), $sql);

        if ($result) {
            $cargos = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cargo = new Cargo();
                $cargo->setId($row['id']);
                $cargo->setTitulo($row['titulo']);
                $cargo->setDescricao($row['descricao']);
                $cargos[] = $cargo;
            }
            return $cargos;
        } else {
            throw new RuntimeException("Erro ao listar cargos");
        }
    }

    public function inserirCargo(Cargo $cargo) : bool {
        $sql = "INSERT INTO cargo (titulo, descricao) VALUES (?, ?)";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);
            if ($stmt) {
                $tituloParam = $cargo->getTitulo();
                $descricaoParam = $cargo->getDescricao();
                mysqli_stmt_bind_param($stmt, "ss", $tituloParam, $descricaoParam);
                $resultado = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($resultado) {
                    return true;
                } else {
                    throw new RuntimeException("Erro ao inserir o cargo.");
                }
            } else {
                throw new RuntimeException("Erro ao preparar.");
            }
        } catch (RuntimeException $exception) {
            echo $exception;
            return false;
        }
    }

    public function alterarCargo(Cargo $cargo, int $id) : bool {
        $sql = "UPDATE cargo SET titulo = ?, descricao = ? WHERE id = ?";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);

            if($stmt) {
                $tituloParam = $cargo->getTitulo();
                $descricaoParam = $cargo->getDescricao();
                $idParam = $id;
                mysqli_stmt_bind_param($stmt, "ssi", $tituloParam, $descricaoParam, $idParam);
                $resultado = mysqli_stmt_execute($stmt);

                if($resultado) {
                    return true;
                }else {
                    throw new RuntimeException("Erro ao alterar Cargo.");
                }
            }else {
                throw new RuntimeException("Erro ao preparar.");
            }
        }catch(RuntimeException $exception) {
            echo $exception;
            return false;
        }
    }

    public function deletarCargo(int $id) : bool {
        $sql = "DELETE FROM cargo WHERE id = ?";

        try {
            $stmt = mysqli_prepare($this->conexao->getConexao(), $sql);

            if($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                $resultado = mysqli_stmt_execute($stmt);

                if($resultado) {
                    return true;
                }else {
                    throw new RuntimeException("Erro ao deletar Cargo.");
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