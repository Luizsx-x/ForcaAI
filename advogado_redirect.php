<?php
session_start();

// Se já estiver logado como advogado, vai direto pro painel
if (isset($_SESSION['advogado_logged']) && $_SESSION['advogado_logged'] === true) {
    header("Location: advogado.php");
    exit();
}

// Se não estiver logado, vai pro login com a aba de advogado ativa
header("Location: login.php");
exit();
