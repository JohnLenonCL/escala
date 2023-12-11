<?php include("estrutura/verificar_login.php");?>

<style>
    #indicador {
    font-size: 20px;
    position: absolute;
    top: 20px;
    right: 30px;
    z-index: 2;
    opacity: 1;
    transition: opacity 1s ease;
}
</style>
<!-- Alerta de envio -->

<div id="indicador" class="alert alert-success" role="alert">
    Cadastro enviado com sucesso!
</div>
<script>
setTimeout(function() {
    var alerta = document.getElementById("indicador");
    alerta.style.opacity = "0";
    setTimeout(function() {
        alerta.style.display = "none";
    }, 1000);
}, 3000);
</script>
<!-- /Alerta de envio -->