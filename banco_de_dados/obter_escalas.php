<?php
include("conexao.php");

if (isset($_GET["modalidadeId"])) {
    $clinica = $_GET['clinica'];
    $modalidade = $_GET['modalidadeId'];

    $sql = "SELECT DISTINCT escalas.id_medico, escalas.* FROM escalas
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
} else if (isset($_GET["submodalidadeId"])) {
    $clinica = $_GET['clinica'];
    $modalidade = $_GET['submodalidadeId'];

    $sql = "SELECT escalas.* FROM escalas
            JOIN detalhes_medico ON escalas.id_medico = detalhes_medico.id_medico
            WHERE detalhes_medico.id_sub = $modalidade AND detalhes_medico.verificar = 1 AND escalas.id_clinica = $clinica";

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
} else {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $clinica = $_GET['clinica'];

    $sql = "SELECT * FROM escalas WHERE id_clinica = $clinica";
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

    $sql_vigencia = "SELECT * FROM escalas WHERE id_clinica = $clinica AND vigencia = 'ano'";
    $result_vigencia = $mysqli->query($sql_vigencia);

    while ($row = $result_vigencia->fetch_assoc()) {
        $id_medico = $row['id_medico'];
        $sql_medico = "SELECT * FROM medicos WHERE id = $id_medico";
        $result_medico = $mysqli->query($sql_medico);

        if ($result_medico->num_rows > 0) {
            $startRecur = new DateTime($row['data_adicionada']);
            $endRecur = clone $startRecur;
            $endRecur->modify('+1 year');
            $intervalo = new DateInterval('P1M');
            $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);
            $row_medico = $result_medico->fetch_assoc();
            $nome_medico = $row_medico['nome'];
            $cor_medico = $row_medico['cor'];

            foreach ($periodo as $data) {

                $evento = [
                    'id' => $row['id'],
                    'title' => $nome_medico,
                    'color' => $cor_medico,
                    'start' => $data->format('Y-m-d') . ' ' . $row['hora_inicio'],
                    'end' => $data->format('Y-m-d') . ' ' . $row['hora_fim'],
                    'allDay' => false
                ];
                $events[] = $evento;
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($events);
}
