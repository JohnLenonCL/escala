<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_POST['medico'], $_POST['date'], $_POST['start_time'], $_POST['end_time'], $_POST['vigencia'], $_POST['semana'])) {
    $clinica = $_GET['clinica'];
    $medico = $_POST['medico'];
    $data = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $vigencia = $_POST['vigencia'];
    $semana = $_POST['semana'];

    $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssss", $clinica, $medico, $data, $start_time, $end_time, $vigencia, $semana);

    $stmt->execute();

    $stmt->close();
    $mysqli->close();
    echo '<script>window.location.href = window.location.href;</script>';
} 
?>
