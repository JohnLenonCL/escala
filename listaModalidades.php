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
                                                <th style="width: 0px">&nbsp;&nbsp;Ações&nbsp;&nbsp;</th>
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
                                                    <td class="align-middle d-flex justify-content-between">
                                                        <form style="margin: 0px;" action="detalhesModalidades.php?id=<?php echo $modalidades['id'] ?>" method="POST">
                                                            <input type="text" name="nome_modalidade" value="<?php echo $modalidades['nome']; ?>" hidden="true">
                                                            <a href="javascript:void(0);" onclick="submitForm(this);" class="fa fa-eye" style="border:none; background-color:transparent;"></a>
                                                        </form>
                                                        <div>
                                                            <a href="editarCadastros.php?modalidade=<?php echo $modalidades['id'] ?>" class='fa fa-pencil'></a>
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" id="<?php echo $modalidades['id'] ?>" onclick="encaminharId(this)" data-toggle="modal" data-target=".bs-example-modal-lg" class='fa fa-trash'></a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <script>
                                                    function submitForm(link) {
                                                        var form = link.closest('form');
                                                        form.submit();
                                                    }
                                                </script>

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

        </div>
    </div>

    <?php include("scripts.php"); ?>

</body>

</html>