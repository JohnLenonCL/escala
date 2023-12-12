<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql_query = $mysqli->query("SELECT * FROM modalidades WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM modalidades WHERE id = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM detalhes_clinica WHERE id_modalidade = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM sub_modalidades WHERE id_modalidades = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM detalhes_medico WHERE id_modalidade = '$id'") or die($mysqli->error);
}

if (isset($_POST["enviar"])) {
    $nome = trim($_POST['nome']);

    $mysqli->query("INSERT INTO modalidades (nome) VALUES('$nome')") or die($mysqli->error);
    echo '<script>window.location.href = window.location.href;</script>';
}




if (isset($_POST["detalhe_enviar"])) {
    $nome = trim($_POST['nome']);

    $mysqli->query("INSERT INTO modalidades (nome) VALUES('$nome')") or die($mysqli->error);
}

if (isset($_GET['deletar-modalidade'])) {
    $id = intval($_GET['deletar-modalidade']);
    $sql_query = $mysqli->query("SELECT * FROM modalidades WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM modalidades WHERE id = '$id'") or die($mysqli->error);
}



if (isset($_GET['id']) and isset($_GET['subnome'])) {
        $id_modalidade = intval($_GET['id']);
        $nome = trim($_GET['subnome']);

        $mysqli->query("INSERT INTO sub_modalidades (id_modalidades, nome) VALUES('$id_modalidade', '$nome')") or die($mysqli->error);


}


if (isset($_POST["nome_modalidade"])) {
    echo '<script>window.location.href = window.location.href;</script>';

}

if (!empty($_POST["nome_clinica"])) {
    echo '<script>window.location.href = window.location.href;</script>';
}


if (isset($_GET['deletar'])) {
    $id = intval($_GET['deletar']);
    $sql_query = $mysqli->query("SELECT * FROM sub_modalidades WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM sub_modalidades WHERE id = '$id'") or die($mysqli->error);

}