<?php
include("estrutura/verificar_login.php");
include("banco_de_dados/modalidadesBanco.php");
include("banco_de_dados/medicosBanco.php");
include("banco_de_dados/usuariosBanco.php");

// modalidade
if (isset($_GET['modalidade']) and isset($_POST['atualizar'])) {
    $id_modalidade = intval($_GET['modalidade']);
    $nome_modalidade = trim($_POST['nome']);

    $stmt = $mysqli->prepare("UPDATE modalidades SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $nome_modalidade, $id_modalidade);

    $stmt->execute();

    $stmt->close();

    echo '<script>window.location.href = window.location.href;</script>';
}


// medico
if (isset($_GET['medico']) and isset($_POST['atualizar'])) {
    $id_medico = intval($_GET['medico']);
    $nome_medico = trim($_POST['nome']);
    $email_medico = trim($_POST['email']);
    $cpf_medico = trim($_POST['cpf']);
    $senha_medico = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cor = $_POST['favcolor'];

    $stmt = $mysqli->prepare("UPDATE medicos SET nome = ?, email = ?, cpf = ?, senha = ?, cor = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nome_medico, $email_medico, $cpf_medico, $senha_medico, $cor, $id_medico);

    $stmt->execute();

    $stmt->close();

    echo '<script>window.location.href = window.location.href;</script>';
}


// usuario
if (isset($_GET['usuario']) and isset($_POST['atualizar'])) {
    $id_usuario = intval($_GET['usuario']);
    $nome_usuario = trim($_POST['nome']);
    $email_usuario = trim($_POST['email']);
    $cpf_usuario = trim($_POST['cpf']);
    $senha_usuario = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE usuarios SET nome = ?, email = ?, cpf = ?, senha = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nome_usuario, $email_usuario, $cpf_usuario, $senha_usuario, $id_usuario);

    $stmt->execute();

    $stmt->close();

    echo '<script>window.location.href = window.location.href;</script>';
}

// clinica
if (isset($_GET['clinica']) and isset($_POST['atualizar'])) {
    $id_clinica = intval($_GET['clinica']);
    $nome_clinica = trim($_POST['nome']);
    $endereco_clinica = trim($_POST['endereco']);

    $stmt = $mysqli->prepare("UPDATE clinicas SET nome = ?, endereco = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome_clinica, $endereco_clinica, $id_clinica);

    $stmt->execute();

    $stmt->close();

    echo '<script>window.location.href = window.location.href;</script>';
}


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

            <!-- modalidade -->
            <?php if (isset($_GET['modalidade'])) { ?>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Atualizar Modalidade</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="" action="" method="post" data-parsley-validate>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Nome<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="nome" required="required" value="<?php
                                                                                                                        $id = $_GET['modalidade'];
                                                                                                                        $sql = "SELECT nome FROM modalidades WHERE id = $id";

                                                                                                                        $result = $mysqli->query($sql);

                                                                                                                        if ($result->num_rows > 0) {

                                                                                                                            $row = $result->fetch_assoc();

                                                                                                                            $nome = $row["nome"];

                                                                                                                            echo "$nome";
                                                                                                                        }
                                                                                                                        ?>" />
                                                </div>
                                            </div>
                                            <div class="ln_solid">
                                                <div class="form-group">
                                                    <div class="col-md-6 offset-md-3">
                                                        <button type='submit' name="atualizar" class="btn btn-success">Atualizar</button>
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
            <?php } ?>
            <!-- /modalidade -->

            <!-- medico -->
            <?php if (isset($_GET['medico'])) { ?>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Atualizar Médico</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="" action="" method="post" data-parsley-validate>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Nome completo<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="nome" data-validate-length-range="6" data-validate-words="2" name="name" required="required" value="<?php
                                                                                                                                                                                            $id = $_GET['medico'];
                                                                                                                                                                                            $sql = "SELECT nome FROM medicos WHERE id = $id";

                                                                                                                                                                                            $result = $mysqli->query($sql);

                                                                                                                                                                                            if ($result->num_rows > 0) {

                                                                                                                                                                                                $row = $result->fetch_assoc();

                                                                                                                                                                                                $nome = $row["nome"];

                                                                                                                                                                                                echo "$nome";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>" />
                                                </div>
                                            </div>
                                            <div class="field item form-group ">
                                                <label class="col-form-label col-3 label-align">Email<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="email" class='email' required="required" type="email" value="<?php
                                                                                                                                                    $id = $_GET['medico'];
                                                                                                                                                    $sql = "SELECT email FROM medicos WHERE id = $id";

                                                                                                                                                    $result = $mysqli->query($sql);

                                                                                                                                                    if ($result->num_rows > 0) {

                                                                                                                                                        $row = $result->fetch_assoc();

                                                                                                                                                        $email = $row["email"];

                                                                                                                                                        echo "$email";
                                                                                                                                                    }
                                                                                                                                                    ?>" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">CPF <span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="text" data-validate-length-range="14" name="cpf" id="cpf" maxlength="14" required="required" value="<?php
                                                                                                                                                                                            $id = $_GET['medico'];
                                                                                                                                                                                            $sql = "SELECT cpf FROM medicos WHERE id = $id";

                                                                                                                                                                                            $result = $mysqli->query($sql);

                                                                                                                                                                                            if ($result->num_rows > 0) {

                                                                                                                                                                                                $row = $result->fetch_assoc();

                                                                                                                                                                                                $cpf = $row["cpf"];

                                                                                                                                                                                                echo "$cpf";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>">
                                                    <span style="color:#E74C3C;" id="msgcpf"></span>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Senha<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="password1" name="password" required />

                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Repita sua senha<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="password2" name="password2" data-validate-linked='password' required='required' />
                                                    <span id="msgsenha" style="color:#E74C3C;"></span>
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
                                                        <button type='submit' id="enviar" name="atualizar" class="btn btn-success">Atualizar</button>
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

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var form = document.querySelector('form');

                        form.addEventListener('submit', function(event) {
                            var password1 = document.getElementById('password1').value;
                            var password2 = document.getElementsByName('password2')[0].value;

                            if (password1 !== password2) {
                                document.getElementById('msgsenha').innerText = 'As senhas devem ser iguais';
                                event.preventDefault();
                            }
                        });
                    });
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

                    document.getElementById('enviar').addEventListener('click', function() {
                        var cpfInput = document.getElementById('cpf');
                        var msgCpf = document.getElementById('msgcpf');

                        var cpfValue = cpfInput.value.replace(/\D/g, '');

                        if (cpfValue.length !== 11 && cpfValue.length >= 1) {

                            msgCpf.textContent = 'CPF incompleto';
                        } else {

                            msgCpf.textContent = '';

                        }
                    });
                </script>
            <?php } ?>
            <!-- /medico -->

            <!-- usuario -->
            <?php if (isset($_GET['usuario'])) { ?>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Atualizar Usuário</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="" action="" method="post" data-parsley-validate>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Nome completo<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="nome" data-validate-length-range="6" data-validate-words="2" name="name" required="required" value="<?php
                                                                                                                                                                                            $id = $_GET['usuario'];
                                                                                                                                                                                            $sql = "SELECT nome FROM usuarios WHERE id = $id";

                                                                                                                                                                                            $result = $mysqli->query($sql);

                                                                                                                                                                                            if ($result->num_rows > 0) {

                                                                                                                                                                                                $row = $result->fetch_assoc();

                                                                                                                                                                                                $nome = $row["nome"];

                                                                                                                                                                                                echo "$nome";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>" />
                                                </div>
                                            </div>
                                            <div class="field item form-group ">
                                                <label class="col-form-label col-3 label-align">Email<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="email" class='email' required="required" type="email" value="<?php
                                                                                                                                                    $id = $_GET['usuario'];
                                                                                                                                                    $sql = "SELECT email FROM usuarios WHERE id = $id";

                                                                                                                                                    $result = $mysqli->query($sql);

                                                                                                                                                    if ($result->num_rows > 0) {

                                                                                                                                                        $row = $result->fetch_assoc();

                                                                                                                                                        $email = $row["email"];

                                                                                                                                                        echo "$email";
                                                                                                                                                    }
                                                                                                                                                    ?>" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">CPF <span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="text" data-validate-length-range="14" name="cpf" id="cpf" maxlength="14" required="required" value="<?php
                                                                                                                                                                                            $id = $_GET['usuario'];
                                                                                                                                                                                            $sql = "SELECT cpf FROM usuarios WHERE id = $id";

                                                                                                                                                                                            $result = $mysqli->query($sql);

                                                                                                                                                                                            if ($result->num_rows > 0) {

                                                                                                                                                                                                $row = $result->fetch_assoc();

                                                                                                                                                                                                $cpf = $row["cpf"];

                                                                                                                                                                                                echo "$cpf";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>">
                                                    <span style="color:#E74C3C;" id="msgcpf"></span>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Senha<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="password1" name="password" required />

                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Repita sua senha<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="password2" name="password2" data-validate-linked='password' required='required' />
                                                    <span id="msgsenha" style="color:#E74C3C;"></span>
                                                </div>
                                            </div>
                                            <div class="ln_solid">
                                                <div class="form-group">
                                                    <div class="col-md-6 offset-md-3">
                                                        <button type='submit' id="enviar" name="atualizar" class="btn btn-success">Atualizar</button>
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

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var form = document.querySelector('form');

                        form.addEventListener('submit', function(event) {
                            var password1 = document.getElementById('password1').value;
                            var password2 = document.getElementsByName('password2')[0].value;

                            if (password1 !== password2) {
                                document.getElementById('msgsenha').innerText = 'As senhas devem ser iguais';
                                event.preventDefault();
                            }
                        });
                    });
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

                    document.getElementById('enviar').addEventListener('click', function() {
                        var cpfInput = document.getElementById('cpf');
                        var msgCpf = document.getElementById('msgcpf');

                        var cpfValue = cpfInput.value.replace(/\D/g, '');

                        if (cpfValue.length !== 11 && cpfValue.length >= 1) {

                            msgCpf.textContent = 'CPF incompleto';
                        } else {

                            msgCpf.textContent = '';

                        }
                    });
                </script>
            <?php } ?>
            <!-- /usuario -->

            <!-- clinica -->
            <?php if (isset($_GET['clinica'])) { ?>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Atualizar Clínica</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="" action="" method="post" data-parsley-validate>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Nome<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="nome" required="required" value="<?php
                                                                                                                        $id = $_GET['clinica'];
                                                                                                                        $sql = "SELECT nome FROM clinicas WHERE id = $id";

                                                                                                                        $result = $mysqli->query($sql);

                                                                                                                        if ($result->num_rows > 0) {

                                                                                                                            $row = $result->fetch_assoc();

                                                                                                                            $nome = $row["nome"];

                                                                                                                            echo "$nome";
                                                                                                                        }
                                                                                                                        ?>" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-3 label-align">Endereço<span class="required">*</span></label>
                                                <div class="col-6">
                                                    <input class="form-control" name="endereco" required="required" value="<?php
                                                                                                                            $id = $_GET['clinica'];
                                                                                                                            $sql = "SELECT endereco FROM clinicas WHERE id = $id";

                                                                                                                            $result = $mysqli->query($sql);

                                                                                                                            if ($result->num_rows > 0) {

                                                                                                                                $row = $result->fetch_assoc();

                                                                                                                                $endereco = $row["endereco"];

                                                                                                                                echo "$endereco";
                                                                                                                            }
                                                                                                                            ?>" />
                                                </div>
                                            </div>
                                            <div class="ln_solid">
                                                <div class="form-group">
                                                    <div class="col-md-6 offset-md-3">
                                                        <button type='submit' name="atualizar" class="btn btn-success">Atualizar</button>
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
            <?php } ?>
            <!-- /clinica -->


        </div>
    </div>
    <?php include("scripts.php"); ?>


    <script>
        $(document).ready(function() {
            var sucessoAoRecarregar = localStorage.getItem('sucessoAoRecarregar');
            if (sucessoAoRecarregar) {
                new PNotify({
                    title: 'Atualizar',
                    text: 'Atualização realizada com sucesso!',
                    type: 'success',
                    styling: 'bootstrap3'
                });

                localStorage.removeItem('sucessoAoRecarregar');
            }

            $('form').submit(function(e) {
                var respostaDoServidor = {
                    success: true,
                    message: 'Atualização realizada com sucesso!'
                };

                if (respostaDoServidor.success) {
                    localStorage.setItem('sucessoAoRecarregar', 'true');
                } else {
                    console.error('Erro no envio do formulário');
                }
            });
        });
    </script>



</body>

</html>