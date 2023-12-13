<?php
session_abort();
session_start();
include("estrutura/verificar_login.php");
include("banco_de_dados/imagemBanco.php");
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
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Alterar Foto</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form id="form" class="" action="" method="POST" data-parsley-validate>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3  label-align">Insira uma imagem<span class="required">*</span></label>
                                            <div class="col-6 ">
                                                <input style="padding-bottom: 35px; " type="file" class="form-control" id="foto" required>
                                                <span id="msg"></span>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button name="enviarfoto" type="submit" class="btn btn-success">Trocar Foto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

        </div>
    </div>


    <?php include("scripts.php"); ?>

    <!-- Javascript functions	-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trocaFotoForm = document.getElementById('form');
            trocaFotoForm.addEventListener('submit', function(event) {

                event.preventDefault();

                const foto = document.getElementById('foto').files[0];

                const formData = new FormData();
                formData.append('foto', foto);

                $.ajax({
                    type: "POST",
                    url: "banco_de_dados/imagemBanco.php?trocarImagem",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == "Não é uma imagem") {
                            document.getElementById('msg').innerHTML = "O arquivo selecionado não é uma imagem!";
                            document.getElementById('msg').style.color = "red";
                        }
                        if (response == "Imagem alterada com sucesso") {
                            new PNotify({
                                title: 'IMAGEM',
                                text: 'Sua imagem foi alterada com sucesso',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1100);
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>