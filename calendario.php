<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/escalasBanco.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ammo - Escala</title>

    <?php include("links.php"); ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <?php include("estrutura/barra_lateral.php"); ?>
                </div>
            </div>

            <!-- top navigation -->
            <?php include("estrutura/cabecalho.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->

            <!-- Filtro por modalidade -->
            <div class="right_col" role="main">
                <div class="col-md-2 col-sm-2 d-flex">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Filtros</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link" style="position: relative; right: -50px"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class>
                                <ul class="to_do">
                                    <?php
                                    $clinica = $_GET['clinica'];

                                    $sql = "SELECT * FROM detalhes_clinica WHERE id_clinica = $clinica AND id_modalidade <> 0 AND verificar = 1";

                                    $result = $mysqli->query($sql);

                                    if ($result->num_rows > 0) {
                                        foreach ($result as $detalhes_clinica) :
                                    ?>
                                            <li>
                                                <p>
                                                    <input type="checkbox" class="flat"> <?php
                                                                                            $id_modalidade = $detalhes_clinica['id_modalidade'];
                                                                                            $sql_modalidade = "SELECT nome FROM modalidades WHERE id = $id_modalidade";

                                                                                            $result_modalidade = $mysqli->query($sql_modalidade);

                                                                                            if ($result_modalidade->num_rows > 0) {

                                                                                                $row_modalidade = $result_modalidade->fetch_assoc();

                                                                                                $nome_modalidade = $row_modalidade["nome"];

                                                                                                echo "$nome_modalidade";
                                                                                            }
                                                                                            ?>
                                                </p>
                                            </li>

                                            <?php
                                            $id_modalidade = $detalhes_clinica['id_modalidade'];
                                            $sql_submodalidades = "SELECT * FROM sub_modalidades WHERE id_modalidades = $id_modalidade";
                                            $result_submodalidades = $mysqli->query($sql_submodalidades);

                                            if ($result_submodalidades->num_rows > 0) {
                                                foreach ($result_submodalidades as $sub_modalidades) :
                                            ?>
                                                    <li>
                                                        <p>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" class="flat">
                                                            <?php
                                                            $id_submodalidade = $sub_modalidades['id'];
                                                            $sql_submodalidade_nome = "SELECT nome FROM sub_modalidades WHERE id = $id_submodalidade";

                                                            $result_submodalidade_nome = $mysqli->query($sql_submodalidade_nome);

                                                            if ($result_submodalidade_nome->num_rows > 0) {

                                                                $row_submodalidade_nome = $result_submodalidade_nome->fetch_assoc();

                                                                $nome_submodalidade = $row_submodalidade_nome["nome"];

                                                                echo "$nome_submodalidade";
                                                            }
                                                            ?>
                                                        </p>
                                                    </li>
                                            <?php
                                                endforeach;
                                            }
                                            ?>

                                    <?php
                                        endforeach;
                                    } else {
                                        echo "Não há modalidades disponíveis.";
                                    }

                                    ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filtro por modalidade -->



                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Escalas da Clínica "<?php
                                                            $id = $_GET['clinica'];
                                                            $sql = "SELECT nome FROM clinicas WHERE id = $id";

                                                            $result = $mysqli->query($sql);

                                                            if ($result->num_rows > 0) {

                                                                $row = $result->fetch_assoc();

                                                                $nome = $row["nome"];

                                                                echo "$nome";
                                                            }
                                                            ?>"</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div id='calendar'></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

        </div>
    </div>
    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Adicionar escala</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div id="testmodal" style="padding: 5px 20px;">
                        <form id="antoform" class="form-horizontal calender" role="form" action="" method="POST">
                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Médicos</label>
                                <select id="medico" name="medico" class="form-control" required>
                                    <option selected disabled>Selecione...</option>
                                    <?php
                                    $clinica = $_GET['clinica'];

                                    $sql = "SELECT * FROM detalhes_clinica WHERE id_clinica = $clinica AND id_medico <> 0 AND verificar = 1";

                                    $result = $mysqli->query($sql);

                                    if ($result->num_rows > 0) {

                                        foreach ($result as $detalhes_clinica) :
                                    ?>
                                            <option value="<?php echo $detalhes_clinica['id_medico'] ?>"><?php
                                                                                                            $id = $detalhes_clinica['id_medico'];
                                                                                                            $sql = "SELECT nome FROM medicos WHERE id = $id";

                                                                                                            $result = $mysqli->query($sql);

                                                                                                            if ($result->num_rows > 0) {

                                                                                                                $row = $result->fetch_assoc();

                                                                                                                $nome = $row["nome"];

                                                                                                                echo "$nome";
                                                                                                            }
                                                                                                            ?></option>
                                    <?php
                                        endforeach;
                                    } else {
                                        echo "Não há dados disponíveis para esta clínica.";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Data</label>
                                <input class="form-control" class='date' type="date" name="date" id="date" required='required'>
                            </div>
                            <div class="form-group">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label">Início</label>
                                    <input class="form-control time" type="time" id="start_time" name="start_time" required="required">
                                </div>

                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label">Fim</label>
                                    <input class="form-control time" type="time" id="end_time" name="end_time" required="required">
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Vigência</label>
                                <select id="heard" name="vigencia" class="form-control" required>
                                    <option selected disabled>Selecione...</option>
                                    <option value="dia">Dia</option>
                                    <option value="semana">Semana</option>
                                    <option value="mes">Mês</option>
                                    <option value="ano">Ano</option>
                                    <option value="15dias">15 dias</option>
                                    <option value="15em15dias">15 em 15 dias</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Dias da semana em que o turno ficará disponivel</label>
                                <select id="heard" name="semana" class="form-control" required>
                                    <option selected disabled>Selecione...</option>
                                    <option value="segunda">Segunda</option>
                                    <option value="terca">Terça</option>
                                    <option value="quarta">Quarta</option>
                                    <option value="quinta">Quinta</option>
                                    <option value="sexta">Sexta</option>
                                    <option value="sabado">Sábado</option>
                                    <option value="domingo">Domingo</option>
                                </select>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary antoclose" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success" id="salvar" name="salvar">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Edição da escala -->
    <!-- Modal de Edição -->
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Editar Escala</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div id="testmodal2" style="padding: 5px 20px;">
                        <form id="antoform2" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Data</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="edit_date" name="edit_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Hora de Início</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" id="edit_start_time" name="edit_start_time">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Hora de Término</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" id="edit_end_time" name="edit_end_time">
                                </div>
                            </div>
                            <!-- Adicione outros campos conforme necessário -->

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary antosubmit2">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

    <?php include("scripts.php"); ?>

    <script>
        function init_calendar() {
            if (typeof($.fn.fullCalendar) === 'undefined') {
                return;
            }
            console.log('init_calendar');

            var date = new Date(),
                d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear(),
                started,
                ended,
                categoryClass;

            var clickedEvent; // Variável para armazenar o evento clicado

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,listMonth'
                },
                locale: 'pt-br',
                selectable: true,
                selectHelper: true,
                displayEventTime: false,

                eventRender: function(event, element) {
                    var startTimeFormatted = moment(event.start).format("HH:mm");
                    var endTimeFormatted = moment(event.end).format("HH:mm");

                    var timeRange = '<b>' + startTimeFormatted + ' - ' + endTimeFormatted + '</b>';

                    element.find('.fc-title').html(timeRange + '<br>' + event.title).css('text-align', 'center');
                },
                select: function(start, end, allDay) {
                    $("#date").val(moment(start).format("YYYY-MM-DD"));
                    $('#fc_create').click();

                    started = start;
                    ended = end;
                },
                eventClick: function(calEvent, jsEvent, view) {
                    clickedEvent = calEvent; // Armazenar a referência ao evento clicado
                    $('#fc_edit').click();
                    $('#title2').val(calEvent.title);

                    categoryClass = $("#event_type").val();
                },
                editable: true,
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: 'banco_de_dados/obter_escalas.php',
                        dataType: 'json',
                        data: {
                            start: start.unix(),
                            end: end.unix(),
                            clinica: <?php echo $_GET['clinica']; ?>
                        },
                        success: function(response) {
                            var events = [];
                            response.forEach(function(evento) {
                                events.push({
                                    title: evento.title,
                                    start: evento.start,
                                    end: evento.end,
                                    allDay: evento.allDay
                                });
                            });
                            callback(events);
                        }
                    });
                }
            });

            var sucessoAoRecarregar = localStorage.getItem('sucessoAoRecarregar');
            if (sucessoAoRecarregar) {
                new PNotify({
                    title: 'Salvar',
                    text: 'Escala salva com sucesso!',
                    type: 'success',
                    styling: 'bootstrap3'
                });

                localStorage.removeItem('sucessoAoRecarregar');
            }

            $('form').submit(function(e) {
                var respostaDoServidor = {
                    success: true,
                    message: 'Atualização realizada com sucesso!'
                };

                if (respostaDoServidor.success) {
                    localStorage.setItem('sucessoAoRecarregar', 'true');
                } else {
                    console.error('Erro no envio do formulário');
                }
            });

            $(".antosubmit2").on("click", function() {
                var edit_date = $("#edit_date").val();
                var edit_start_time = $("#edit_start_time").val();
                var edit_end_time = $("#edit_end_time").val();

                $.ajax({
                    url: 'banco_de_dados/editar_escala.php',
                    type: 'POST',
                    data: {
                        event_id: 56, //mudar o ID para o evento clicado
                        edit_date: edit_date,
                        edit_start_time: edit_start_time,
                        edit_end_time: edit_end_time,
                        // Adicione outros campos conforme necessário
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Resposta do servidor:', response);

                        if (response.success) {
                            calendar.fullCalendar('updateEvent', clickedEvent);
                            $('.antoclose2').click();

                            new PNotify({
                                title: 'Editar',
                                text: 'Escala editada com sucesso!',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        } else {
                            console.error('Erro ao editar escala:', response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro na requisição AJAX:', textStatus, errorThrown);
                    }
                });

            });
        }
    </script>


</body>

</html>