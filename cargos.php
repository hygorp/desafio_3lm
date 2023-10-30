<?php

global $twig;
require_once 'includes.php';
require_once 'src/config/TwigConfig.php';

$cargo = new Cargo();
$cargoController = new CargoController();
$listaDeCargos = $cargoController->listarCargos();

if($_POST) {
    if(isset($_POST['inserirCargo'])) {
        $cargo->setTitulo($_POST['cargo']);
        $cargo->setDescricao($_POST['descricao']);

        $cargoController->inserirCargo($cargo);
        header("Location: http://localhost/cargos.php");
    }

    if(isset($_POST['salvarAlteracoes'])) {
        $id = $_POST['id'];
        $cargo->setTitulo($_POST['titulo']);
        $cargo->setDescricao($_POST['descricao']);
        $cargoController->alterarCargo($cargo, $id);
        header("Location: http://localhost:/cargos.php");
    }

    if(isset($_POST['deletarCargo'])) {
        $id = $_POST['id'];
        $cargoController->deletarCargo($id);
        header("Location: http://localhost:/cargos.php");
    }
}

echo $twig->render('Cargos.twig', ['listaDeCargos' => $listaDeCargos]);