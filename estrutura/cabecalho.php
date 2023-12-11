<?php
session_abort();
if (!isset($_SESSION)) {
    session_start();
}

include("banco_de_dados/loginBanco.php");
include("banco_de_dados/imagemBanco.php");
?>


<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle mb-3">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php
                                    if (isset($_SESSION['nome'])) {
                                        $nomeUsuario = $_SESSION['nome'];
                                        $sql = "SELECT icone_nome FROM usuarios WHERE nome = '$nomeUsuario'";
                                        $result = $mysqli->query($sql);
                                        if ($result) {
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $icone_nome = $row['icone_nome'];
                                                if ($icone_nome != "") {
                                                    echo $icone_nome;
                                                } else {
                                                    echo 'imagens/icones/icone-usuario-sem-login.png';
                                                }
                                            }
                                            $result->free_result();
                                        }
                                    }
                                    ?>" alt=""><?php echo $_SESSION['nome'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="trocarFoto.php"> Mudar foto de perfil</a>
                        <a class="dropdown-item" href="trocarSenha.php">Trocar senha</a>
                        <a href="estrutura/sair_login.php" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Sair da conta</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>