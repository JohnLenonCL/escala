<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/clinicasBanco.php");
include("banco_de_dados/modalidadesBanco.php");
include("banco_de_dados/detalhesClinicaBanco.php");
$modalidades = $mysqli->query("SELECT * FROM modalidades");
$clinicas = $mysqli->query("SELECT * FROM clinicas");
$medicos = $mysqli->query("SELECT * FROM medicos");
$clinica_id = $_GET['id'];
$algo = $mysqli->query("SELECT * FROM detalhes_clinica WHERE id_clinica = '$clinica_id'");
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
                        <h3>Detalhes da Clínica "<?php
                                                    $id = $_GET['id'];
                                                    $sql = "SELECT nome FROM clinicas WHERE id = $id";

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
                                <h2>Modalidades</h2>
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
                                                <th>Nome</th>
                                                <th style="width: 0px;">Ativo</th>
                                                <th style="width: 0px;">Detalhes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($modalidades as $modalidades) :

                                            ?>
                                                <tr>
                                                    <td class="align-middle" scope="row"><?php echo ++$i; ?></td>
                                                    <td class="align-middle"> <?php echo $modalidades['nome']; ?></td>
                                                    <td class="align-middle d-flex justify-content-center">
                                                        <input id="switch" data-id="<?php echo $modalidades['id'] ?>" type="checkbox" class="js-switch" <?php
                                                                                                                                                        foreach ($algo as $item) :

                                                                                                                                                            if ($item['id_modalidade'] == $modalidades['id']) {
                                                                                                                                                                echo $item['verificar'] ? "checked" : '';
                                                                                                                                                            }

                                                                                                                                                        endforeach;
                                                                                                                                                        ?> />
                                                    </td>
                                                    <td>
                                                        <form style="margin: 0px;" action="detalhesModalidades.php?id=<?php echo $modalidades['id'] ?>" method="post">
                                                            <input type="text" name="nome_modalidade" value="<?php echo $modalidades['nome']; ?>" hidden="true">
                                                            <button class="fa fa-eye d-flex m-auto" style="border:none; background-color:transparent;" type="submit" name="enviar_nome_modalidade" id="<?php echo $modalidades['id'] ?>"></button>
                                                        </form>
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

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Médicos</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="d-flex justify-content-end mr-2"><a href="cadastroMedicos.php" class='btn btn-secondary'>Cadastrar médicos</a></div>
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive-medicos" class="table table-striped table-bordered dt-responsive nowrap compact" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 0px;">#</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>CPF</th>
                                                <th style="width: 0px;">Ativo</th>
                                                <th style="width: 0px;">Detalhes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($medicos as $medicos) :

                                            ?>
                                                <tr id="<?php echo $medicos['id'] ?>">
                                                    <td class="align-middle" scope="row"><?php echo ++$i; ?></td>
                                                    <td class="align-middle"> <?php echo $medicos['nome']; ?></td>
                                                    <td><?php echo $medicos['email']; ?></td>
                                                    <td><?php echo $medicos['cpf']; ?></td>
                                                    <td class="d-flex justify-content-center">
                                                        <input id="switch-medico" data-id="<?php echo $medicos['id'] ?>" type="checkbox" class="js-switch" <?php
                                                                                                                                                            foreach ($algo as $item) :

                                                                                                                                                                if ($item['id_medico'] == $medicos['id']) {
                                                                                                                                                                    echo $item['verificar'] ? "checked" : '';
                                                                                                                                                                }

                                                                                                                                                            endforeach;
                                                                                                                                                            ?> />
                                                    </td>
                                                    <td>
                                                        <form style="margin: 0px;" action="detalhesMedicos.php?id=<?php echo $medicos['id'] ?>" method="post">
                                                            <input type="text" name="nome_medico" value="<?php echo $medicos['nome']; ?>" hidden="true">
                                                            <button class="fa fa-eye d-flex m-auto" style="border:none; background-color:transparent;" type="submit" name="enviar_nome_medico" id="<?php echo $medicos['id'] ?>"></button>
                                                        </form>
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

            <?php include("scripts.php") ?>


            <!-- Checkbox -->
            <script>
                //Modalidade
                $(document).on('change', '#switch', function() {
                    const lido = this.checked ? 1 : 0;
                    const clinica = <?php echo $_GET['id'] ?>;
                    const modalidade = this.dataset.id;
                    if (this.checked == 1) {
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/detalhesClinicaBanco.php?salvar",
                            data: {
                                id_clinica: clinica,
                                id_modalidade: modalidade
                            },
                            dataType: "JSON"
                        });
                    }

                    if (this.checked == 0) {
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/detalhesClinicaBanco.php?modificar",
                            data: {
                                id_clinica: clinica,
                                id_modalidade: modalidade
                            },
                            dataType: "JSON"
                        });
                    }
                });

                //Medico
                $(document).on('change', '#switch-medico', function() {
                    const lido = this.checked ? 1 : 0;
                    const clinica = <?php echo $_GET['id'] ?>;
                    const medico = this.dataset.id;
                    if (this.checked == 1) {
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/medicosBanco.php?salvar",
                            data: {
                                id_clinica: clinica,
                                id_medico: medico
                            },
                            dataType: "JSON"
                        });
                    }

                    if (this.checked == 0) {
                        $.ajax({
                            type: "POST",
                            url: "banco_de_dados/medicosBanco.php?modificar",
                            data: {
                                id_clinica: clinica,
                                id_medico: medico
                            },
                            dataType: "JSON"
                        });
                    }
                });
            </script>
            <!-- /Checkbox -->

        </div>
    </div>

</body>

</html>