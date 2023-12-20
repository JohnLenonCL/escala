<?php
include("conexao.php");

if (isset($_GET["modalidadeId"])) {
    $clinica = $_GET['clinica'];
    $modalidade = $_GET['modalidadeId'];

    $sql = "SELECT escalas.* FROM escalas
            JOIN detalhes_medico ON escalas.id_medico = detalhes_medico.id_medico
            WHERE detalhes_medico.id_modalidade = $modalidade AND detalhes_medico.verificar = 1 AND escalas.id_clinica = $clinica";

    $result = $mysqli->query($sql);

    $events = [];

    while ($row = $result->fetch_assoc()) {
        $id_medico = $row['id_medico'];
        $sql_medico = "SELECT * FROM medicos WHERE id = $id_medico";
        $result_medico = $mysqli->query($sql_medico);

        if ($result_medico->num_rows > 0) {
            $row_medico = $result_medico->fetch_assoc();
            $nome_medico = $row_medico['nome'];
            $cor_medico = $row_medico['cor'];

            $events[] = [
                'id' => $row['id'],
                'title' => $nome_medico,
                'color' => $cor_medico,
                'start' => $row['data_adicionada'] . ' ' . $row['hora_inicio'],
                'end' => $row['data_adicionada'] . ' ' . $row['hora_fim'],
                'allDay' => false
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($events);
}
 else {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $clinica = $_GET['clinica'];

    $sql = "SELECT * FROM escalas WHERE data_adicionada BETWEEN FROM_UNIXTIME($start) AND FROM_UNIXTIME($end) AND id_clinica = $clinica";
    $result = $mysqli->query($sql);

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $id_medico = $row['id_medico'];
        $sql_medico = "SELECT * FROM medicos WHERE id = $id_medico";
        $result_medico = $mysqli->query($sql_medico);

        if ($result_medico->num_rows > 0) {
            $row_medico = $result_medico->fetch_assoc();
            $nome_medico = $row_medico['nome'];
            $cor_medico = $row_medico['cor'];

            $events[] = [
                'id' => $row['id'],
                'title' => $nome_medico,
                'color' => $cor_medico,
                'start' => $row['data_adicionada'] . ' ' . $row['hora_inicio'],
                'end' => $row['data_adicionada'] . ' ' . $row['hora_fim'],
                'allDay' => false
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($events);
}
