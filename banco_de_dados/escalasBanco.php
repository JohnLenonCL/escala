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

    if ($vigencia == 'semana') {
        $startRecur = new DateTime($data);
        $endRecur = clone $startRecur;
        $endRecur->modify('+1 week');

        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);

        foreach ($periodo as $dataAtual) {
            if ($tags != null) {
                $tags_explode = explode(",", $tags);
                $filtro = array_filter($tags_explode);
                $dias_da_semana = array_values($filtro);

                if (in_array($dataAtual->format('l'), $dias_da_semana)) {
                    $data_formatada = $dataAtual->format('Y-m-d');
                    $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssss", $clinica, $medico, $data_formatada, $start_time, $end_time, $vigencia, $semana);
                    $stmt->execute();
                    $stmt->close();
                }
            } else {
                $data_formatada = $dataAtual->format('Y-m-d');
                $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $clinica, $medico, $data_formatada, $start_time, $end_time, $vigencia, $semana);
                $stmt->execute();
                $stmt->close();
            }
        }
        $mysqli->close();
    }

    if ($vigencia == 'mes') {
        $startRecur = new DateTime($data);
        $endRecur = clone $startRecur;
        $endRecur->modify('+1 month');
        $intervalo = new DateInterval('P1M');
        $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);

        foreach ($periodo as $data) {
            if ($tags != null) {
                $tags_explode = explode(",", $tags);
                $filtro = array_filter($tags_explode);
                $dias_da_semana = array_values($filtro);
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

    if ($vigencia == '15dias') {
        $startRecur = new DateTime($data);
        $endRecur = clone $startRecur;
        $endRecur->modify('+15 days'); // Modificado para +15 dias em vez de +1 semana
        $intervalo = new DateInterval('P14D'); // Modificado para intervalo de 1 dia
        $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);

        foreach ($periodo as $data) {
            $tags_explode = explode(",", $tags);
            $filtro = array_filter($tags_explode);
            $dias_da_semana = array_values($filtro);

            $data_formatY = $data->format('Y');
            $data_formatM = $data->format('m');
            $data_formatD = $data->format('d');

            $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $data_formatM, $data_formatY);

            if ($data_formatD > $dias_do_mes) {
                $data_formatD = $data_formatD - $dias_do_mes;
                $data_formatM++;
                if ($data_formatM > 12) {
                    $data_formatM = 1;
                    $data_formatY++;
                }
            }

            $data = new DateTime("$data_formatY-$data_formatM-$data_formatD");
            $dia_da_semana = $data->format('l');

            $data_formatada = $data->format('Y-m-d');
            $stmt = $mysqli->prepare("INSERT INTO escalas (id_clinica, id_medico, data_adicionada, hora_inicio, hora_fim, vigencia, semana) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $clinica, $medico, $data_formatada, $start_time, $end_time, $vigencia, $semana);
            $stmt->execute();
            $stmt->close();
        }
        $mysqli->close();
    }



    if ($vigencia == '15em15dias') {
        $startRecur = new DateTime($data);
        $endRecur = clone $startRecur;
        $endRecur->modify('+1 week');
        $intervalo = new DateInterval('P15D');
        $periodo = new DatePeriod($startRecur, $intervalo, $endRecur);

        foreach ($periodo as $data) {

            $tags_explode = explode(",", $tags);
            $filtro = array_filter($tags_explode);
            $dias_da_semana = array_values($filtro);
            $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $data->format('m'), $data->format('Y'));

            for ($dia = $data->format('d'); $dia <= $dias_do_mes; $dia += 14) {
                $data_formatY = $data->format('Y');
                $data_formatM = $data->format('m');
                $data = new DateTime("$data_formatY-$data_formatM-$dia");
                $dia_da_semana = $data->format('l');

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
