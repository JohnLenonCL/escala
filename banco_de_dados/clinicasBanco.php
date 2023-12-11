<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql_query = $mysqli->query("SELECT * FROM clinicas WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM clinicas WHERE id = '$id'") or die($mysqli->error);

    header("Location: listaClinicas.php");
}

if (isset($_POST["enviar"])) {
    $nome = trim($_POST['nome']);
    $endereco = trim($_POST['endereco']);

    $mysqli->query("INSERT INTO clinicas (nome, endereco) VALUES('$nome', '$endereco')") or die($mysqli->error);

    echo '<script>window.location.href = window.location.href;</script>';
}

