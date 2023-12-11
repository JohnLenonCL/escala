<?php
session_abort();
session_start();
include("banco_de_dados/conexao.php");

if (!isset($_SESSION['usuario_autenticado'])) {
    header('Location: index.php');
}
