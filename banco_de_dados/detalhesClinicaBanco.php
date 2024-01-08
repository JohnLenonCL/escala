<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql_query = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM detalhes_clinica WHERE id = '$id'") or die($mysqli->error);
}

if (isset($_GET["salvar"])) {
    $id_modalidade = trim($_POST['id_modalidade']);
    $id_clinica = trim($_POST['id_clinica']);

    $check_query = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id_modalidade = '$id_modalidade' AND id_clinica = '$id_clinica'");

    if ($check_query->num_rows > 0) {

        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];

        $new_verificar = $existing_verificar == '1' ? '0' : '1';

        
        $update_query = $mysqli->query("UPDATE detalhes_clinica SET verificar = '1' WHERE id_modalidade = '$id_modalidade' AND id_clinica = '$id_clinica'");

        if (!$update_query) {
            die($mysqli->error);
        }
    } else {

        $insert_query = $mysqli->query("INSERT INTO detalhes_clinica (id_clinica, id_modalidade, verificar) VALUES('$id_clinica', '$id_modalidade', '1')");

        if (!$insert_query) {
            die($mysqli->error);
        }
    }
}

if (isset($_GET["modificar"])) {
    $id_modalidade = trim($_POST['id_modalidade']);
    $id_clinica = trim($_POST['id_clinica']);
    $verificar = trim($_POST['verificar']);

    $check_query = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id_modalidade = '$id_modalidade' AND id_clinica = '$id_clinica'");

    if ($check_query->num_rows > 0) {
     
        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];

        $new_verificar = $existing_verificar == '1' ? '0' : '1';

        $update_query = $mysqli->query("UPDATE detalhes_clinica SET verificar = '0' WHERE id_modalidade = '$id_modalidade' AND id_clinica = '$id_clinica'");

        if (!$update_query) {
            die($mysqli->error);
        }
    }
}


