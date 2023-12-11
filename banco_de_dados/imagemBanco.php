<?php
session_abort();
if (!isset($_SESSION)) {
    session_start();
}
include("conexao.php");



if (isset($_GET["trocarImagem"])) {
    if (isset($_FILES["foto"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check != false) {
            $target_dir = "imagens/";
            $target_file = $target_dir . uniqid() . "_" . basename($_FILES["foto"]["name"]);

            $allowedExtensions = array("jpg", "jpeg", "png", "gif"); // Adicione ou remova extensões conforme necessário
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (in_array($imageFileType, $allowedExtensions)) {

                $nomeImagem = $_SESSION["nome"];

                $sqlConsulta = "SELECT icone_nome FROM usuarios WHERE nome = '$nomeImagem'";
                $resultConsulta = $mysqli->query($sqlConsulta);

                if ($resultConsulta && $resultConsulta->num_rows > 0) {
                    $rowConsulta = $resultConsulta->fetch_assoc();
                    $icone_nome_antigo = $rowConsulta['icone_nome'];

                    if (!empty($icone_nome_antigo)) {
                        $caminho_completo_antigo = $_SERVER['DOCUMENT_ROOT'] . "/escala/" . $icone_nome_antigo;

                        if (file_exists($caminho_completo_antigo)) {
                            if (unlink($caminho_completo_antigo)) {
                                echo "Imagem alterada com sucesso";
                            } else {
                                echo "Falha ao remover o arquivo antigo: " . $caminho_completo_antigo;
                            }
                        } else {
                            echo "Arquivo antigo não encontrado: " . $caminho_completo_antigo;
                        }
                    } else {
                        echo "Caminho do arquivo antigo está vazio.";
                    }

                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/escala/" . $target_file)) {
                        $mysqli->query("UPDATE usuarios SET icone_nome = '$target_file' WHERE nome = '$nomeImagem'");
                    } else {
                        echo "Falha ao fazer o upload do arquivo.";
                    }
                    $resultConsulta->free_result();
                }
            }
        }
        else{
            echo "Não é uma imagem";
        }
    }
}
