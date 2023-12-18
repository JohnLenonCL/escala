<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_POST['event_id'], $_POST['edit_date'], $_POST['edit_start_time'], $_POST['edit_end_time'])) {
    $event_id = $_POST['event_id'];
    $edit_date = $_POST['edit_date'];
    $edit_start_time = $_POST['edit_start_time'];
    $edit_end_time = $_POST['edit_end_time'];

    $stmt = $mysqli->prepare("UPDATE escalas SET data_adicionada = ?, hora_inicio = ?, hora_fim = ? WHERE id = ?");

    $stmt->bind_param("sssi", $edit_date, $edit_start_time, $edit_end_time, $event_id);

    if ($stmt->execute()) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Erro ao editar a escala no banco de dados.');
    }

    $stmt->close();
    $mysqli->close();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Parâmetros inválidos.');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
