<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/usuariosBanco.php");
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
                                    <h2>Cadastro de Usuários</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="" action="" method="post" novalidate>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Nome completo<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" name="nome" data-validate-length-range="6" data-validate-words="2" name="name" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group ">
                                            <label class="col-form-label col-3 label-align">Email<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" name="email" class='email' required="required" type="email" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">CPF <span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" type="text" data-validate-length-range="14" name="cpf" id="cpf" maxlength="14" required="required">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Senha<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" type="password" id="password1" name="password" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />


                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-3 label-align">Repita sua senha<span class="required">*</span></label>
                                            <div class="col-6">
                                                <input class="form-control" type="password" name="password2" data-validate-linked='password' required='required' />
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' name="enviar" class="btn btn-success">Enviar</button>
                                                    <button type='reset' class="btn btn-secondary">Resetar</button>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="fornecedores/validator/multifield.js"></script>
    <script src="fornecedores/validator/validator.js"></script>

    <!-- Funcoes Javascript	-->

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