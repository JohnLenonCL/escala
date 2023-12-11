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

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Lista de Modalidades</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="d-flex justify-content-end mr-2"><a href="cadastroModalidades.php" class='btn btn-secondary'>Cadastrar modalidade</a></div>
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap compact" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 0px">#</th>
                                                <th>Nome</th>
                                                <th style="width: 0px">Detalhes</th>
                                                <th style="width: 0px">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $modalidades = $mysqli->query("SELECT * FROM modalidades");

                                            $i = 0;

                                            foreach ($modalidades as $modalidades) :
                                            ?>


                                                <tr>
                                                    <td class="align-middle" scope="row"><?php echo ++$i; ?></td>
                                                    <td class="align-middle"><?php echo $modalidades['nome']; ?></td>
                                                    <td>
                                                        <form style="margin: 0px;" action="detalhesModalidades.php?id=<?php echo $modalidades['id'] ?>" method="post">
                                                            <input type="text" name="nome_modalidade" value="<?php echo $modalidades['nome']; ?>" hidden="true">
                                                            <button class="fa fa-eye d-flex m-auto" style="border:none; background-color:transparent;" type="submit" name="enviar_nome_modalidade" id="<?php echo $modalidades['id'] ?>"></button>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a class='fa fa-list-alt mr-5' id="<?php echo $modalidades['id'] ?>" onclick="encaminharId2(this)" data-toggle="modal" data-target=".modal2"></a>
                                                        <a class='fa fa-trash' id="<?php echo $modalidades['id'] ?>" onclick="encaminharId(this)" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
                                                    </td>
                                                </tr>


                                            <?php
                                            endforeach;
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /page content -->


            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Remover</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Tem certeza que deseja remover esta modalidade?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            <button type="button" class="btn btn-danger" onclick="receberId()">Sim, Remover</button>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                var remover

                function encaminharId(botaoClicado) {
                    remover = botaoClicado.id
                }

                function receberId() {
                    window.location.href = "listaModalidades.php?delete=" + remover
                }
            </script>
            <!-- /Modal -->

            <!-- Modal 2 -->
            <div class="modal fade modal2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Cadastro de Sub-Modalidades</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" novalidate>
                                <div class="field item form-group">
                                    <label class="col-form-label col-3 label-align">Nome<span class="required">*</span></label>
                                    <div class="col-6">
                                        <input class="form-control" id="subnome" name="name" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3 d-flex justify-content-center mt-3">
                                        <button type='submit' name="subenviar" class="btn btn-success" onclick="receberId2()">Enviar</button>
                                        <button type='reset' class="btn btn-secondary">Resetar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var cadastrar

                function encaminharId2(botaoClicado) {
                    cadastrar = botaoClicado.id
                }

                function receberId2() {
                    var subnome = document.getElementById("subnome").value
                    window.location.href = "listaModalidades.php?id=" + cadastrar + "&subnome=" + subnome

                }
            </script>
            <!-- /Modal 2 -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="fornecedores/validator/multifield.js"></script>
    <script src="fornecedores/validator/validator.js"></script>

    <!-- Validação -->
    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>

    <script>
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
    <?php include("scripts.php"); ?>


</body>

</html>