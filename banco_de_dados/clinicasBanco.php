<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $mysqli->query("DELETE FROM clinicas WHERE id = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM detalhes_clinica WHERE id_clinica = '$id'") or die($mysqli->error);

    header("Location: listaClinicas.php");
}

if (isset($_GET["enviar"])) {
    $nome = trim($_POST['nome']);
    $endereco = trim($_POST['endereco']);

    $resultado = $mysqli->query("INSERT INTO clinicas (nome, endereco) VALUES('$nome', '$endereco')") or die($mysqli->error);

    if ($resultado) {
        $response = array("status" => "success", "message" => "Seu cadastro foi realizado com sucesso");
        echo json_encode($response);
        exit;
    } 
}
