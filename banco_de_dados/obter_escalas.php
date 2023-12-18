<?php
include("conexao.php");

$start = $_GET['start'];
$end = $_GET['end'];
$clinica = $_GET['clinica'];

$sql = "SELECT * FROM escalas WHERE data_adicionada BETWEEN FROM_UNIXTIME($start) AND FROM_UNIXTIME($end) AND id_clinica = $clinica";
$result = $mysqli->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $id_medico = $row['id_medico'];
    $sql_medico = "SELECT nome FROM medicos WHERE id = $id_medico";
    $result_medico = $mysqli->query($sql_medico);

    if ($result_medico->num_rows > 0) {
        $row_medico = $result_medico->fetch_assoc();
        $nome_medico = $row_medico['nome'];

        $events[] = [
            'id' => $row['id'],
            'title' => $nome_medico,
            'start' => $row['data_adicionada'] . ' ' . $row['hora_inicio'],
            'end' => $row['data_adicionada'] . ' ' . $row['hora_fim'],
            'allDay' => false
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($events);

?>
