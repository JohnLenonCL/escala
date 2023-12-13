<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/modalidadesBanco.php");
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
            <div class="right_col" role="main">
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
                        <form id="antoform" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="control-label">Médicos</label>
                                <select id="heard" class="form-control" required>
                                    <option selected>Selecione...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Data</label>
                                <input class="form-control" class='date' type="date" name="date" required='required'>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label class="control-label">Início</label>
                                <input class="form-control time" type="time" name="start_time" required="required">

                                <label class="control-label">Fim</label>
                                <input class="form-control time" type="time" name="end_time" required="required">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Vigência</label>
                                <select id="heard" class="form-control" required>
                                    <option selected>Selecione...</option>
                                    <option value="1">Dia</option>
                                    <option value="2">Semena</option>
                                    <option value="3">Mês</option>
                                    <option value="4">Ano</option>
                                    <option value="5">15 dias</option>
                                    <option value="6">15 em 15 dias</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dias da semana em que o turno ficará disponivel</label>
                                <select id="heard" class="form-control" required>
                                    <option selected>Selecione...</option>
                                    <option value="1">Segunda</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success antosubmit">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
                </div>
                <div class="modal-body">

                    <div id="testmodal2" style="padding: 5px 20px;">
                        <form id="antoform2" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title2" name="title2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

    <?php include("scripts.php"); ?>


</body>

</html>