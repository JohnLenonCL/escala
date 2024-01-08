<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/medicosBanco.php");
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
                                    <h2>Cadastro de Médicos</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form data-parsley-validate>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Nome completo<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" id="nome" name="nome" data-validate-length-range="6" data-validate-words="2" name="name" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group ">
                                            <label class="col-form-label col-3 label-align">Email<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" id="email" name="email" class='email' required="required" type="email" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">CPF <span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" type="text" minlength="14" maxlength="14" name="cpf" id="cpf" required="required">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Senha<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" minlength="6" type="password" id="password1" name="password" required />

                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Repita sua senha<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" data-parsley-equalto="#password1" minlength="6" type="password" id="password2" name="password2" data-validate-linked='password' required='required' data-parsley-equalto="#password1" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Cor<span class="required">*</span></label>
                                            <div style="width: 80px; padding-right: 15px; padding-left: 15px;">
                                                <input class="form-control" type="color" id="favcolor" name="favcolor" value="#264B6D" required="required">
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' id="enviar" name="enviar" class="btn btn-success">Enviar</button>
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
    <script src="vendors/validator/multifield.js"></script>
    <script src="vendors/validator/validator.js"></script>

    <script>
        function formatCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            return cpf;
        }

        document.getElementById('cpf').addEventListener('input', function(event) {
            var input = event.target;
            input.value = formatCPF(input.value);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                const nome = document.getElementById('nome').value;
                const email = document.getElementById('email').value;
                const cpf = document.getElementById('cpf').value;
                const password1 = document.getElementById('password1').value;
                const password2 = document.getElementById('password2').value;
                const cor = document.getElementById('favcolor').value;

                e.preventDefault();

                if (password1 == password2) {
                    const password = password1;
                    $.ajax({
                        type: 'POST',
                        url: 'banco_de_dados/medicosBanco.php?enviar',
                        data: {
                            nome: nome,
                            email: email,
                            cpf: cpf,
                            password: password,
                            cor: cor
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                new PNotify({
                                    title: 'Cadastro',
                                    text: response.message,
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });

                                document.getElementById('nome').value = "";
                                document.getElementById('email').value = "";
                                document.getElementById('cpf').value = "";
                                document.getElementById('password1').value = "";
                                document.getElementById('password2').value = "";
                                document.getElementById('favcolor').value = "#264B6D";
                            } else {
                                new PNotify({
                                    title: 'Cadastro',
                                    text: response.message,
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Erro na requisição AJAX:', textStatus, errorThrown);
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>