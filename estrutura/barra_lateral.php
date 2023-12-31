<!-- sidebar menu -->
<div class="navbar nav_title" style="border: 0;">
    <a href="listaClinicas.php" class="site_title d-flex justify-content-center align-items-center"> <i class="fa fa-table"></i> <span style="margin-right: 10px;"></span> <span>AMMO - Escala</span>  </a>
</div>

<div class="clearfix"></div>

<br/>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Clínicas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="cadastroClinicas.php">Cadastro</a></li>
                    <li><a href="listaClinicas.php">Lista</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-certificate"></i> Modalidades <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="cadastroModalidades.php">Cadastro</a></li>
                    <li><a href="listaModalidades.php">Lista</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user-md"></i> Médicos <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="cadastroMedicos.php">Cadastro</a></li>
                    <li><a href="listaMedicos.php">Lista</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user"></i> Usuários <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="cadastroUsuarios.php">Cadastro</a></li>
                    <li><a href="listaUsuarios.php">Lista</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-calendar"></i> Calendário <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    $clinica = $mysqli->query("SELECT * FROM clinicas");
                    foreach ($clinica as $clinica) {?>
                    <li><a href="calendario.php?clinica=<?php echo $clinica["id"]?>"><?php echo $clinica["nome"]?></a></li>
                    <?php }?>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->