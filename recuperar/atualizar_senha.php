<?php
session_start();
ob_start();
include_once 'conexao.php';
?>

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
                    <?php
                    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


                    if (!empty($chave)) {
                        //var_dump($chave);

                        $query_usuario = "SELECT id 
                            FROM usuarios 
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";
                        $result_usuario = $conn->prepare($query_usuario);
                        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
                        $result_usuario->execute();

                        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            //var_dump($dados);
                            if (!empty($dados['SendNovaSenha'])) {
                                $senha_usuario = password_hash($dados['senha'], PASSWORD_DEFAULT);
                                $recuperar_senha = 'NULL';

                                $query_up_usuario = "UPDATE usuarios 
                        SET senha =:senha,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                                $result_up_usuario = $conn->prepare($query_up_usuario);
                                $result_up_usuario->bindParam(':senha', $senha_usuario, PDO::PARAM_STR);
                                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                                if ($result_up_usuario->execute()) {
                                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                                    header("Location: ../index.php");
                                } else {
                                    echo "<p style='color: #ff0000'>Tente novamente!</p>";
                                }
                            }
                        } else {
                            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Solicite novo link para atualizar a senha!</p>";
                            header("Location: recuperar_senha.php");
                        }
                    } else {
                        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Solicite novo link para atualizar a senha!</p>";
                        header("Location: recuperar_senha.php");
                    }

                    ?>

                    <form method="POST" action="" data-parsley-validate>
                        <h1>Atualizar Senha</h1>

                        <?php
                        $usuario = "";
                        if (isset($dados['senha'])) {
                            $usuario = $dados['senha'];
                        } ?>

                        <div class="field item form-group">
                            <input class="form-control" type="password" name="senha" placeholder="Digite a nova senha" required="" value="<?php echo $usuario; ?>"><br><br>
                        </div>
                        <div>
                            <input class="btn btn-default" type="submit" value="Atualizar" name="SendNovaSenha">
                            <a class="reset_pass" href="../index.php">Lembrou da senha?</a>
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
