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
                            <h2>Filtro</h2>
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
                                                                                            $id = $detalhes_clinica['id_modalidade'];
                                                                                            $sql = "SELECT nome FROM modalidades WHERE id = $id";

                                                                                            $result = $mysqli->query($sql);

                                                                                            if ($result->num_rows > 0) {

                                                                                                $row = $result->fetch_assoc();

                                                                                                $nome = $row["nome"];

                                                                                                echo "$nome";
                                                                                            }
                                                                                            ?>
                                                </p>
                                            </li>
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
                                <select id="heard" name="medico" class="form-control" required>
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
                                    <input class="form-control time" type="time" name="start_time" required="required">
                                </div>

                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label">Fim</label>
                                    <input class="form-control time" type="time" name="end_time" required="required">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success" id="salvar" name="salvar">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
        $(document).ready(function() {
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
        });
    </script>






</body>

</html>