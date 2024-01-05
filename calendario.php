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
                                                <p><b>
                                                        <input type="checkbox" class="js-switch switch" data-modalidade-id="<?php echo $detalhes_clinica['id_modalidade']; ?>"> <?php
                                                                                                                                                                                $id_modalidade = $detalhes_clinica['id_modalidade'];
                                                                                                                                                                                $sql_modalidade = "SELECT nome FROM modalidades WHERE id = $id_modalidade";

                                                                                                                                                                                $result_modalidade = $mysqli->query($sql_modalidade);

                                                                                                                                                                                if ($result_modalidade->num_rows > 0) {

                                                                                                                                                                                    $row_modalidade = $result_modalidade->fetch_assoc();

                                                                                                                                                                                    $nome_modalidade = $row_modalidade["nome"];

                                                                                                                                                                                    echo "$nome_modalidade";
                                                                                                                                                                                }
                                                                                                                                                                                ?>
                                                    </b></p>
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
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" class="js-switch switchsub" data-submodalidade-id="<?php echo $sub_modalidades['id']; ?>">
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
                                    <option selected hidden value="">Selecione...</option>
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
                                <input class="form-control date" type="date" name="date" id="date" readonly>

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
                                <select id="vigencia" name="vigencia" class="form-control" required>
                                    <option selected hidden value="">Selecione...</option>
                                    <option value="dia">Dia</option>
                                    <option value="semana">Semana</option>
                                    <option value="mes">Mês</option>
                                    <option value="ano">Ano</option>
                                    <option value="15dias">15 dias</option>
                                    <option value="15em15dias">15 em 15 dias</option>
                                </select>
                                <span id="msg_vigencia"></span>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label id="label_semana" class="control-label">Dias da semana em que o turno ficará disponivel</label>
                                <select id="semana" name="semana" class="form-control">
                                    <option hidden selected value="">Selecione...</option>
                                    <option value="Monday" name="Segunda">Segunda</option>
                                    <option value="Tuesday" name="Terça">Terça</option>
                                    <option value="Wednesday" name="Quarta">Quarta</option>
                                    <option value="Thursday" name="Quinta">Quinta</option>
                                    <option value="Friday" name="Sexta">Sexta</option>
                                    <option value="Saturday" name="Sábado">Sábado</option>
                                    <option value="Sunday" name="Domingo">Domingo</option>
                                </select>
                                <input name="tags_1" id="tags_1" type="text" class="tags form-control" />
                                <span id="msg_semana"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary antoclose" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success antosubmit1" id="salvar" name="salvar">Salvar</button>
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
                            <input type="text" class="form-control" id="event_id2" name="event_id2" hidden>
                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Médicos</label>
                                <select id="edit_medico" name="edit_medico" class="form-control" required>
                                    <option selected hidden value="">Selecione...</option>
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
                                <input class="form-control" class='date' type="date" id="edit_date" name="edit_date" readonly>
                            </div>
                            <div class="form-group">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label">Início</label>
                                    <input class="form-control time" type="time" id="edit_start_time" name="edit_start_time" required="required">
                                </div>

                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label">Fim</label>
                                    <input class="form-control time" type="time" id="edit_end_time" name="edit_end_time" required="required">
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Vigência</label>
                                <select id="edit_vigencia" name="edit_vigencia" class="form-control" required>
                                    <option selected hidden value="">Selecione...</option>
                                    <option value="dia">Dia</option>
                                    <option value="semana">Semana</option>
                                    <option value="mes">Mês</option>
                                    <option value="ano">Ano</option>
                                    <option value="15dias">15 dias</option>
                                    <option value="15em15dias">15 em 15 dias</option>
                                </select>
                                <span id="msg_vigencia"></span>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label class="control-label">Dias da semana em que o turno ficará disponivel</label>
                                <select id="edit_semana" name="edit_semana" class="form-control" required>
                                    <option selected hidden value="">Selecione...</option>
                                    <option value="Monday">Segunda</option>
                                    <option value="Tuesday">Terça</option>
                                    <option value="Wednesday">Quarta</option>
                                    <option value="Thursday">Quinta</option>
                                    <option value="Friday">Sexta</option>
                                    <option value="Saturday">Sábado</option>
                                    <option value="Sunday">Domingo</option>
                                </select>
                                <span id="msg_semana"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="delete_escala()">Remover</button>
                                <button type="button" class="btn btn-secondary antoclose2" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success antosubmit2">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->


    <?php include("scripts.php"); ?>


    <script>
        function delete_escala() {
            var remover_event_id = $('#event_id2').val();
            var resposta = confirm("Deseja remover o evento?");
            if (resposta) {
                $.ajax({
                    type: "POST",
                    url: "banco_de_dados/editar_escala.php",
                    data: {
                        remover_event_id: remover_event_id
                    },
                    success: function(data) {
                        if (data) {
                            localStorage.setItem('sucessoAoRecarregar3', 'true');
                            window.location.reload();
                        }
                    }
                })
            }
        }

        $(".antosubmit2").on("click", function() {
            var edit_medico = $("#edit_medico").val();
            var edit_date = $("#edit_date").val();
            var edit_start_time = $("#edit_start_time").val();
            var edit_end_time = $("#edit_end_time").val();
            var edit_vigencia = $("#edit_vigencia").val();
            var edit_semana = $("#edit_semana").val();
            var event_id = $("#event_id2").val();
            $('form').submit(function(e) {

                $.ajax({
                    url: 'banco_de_dados/editar_escala.php',
                    type: 'POST',
                    data: {
                        event_id: event_id,
                        edit_date: edit_date,
                        edit_start_time: edit_start_time,
                        edit_end_time: edit_end_time,
                        edit_vigencia: edit_vigencia,
                        edit_semana: edit_semana,
                        edit_medico: edit_medico
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Resposta do servidor:', response);

                        if (response.success) {

                            $('.antoclose2').click();
                            localStorage.setItem('sucessoAoRecarregar2', 'true');
                            window.location.reload();
                        } else {
                            console.error('Erro ao editar escala:', response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro na requisição AJAX:', textStatus, errorThrown);
                    }
                });

            });
        });

        $(document).ready(function() {
            var originalEvents;
            var originalEvents2;
            var filteredEvents;
            var manter;
            var sucessoAoRecarregar = localStorage.getItem('sucessoAoRecarregar2');
            var sucessoAoRecarregar3 = localStorage.getItem('sucessoAoRecarregar3');

            if (sucessoAoRecarregar) {
                new PNotify({
                    title: 'Atualizar',
                    text: 'Atualização realizada com sucesso!',
                    type: 'success',
                    styling: 'bootstrap3'
                });

                localStorage.removeItem('sucessoAoRecarregar2');
            }

            if (sucessoAoRecarregar3) {
                new PNotify({
                    title: 'Remover',
                    text: 'Remoção realizada com sucesso!',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                localStorage.removeItem('sucessoAoRecarregar3');
            }
        });

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

            var clickedEvent;

            var calendarOptions = {
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,listMonth'
                },
                locale: 'pt-br',
                editable: false,
                eventStartEditable: false,
                eventDurationEditable: false,
                selectable: true,
                selectHelper: true,
                displayEventTime: true,

                eventRender: function(event, element) {
                    var startTimeFormatted = moment(event.start).format("HH:mm");
                    var endTimeFormatted = moment(event.end).format("HH:mm");
                    var eventColor = event.color;
                    var timeRange = '<b>' + startTimeFormatted + ' - ' + endTimeFormatted + '</b>';

                    element.find('.fc-title').html(timeRange + '<br>' + event.title).css('text-align', 'center');
                    element.find('.fc-content').css({
                        'cursor': 'pointer',
                        'background-color': eventColor
                    });
                },

                select: function(start, end, allDay) {
                    var today = new Date();
                    if (start < today.setDate(today.getDate() - 1)) {
                        new PNotify({
                            title: 'Evento',
                            text: 'Não é possível adicionar eventos antes do dia de hoje!',
                            type: 'alert',
                            styling: 'bootstrap3'
                        });
                        return;
                    }

                    $("#date").val(moment(start).format("YYYY-MM-DD"));
                    $('#fc_create').click();

                    started = start;
                    ended = end;
                },

                eventClick: function(calEvent, jsEvent, view) {
                    clickedEvent = calEvent;
                    $('#fc_edit').click();
                    $('#title2').val(calEvent.title);
                    $('#event_id2').val(calEvent.id);
                    $('#edit_date').val(calEvent.start.format("YYYY-MM-DD"));
                    $('#edit_start_time').val(calEvent.start.format("HH:mm"));
                    $('#edit_end_time').val(calEvent.end.format("HH:mm"));

                    categoryClass = $("#event_type").val();
                },
                editable: true,
                events: function(start, end, timezone, callback) {
                    if ($('.switch').filter(':checked').length === 0 && $('.switchsub').filter(':checked').length === 0) {
                        $.ajax({
                            url: 'banco_de_dados/obter_escalas.php',
                            dataType: 'json',
                            data: {
                                start: start.unix(),
                                end: end.unix(),
                                clinica: <?php echo $_GET['clinica']; ?>
                            },
                            success: function(response) {
                                originalEvents2 = response;
                                calendar.fullCalendar('removeEvents');
                                callback(response);
                                console.log('response', response);
                            }
                        });
                    }
                    if ($('.switch').filter(':checked').length > 0 || $('.switchsub').filter(':checked').length > 0) {

                        calendar.fullCalendar('removeEvents');
                        callback(manter);

                    }
                }
            };

            if ($('.switch').filter(':checked').length === 0) {
                calendarOptions.editable = false;
            }

            var calendar = $('#calendar').fullCalendar(calendarOptions);
        }

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

        $(".antosubmit1").on("click", function() {
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
        });


        $(document).ready(function() {
            document.getElementById('tags_1_tagsinput').hidden = true;
            document.getElementById('tags_1_addTag').parentNode.removeChild(document.getElementById('tags_1_addTag'));
            var switchEventMap = {};
            var contador = 0;

            $('#vigencia').on('change', function() {
                if ($(this).val() === 'dia' || $(this).val() === '15dias' || $(this).val() === '15em15dias') {
                    document.getElementById('semana').disabled = true;
                    document.getElementById('tags_1_tagsinput').hidden = true;
                    document.getElementById('semana').hidden = true;
                    document.getElementById('label_semana').hidden = true;
                } else {
                    document.getElementById('semana').disabled = false;
                    document.getElementById('tags_1_tagsinput').hidden = false;
                    document.getElementById('semana').hidden = false;
                    document.getElementById('label_semana').hidden = false;
                }
            });
            $('#edit_vigencia').on('change', function() {
                if ($(this).val() === 'dia') {
                    document.getElementById('edit_semana').disabled = true;
                } else {
                    document.getElementById('edit_semana').disabled = false;
                }
            });


            $('#semana').on('change', function() {
                var div = document.getElementById('tags_1_tagsinput');
                document.getElementById('tags_1_tagsinput').hidden = false;
                if (div) {
                    var span = document.createElement('span');
                    span.classList.add('tag');
                    span.setAttribute('data-value', $(this).val());
                    var innerSpan = document.createElement('span');
                    var optionSelecionada = $(this).find('option:selected');
                    var nomeDaOpcao = optionSelecionada.attr('name');
                    innerSpan.textContent = nomeDaOpcao + " ";
                    var anchor = document.createElement('a');
                    anchor.setAttribute('href', '');
                    anchor.setAttribute('title', 'remover tag');
                    anchor.textContent = 'x';
                    anchor.addEventListener('click', function(event) {
                        event.preventDefault();
                        span.parentNode.removeChild(span);
                        updateInputValue();
                    });
                    var spans = document.getElementById('tags_1').value;
                    var spansArray = spans.split(",");
                    if (!spansArray.includes($(this).val())) {
                        span.appendChild(innerSpan);
                        span.appendChild(anchor);
                        div.insertBefore(span, div.lastChild);
                        updateInputValue();
                    }
                }
            });


            function updateInputValue() {
                var tags = Array.from(document.querySelectorAll('#tags_1_tagsinput .tag'))
                    .map(span => span.getAttribute('data-value'));
                document.getElementById('tags_1').value = tags.join(',');

                if (document.getElementById('tags_1').value === "") {
                    $('#semana').find('option:selected').removeAttr('selected');
                    document.getElementById('tags_1_tagsinput').hidden = true;
                }
            }



            $('.switch, .switchsub').on('change', function() {
                var modalidadeId = $(this).data('modalidade-id');
                var submodalidadeId = $(this).data('submodalidade-id');
                var key = modalidadeId + '_' + submodalidadeId;
                if ($(this).prop('checked')) {
                    $.ajax({
                        url: 'banco_de_dados/obter_escalas.php',
                        method: 'GET',
                        data: {
                            clinica: <?php echo $_GET['clinica']; ?>,
                            modalidadeId: modalidadeId,
                            submodalidadeId: submodalidadeId
                        },
                        success: function(response) {
                            contador++;
                            switchEventMap[key] = response;
                            updateCalendar(mergeEvents(), $('#calendar'));
                        },

                    });
                } else {
                    contador--;
                    delete switchEventMap[key];
                    updateCalendar(mergeEvents(), $('#calendar'));

                    if (contador === 0) {
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', originalEvents2);

                    }

                }
            });


            function mergeEvents() {
                var allEvents = [];
                for (var key in switchEventMap) {
                    allEvents = allEvents.concat(switchEventMap[key]);
                }
                manter = allEvents.filter((event, index, self) => index === self.findIndex((t) => (
                    t.id === event.id &&
                    t.modalidadeId === event.modalidadeId &&
                    t.submodalidadeId === event.submodalidadeId
                )));
                return manter;
            }

            function updateCalendar(events, calendar) {
                calendar.fullCalendar('removeEvents');
                calendar.fullCalendar('addEventSource', events);
            }

        });
    </script>

</body>

</html>