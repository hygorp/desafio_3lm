<?php

global $twig;
require_once 'includes.php';
require_once 'src/config/TwigConfig.php';

$funcionario = new Funcionario();
$funcionarioController = new FuncionarioController();
$listaDeFuncionarios = $funcionarioController->listarFuncionarios();

$cargoController = new CargoController();
$listaDeCargos = $cargoController->listarCargos();

if($_POST) {
    if(isset($_POST['inserirFuncionario'])) {
        $funcionario->setNome($_POST['nome']);
        $funcionario->setSobrenome($_POST['sobrenome']);
        $funcionario->setNascimento($_POST['nascimento']);
        $funcionario->setCargoId($_POST['cargo']);
        $funcionario->setSalario($_POST['salario']);

        $funcionarioController->inserirFuncionario($funcionario);
        header("Location: http://localhost/funcionarios.php");
    }

    if(isset($_POST['salvarAlteracoes'])) {
        $matricula = $_POST['matricula'];
        $funcionario->setNome($_POST['nome']);
        $funcionario->setSobrenome($_POST['sobrenome']);
        $funcionario->setNascimento($_POST['nascimento']);
        $funcionario->setCargoId($_POST['cargo']);
        $funcionario->setSalario($_POST['salario']);
        $funcionarioController->alterarFuncionario($funcionario, $matricula);
        header("Location: http://localhost/funcionarios.php");
    }

    if(isset($_POST['deletarFuncionario'])) {
        $matricula = $_POST['matricula'];
        $deletarFuncionario = $funcionarioController->deletarFuncionario($matricula);
        header("Location: http://localhost/funcionarios.php");
    }
}

echo $twig->render('Funcionarios.twig', ['listaDeFuncionarios' => $listaDeFuncionarios, 'listaDeCargos' => $listaDeCargos]);