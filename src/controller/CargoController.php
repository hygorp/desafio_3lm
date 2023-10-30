<?php

include 'src/dao/CargoDAO.php';

class CargoController {

    private CargoDAO $cargoDAO;

    public function __construct() {
        $this->cargoDAO = new CargoDAO();
    }

    public function listarCargos(): array {
        return $this->cargoDAO->listarCargos();
    }

    public function listarCargoPorId(int $id): array {
        return $this->cargoDAO->listarCargoPorId($id);
    }

    public function inserirCargo(Cargo $cargo) : bool {
        return $this->cargoDAO->inserirCargo($cargo);
    }

    public function alterarCargo(Cargo $cargo, int $id) : bool {
        return $this->cargoDAO->alterarCargo($cargo, $id);
    }

    public function deletarCargo(int $id) : bool {
        return $this->cargoDAO->deletarCargo($id);
    }
}