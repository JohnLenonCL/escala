<?php
session_abort();
session_start();
include("conexao.php");

if (isset($_POST['medico'], $_POST['date'], $_POST['start_time'], $_POST['end_time'], $_POST['vigencia'], $_GET['clinica'])) {
    $clinica = $_GET['clinica'];
    $medico = $_POST['medico'];
    $data = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $vigencia = $_POST['vigencia'];
    $tags = $_POST['tags_1'];
    if (isset($_POST['semana'])) {
        $semana = $_POST['semana'];
    } else {
        $semana = "null";
    }


    if ($vigencia == 'dia') {
        $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $clinica, $medico, $data, $start_time, $end_time, $vigencia, $semana);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }


    if ($vigencia == 'ano') {
        $startRecur = new DateTime($data);
        $endRecur = clone $startRecur;
        $endRecur->modify('+1 year');
        $intervalo = new DateInterval('P1M');
        $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);

        foreach ($periodo as $data) {
            if ($tags != null) {
                $tags_explode = explode(",", $tags);
                $filtro = array_filter($tags_explode);
                $dias_da_semana = array_values($filtro);
                var_dump($dias_da_semana);
                $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $data->format('m'), $data->format('Y'));

                for ($dia = 1; $dia <= $dias_do_mes; $dia++) {
                    $data_formatY = $data->format('Y');
                    $data_formatM = $data->format('m');
                    $data = new DateTime("$data_formatY-$data_formatM-$dia");
                    $dia_da_semana = $data->format('l');

                    if (in_array($dia_da_semana, $dias_da_semana)) {
                        $data_formatada = $data->format('Y-m-d');
                        $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssssss", $clinica, $medico, $data_formatada, $start_time, $end_time, $vigencia, $semana);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            } else {
                $data_formatada = $data->format('Y-m-d');
                $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $clinica, $medico, $data_formatada, $start_time, $end_time, $vigencia, $semana);
                $stmt->execute();
                $stmt->close();
            }
        }
        $mysqli->close();
    }



    echo '<script>window.location.href = window.location.href;</script>';
}
