<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/modalidadesBanco.php");
$submodalidades = $mysqli->query("SELECT * FROM sub_modalidades");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ammo Escala</title>

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
            <div class="page-title">
                    <div class="title_left">
                        <h3>Detalhes da modalidade "<?php
                                                    $id = $_GET['id'];
                                                    $sql = "SELECT nome FROM modalidades WHERE id = $id";

                                                    $result = $mysqli->query($sql);

                                                    if ($result->num_rows > 0) {

                                                        $row = $result->fetch_assoc();

                                                        $nome = $row["nome"];

                                                        echo "$nome";
                                                    }
                                                    ?>"</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sub-Modalidades</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <input type="text" id="input" value="<?php echo $_GET['id'] ?>" hidden="true">
                                <div class="d-flex justify-content-end"><button class='btn btn-secondary mr-3' id="<?php echo $_GET['id'] ?>" onclick="encaminharId2(this)" data-toggle="modal" data-target=".modal2">Casdatrar sub-modalidade</button></div>
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap compact" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th style="width: 0px;">#</th>
                                                <th>Nome</th>
                                                <th style="width: 0px;">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($submodalidades as $submodalidades) :
                                                if ($submodalidades['id_modalidades'] == $_GET['id']) {
                                            ?>
                                                    <tr id="<?php echo $submodalidades['id'] ?>">
                                                        <td class="align-middle" scope="row"><?php echo ++$i; ?></td>
                                                        <td class="align-middle"> <?php echo $submodalidades['nome']; ?></td>
                                                        <td class="align-middle">
                                                            <a class='fa fa-trash d-flex justify-content-center' id="<?php echo $submodalidades['id'] ?>" onclick="encaminharId(this)" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
                                                        </td>

                                                    </tr>
                                            <?php
                                                }
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

            <?php include("scripts.php"); ?>

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
                            <h5>Tem certeza que deseja remover esta sub-modalidade?</h3>
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
                    window.location.href = "detalhesModalidades.php?deletar=" + remover + "&id=" + document.getElementById("input").value
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
                                        <input class="form-control" id="subnome" required="required" />
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
                    window.location.href = "detalhesModalidades.php?id=" + cadastrar + "&subnome=" + subnome

                }
            </script>
            <!-- /Modal 2 -->

        </div>
    </div>





</body>

</html>