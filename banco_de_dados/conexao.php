<?php
$hostname = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "projeto_escala";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
  die("Falha na conexão: " . $mysqli->connect_errno);
}
?>