<?php
session_abort();
if (!isset($_SESSION)) {
    session_start();
}
include("conexao.php");

if (isset($_POST["entrar"])) {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $stmt = $mysqli->prepare("SELECT id, senha, nome FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashSenha, $nome);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($senha, $hashSenha)) {
        $_SESSION["id"] = $id;
        $_SESSION["nome"] = $nome;
        $_SESSION["usuario_autenticado"] = true;
        header("Location: cadastroClinicas.php");
        exit();
    } else {
        header("Location: index.php?erro");
        $_SESSION['msg'] = "<p style='color: red'>Email ou senha inválidos!</p>";
        exit();
    }
}

if (isset($_GET["trocarSenha"])) {
    $idUsuario = $_SESSION["id"];
    $senhaAntiga = trim($_POST['senhaAntiga']);
    $novaSenha = trim($_POST['novaSenha']);

    $stmt = $mysqli->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $stmt->bind_result($hashSenha);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($senhaAntiga, $hashSenha)) {

        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $novaSenhaHash, $idUsuario);
        $stmt->execute();
        $stmt->close();

        echo "SenhaAntigaTrocada";
        exit();
    } else {
        echo "SenhaAntigaIncorreta";
        exit();
    }
}
?>