<?php include("banco_de_dados/loginBanco.php");?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ammo Escala</title>
    <?php include("links.php") ?>
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="" method="POST" data-parsley-validate>
                        <h1>Entrar</h1>
                        <?php 
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                        <div class="field item form-group">
                            <input name="email" type="email" class="form-control" placeholder="email" required="" />
                        </div>
                        <div class="field item form-group">
                            <input name="senha" type="password" class="form-control" placeholder="senha" required="" />
                        </div>
                        <div>
                            <button name="entrar" class="btn btn-default submit">Acessar</button>
                            <a class="reset_pass" href="recuperar/recuperar_senha.php">Esqueceu sua senha?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1>Ammo Escala</h1>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>


    <!-- Javascript functions	-->
    <?php include("scripts.php"); ?>
</body>

</html>