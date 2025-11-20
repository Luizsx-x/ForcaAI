<?php
include "conexao.php";
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE id=$id";
$res = $conn->query($sql);
$cliente = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $conn->query("UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id");
  header("Location: painel_admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="cssadmin.css">
</head>
<body class="fade-transition loaded">
<nav id="menu">
  <ul>
    <li class="logo"><img src="logo.png" alt="Força Jurídica"></li>
    <li><a href="painel_admin.php">Voltar</a></li>
  </ul>
</nav>

<div class="container">
  <div class="admin-container">
    <h1>✏️ Editar Cliente</h1>
    <form method="POST">
      <label>Nome:</label><br>
      <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required><br><br>

      <label>Email:</label><br>
      <input type="email" name="email" value="<?= $cliente['email'] ?>" required><br><br>

      <label>Telefone:</label><br>
      <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>" required><br><br>

      <button type="submit" class="btn-aprovar">Salvar</button>
    </form>
  </div>
</div>
</body>
</html>
