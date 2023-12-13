<?php
session_abort();
session_start();
include("estrutura/verificar_login.php");
include("banco_de_dados/loginBanco.php");
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
                                    <h2>Alterar Senha</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form id="trocaSenhaForm" class="" action="" method="post" data-parsley-validate>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3  label-align">Senha Atual<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input type="password" class="form-control" id="senhaAntiga" required>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3  label-align">Nova Senha<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input type="password" class="form-control" id="novaSenha" required>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" class="btn btn-success">Trocar Senha</button>
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
            <!-- /page content -->

        </div>
    </div>


    <?php include("scripts.php"); ?>

    <!-- Javascript functions	-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trocaSenhaForm = document.getElementById('trocaSenhaForm');

            trocaSenhaForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const senhaAntiga = document.getElementById('senhaAntiga').value;
                const novaSenha = document.getElementById('novaSenha').value;

                console.log('Senha Antiga:', senhaAntiga);
                console.log('Nova Senha:', novaSenha);

                $.ajax({
                    type: "POST",
                    url: "banco_de_dados/loginBanco.php?trocarSenha",
                    data: {
                        senhaAntiga: senhaAntiga,
                        novaSenha: novaSenha

                    },
                    success: function(response) {
                        if (response === "SenhaAntigaIncorreta") {
                            alert("Senha antiga incorreta. Tente novamente.");
                        } else if (response === "SenhaAntigaTrocada") {
                            new PNotify({
                                title: 'SENHA',
                                text: 'Sua senha foi alterada com sucesso!',
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