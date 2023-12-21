<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql_query = $mysqli->query("SELECT * FROM medicos WHERE id = '$id'") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $mysqli->query("DELETE FROM medicos WHERE id = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM detalhes_clinica WHERE id_medico = '$id'") or die($mysqli->error);
    $mysqli->query("DELETE FROM detalhes_medico WHERE id_medico = '$id'") or die($mysqli->error);

    header("Location: listaMedicos.php");
}

if (isset($_GET["enviar"])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $cpf = trim($_POST['cpf']);
    $senha = trim(md5($_POST['password']));
    $cor = $_POST['cor'];

    $resultado = $mysqli->query("INSERT INTO medicos (nome, email, cpf, senha, cor) VALUES ('$nome', '$email', '$cpf', '$senha', '$cor')") or die(json_encode(array("status" => "error", "message" => $mysqli->error)));
    
    if ($resultado) {
        $response = array("status" => "success", "message" => "Seu cadastro foi realizado com sucesso");
        echo json_encode($response);
        exit;
    } else {
        $response = array("status" => "error", "message" => "Erro ao inserir no banco de dados");
        echo json_encode($response);
        exit;
    }
}


if (isset($_GET["salvar"])) {
    $id_medico = trim($_POST['id_medico']);
    $id_clinica = trim($_POST['id_clinica']);
    $check_query = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id_medico = '$id_medico' AND id_clinica = '$id_clinica'");

    if ($check_query->num_rows > 0) {
        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];
        $new_verificar = $existing_verificar == '1' ? '0' : '1';
        $update_query = $mysqli->query("UPDATE detalhes_clinica SET verificar = '1' WHERE id_medico = '$id_medico' AND id_clinica = '$id_clinica'");

        if (!$update_query) {
            die($mysqli->error);
        }
    } else {
        $insert_query = $mysqli->query("INSERT INTO detalhes_clinica (id_clinica, id_medico, verificar) VALUES('$id_clinica', '$id_medico', '1')");

        if (!$insert_query) {
            die($mysqli->error);
        }
    }
}

if (isset($_GET["modificar"])) {
    $id_medico = trim($_POST['id_medico']);
    $id_clinica = trim($_POST['id_clinica']);
    $verificar = trim($_POST['verificar']);

    $check_query = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id_medico = '$id_medico' AND id_clinica = '$id_clinica'");

    if ($check_query->num_rows > 0) {
        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];
        $new_verificar = $existing_verificar == '1' ? '0' : '1';
        $update_query = $mysqli->query("UPDATE detalhes_clinica SET verificar = '0' WHERE id_medico = '$id_medico' AND id_clinica = '$id_clinica'");

        if (!$update_query) {
            die($mysqli->error);
        }
    }
}


if (isset($_POST["nome_medico"])) {
    echo '<script>window.location.href = window.location.href;</script>';
}

if (isset($_GET["salvar-modalidade-medico"])) {
    $id_modalidade = trim($_POST['id_modalidade']);
    $id_medico = trim($_POST['id_medico']);
    $id_submodalidade = trim($_POST['id_submodalidade']);
    $check_query = $mysqli->query("SELECT * FROM detalhes_medico WHERE id_modalidade = '$id_modalidade' AND id_medico = '$id_medico' AND id_sub = '$id_submodalidade'");

    if ($check_query->num_rows > 0) {
        // Se a combinação existe, obtenha o valor atual de verificar
        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];
        $new_verificar = $existing_verificar == '1' ? '0' : '1';
        $update_query = $mysqli->query("UPDATE detalhes_medico SET verificar = '1' WHERE id_modalidade = '$id_modalidade' AND id_medico = '$id_medico' AND id_sub = '$id_submodalidade'");

        if (!$update_query) {
            die($mysqli->error);
        }
    } else {
        $insert_query = $mysqli->query("INSERT INTO detalhes_medico (id_medico, id_modalidade, id_sub, verificar) VALUES('$id_medico', '$id_modalidade', '$id_submodalidade', '1')");

        if (!$insert_query) {
            die($mysqli->error);
        }
    }
}

if (isset($_GET["modificar-modalidade-medico"])) {
    $id_modalidade = trim($_POST['id_modalidade']);
    $id_medico = trim($_POST['id_medico']);
    $verificar = trim($_POST['verificar']);
    $id_submodalidade = trim($_POST['id_submodalidade']);
    $check_query = $mysqli->query("SELECT * FROM detalhes_medico WHERE id_modalidade = '$id_modalidade' AND id_medico = '$id_medico' AND id_sub = '$id_submodalidade'");

    if ($check_query->num_rows > 0) {
        $existing_row = $check_query->fetch_assoc();
        $existing_verificar = $existing_row['verificar'];
        $new_verificar = $existing_verificar == '1' ? '0' : '1';
        $update_query = $mysqli->query("UPDATE detalhes_medico SET verificar = '0' WHERE id_modalidade = '$id_modalidade' AND id_medico = '$id_medico' AND id_sub = '$id_submodalidade'");

        if (!$update_query) {
            die($mysqli->error);
        }
    }
}
?>

