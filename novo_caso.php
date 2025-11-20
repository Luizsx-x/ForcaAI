<?php
include("conexao.php");
session_start();

$adv = $_SESSION['advogado_id'];
$titulo = $_POST['titulo'];
$status = $_POST['status'];

$conn->query("INSERT INTO casos (advogado_id, titulo, status) VALUES ($adv, '$titulo', '$status')");

header("Location: advogado.php");
