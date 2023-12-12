<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM usuarios WHERE id = '$id'") or die($mysqli->error);
}

if (isset($_GET["enviar"])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $cpf = trim($_POST['cpf']);
    $senha = trim($_POST['password']);
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
    $resultado = $mysqli->query("INSERT INTO usuarios (nome, email, cpf, senha) VALUES('$nome', '$email', '$cpf', '$hashSenha')") or die($mysqli->error);

    if ($resultado) {
        $response = array("status" => "success", "message" => "Seu cadastro foi realizado com sucesso");
        echo json_encode($response);
        exit;
    } 
}
