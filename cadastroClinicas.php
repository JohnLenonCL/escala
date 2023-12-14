<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/clinicasBanco.php");
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
            <div class="col-md-3 left_col menu_fixed">
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
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Cadastro de Clínicas</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="formulario" data-parsley-validate>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3  label-align">Nome<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input id="nome" class="form-control" name="nome" required="required" />
                                            </div>
                                        </div>

                                        <div class="field item form-group">
                                            <label class="col-form-label col-3  label-align">Endereço<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input id="endereco" class="form-control" name="endereco" required="required" />
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' name="enviar" class="btn btn-success">Enviar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <?php include("scripts.php"); ?>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                const nome = document.getElementById('nome').value;
                const endereco = document.getElementById('endereco').value;
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'banco_de_dados/clinicasBanco.php?enviar',
                    data: {
                        nome: nome,
                        endereco: endereco,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        console.log(response.status);
                        if (response.status === 'success') {
                            new PNotify({
                                title: 'Cadastro',
                                text: response.message,
                                type: 'success',
                                styling: 'bootstrap3'
                            });

                            document.getElementById('nome').value = "";
                            document.getElementById('endereco').value = "";
                        }
                    },

                });
            });
        });
    </script>


</body>

</html>