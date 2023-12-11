<?php
session_start();
ob_start();
include_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';
$mail = new PHPMailer(true);

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
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    if (!empty($dados['SendRecupSenha'])) {
                        //var_dump($dados);
                        $query_usuario = "SELECT id, nome, email 
                    FROM usuarios 
                    WHERE email =:email  
                    LIMIT 1";
                        $result_usuario = $conn->prepare($query_usuario);
                        $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                        $result_usuario->execute();

                        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                            $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
                            //echo "Chave $chave_recuperar_senha <br>";

                            $query_up_usuario = "UPDATE usuarios 
                        SET recuperar_senha =:recuperar_senha 
                        WHERE id =:id 
                        LIMIT 1";
                            $result_up_usuario = $conn->prepare($query_up_usuario);
                            $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
                            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                            if ($result_up_usuario->execute()) {
                                $link = "http://localhost/escala/recuperar/atualizar_senha.php?chave=$chave_recuperar_senha";


                                try {
                                    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                                    $mail->CharSet = 'UTF-8';
                                    $mail->isSMTP();
                                    $mail->Host       = 'sandbox.smtp.mailtrap.io';
                                    $mail->SMTPAuth   = true;
                                    $mail->Username   = '5f0fb787f0b79e';
                                    $mail->Password   = 'c208558deece3b';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port       = 2525;

                                    $mail->setFrom('john@gmail.com', 'Atendimento');
                                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']);

                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = 'Recuperar senha';
                                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] . ".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] . "\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                                    $mail->send();

                                    $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
                                    header("Location: ../index.php");
                                } catch (Exception $e) {
                                    echo "E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
                                }
                            } else {
                                echo  "<p style='color: #ff0000'>Tente novamente!</p>";
                            }
                        } else {
                            echo "<p style='color: #ff0000'>Usuário não encontrado!</p>";
                        }
                    }
                    ?>

                    <form method="POST" action="" data-parsley-validate>
                        <h1>Recuperar Senha</h1>
                        <?php
                        if (isset($_SESSION['msg_rec'])) {
                            echo $_SESSION['msg_rec'];
                            unset($_SESSION['msg_rec']);
                        }
                        $usuario = "";
                        if (isset($dados['email'])) {
                            $usuario = $dados['email'];
                        } ?>

                        <div class="field item form-group">
                            <input name="email" type="email" class="form-control" placeholder="email" required="" value="<?php echo $usuario; ?>" />
                        </div>

                        <div>
                            <input class="btn btn-default" type="submit" value="Recuperar" name="SendRecupSenha">
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