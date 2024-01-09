<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/clinicasBanco.php");
include("banco_de_dados/modalidadesBanco.php");
include("banco_de_dados/detalhesClinicaBanco.php");
include("banco_de_dados/medicosBanco.php");
$clinicas = $mysqli->query("SELECT * FROM clinicas");
$medicos = $mysqli->query("SELECT * FROM medicos");
$medico_id = $_GET['id'];
$algo = $mysqli->query("SELECT * FROM detalhes_medico WHERE id_medico = '$medico_id'");
$detalhes_clinica = $mysqli->query("SELECT * FROM detalhes_clinica");
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
                        <h3>Detalhes do médico "<?php
                                                $id = $_GET['id'];
                                                $sql = "SELECT nome FROM medicos WHERE id = $id";

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
                                <h2><a href="javascript:history.go(-1)">Médicos</a></h2>
                                <h2>/</h2>
                                <h2>Modalidades e Sub-modalidades</h2>
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
                                                <th style="width: 0px;">#</th>
                                                <th>Modalidades</th>
                                                <th>Sub-modalidades</th>
                                                <th style="width: 0px;">Ativo</th>
                                                <th style="width: 0px;">Detalhes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sub_modalidades = $mysqli->query("SELECT * FROM sub_modalidades");
                                            $sub_modalidadesMarcados = [];
                                            $sub_modalidadesNaoMarcados = [];

                                            foreach ($sub_modalidades as $sub_modalidade) {
                                                $marcado = false;
                                                foreach ($algo as $item) {
                                                    if ($item['id_sub'] == $sub_modalidade['id'] && $item['verificar']) {
                                                        $marcado = true;
                                                        break;
                                                    }
                                                }

                                                if ($marcado) {
                                                    $sub_modalidadesMarcados[] = $sub_modalidade;
                                                } else {
                                                    $sub_modalidadesNaoMarcados[] = $sub_modalidade;
                                                }
                                            }

                                            usort($sub_modalidadesNaoMarcados, function ($a, $b) {
                                                return strcmp($a['nome'], $b['nome']);
                                            });

                                            $sub_modalidadesOrdenados = array_merge($sub_modalidadesMarcados, $sub_modalidadesNaoMarcados);

                                            $i = 0;
                                            foreach ($sub_modalidadesOrdenados as $sub_modalidade) :
                                            ?>
                                                <tr>
                                                    <td class="align-middle" scope="row"><?php echo ++$i; ?></td>
                                                    <td class="align-middle"><?php
                                                                                $id = $sub_modalidade['id_modalidades'];
                                                                                $sql = "SELECT nome FROM modalidades WHERE id = $id";

                                                                                $result = $mysqli->query($sql);

                                                                                if ($result->num_rows > 0) {

                                                                                    $row = $result->fetch_assoc();

                                                                                    $nome = $row["nome"];

                                                                                    echo "$nome";
                                                                                }
                                                                                ?></td>
                                                    <td class="align-middle"><?php echo $sub_modalidade['nome']; ?></td>
                                                    <td class="align-middle">
                                                        <input id="switch" data-modalidade="<?php echo $sub_modalidade['id_modalidades'] ?>" data-id="<?php echo $sub_modalidade['id'] ?>" type="checkbox" class="js-switch" <?php
                                                                                                                                                                                                                                foreach ($algo as $item) :

                                                                                                                                                                                                                                    if ($item['id_sub'] == $sub_modalidade['id']) {
                                                                                                                                                                                                                                        echo $item['verificar'] ? "checked" : '';
                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                endforeach;
                                                                                                                                                                                                                                ?> />
                                                    </td>
                                                    <td class="align-middle d-flex justify-content-center">
                                                        <form style="margin: 0px;" action="detalhesModalidades.php?id=<?php echo $sub_modalidade['id_modalidades'] ?>" method="post">
                                                            <input type="text" name="nome_modalidade" value="<?php
                                                                                                                $id = $sub_modalidade['id_modalidades'];
                                                                                                                $sql = "SELECT nome FROM modalidades WHERE id = $id";

                                                                                                                $result = $mysqli->query($sql);

                                                                                                                if ($result->num_rows > 0) {

                                                                                                                    $row = $result->fetch_assoc();

                                                                                                                    $nome = $row["nome"];

                                                                                                                    echo "$nome";
                                                                                                                }
                                                                                                                ?>" hidden="true">
                                                            <a href="javascript:void(0);" onclick="submitForm(this);" class="fa fa-eye" style="border:none; background-color:transparent;" type="submit" name="enviar_nome_modalidade" id="<?php echo $sub_modalidade['id_modalidades'] ?>"></a>
                                                        </form>
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

            <?php include("scripts.php") ?>


            <!-- Checkbox -->
            <script>
                //Modalidade
                $(document).on('change', '#switch', function() {
                    const lido = this.checked ? 1 : 0;
                    const medico = <?php echo $_GET['id'] ?>;
                    const sub_modalidade = this.dataset.id;
                    const modalidade = this.dataset.modalidade;
                    if (this.checked == 1) {
                        console.log(lido);
                        console.log(medico);
                        console.log(sub_modalidade);
                        console.log(modalidade);
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/medicosBanco.php?salvar-modalidade-medico",
                            data: {
                                id_medico: medico,
                                id_modalidade: modalidade,
                                id_submodalidade: sub_modalidade
                            },
                            dataType: "JSON",
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }

                    if (this.checked == 0) {
                        console.log(lido);
                        console.log(medico);
                        console.log(sub_modalidade);
                        console.log(modalidade);
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/medicosBanco.php?modificar-modalidade-medico",
                            data: {
                                id_medico: medico,
                                id_modalidade: modalidade,
                                id_submodalidade: sub_modalidade
                            },
                            dataType: "JSON",
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }
                });
            </script>
            <!-- /Checkbox -->

        </div>
    </div>





</body>

</html>