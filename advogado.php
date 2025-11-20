<?php
session_start();
require_once 'conexao/conexao.php';

// Verifica se o advogado está logado
if (!isset($_SESSION['advogado_logged']) || !$_SESSION['advogado_logged']) {
    header("Location: login.php");
    exit();
}

$advogado_id = $_SESSION['advogado_id'] ?? 0;

// Buscar dados do advogado
$adv = $conn->query("SELECT nome FROM advogados WHERE id = $advogado_id")->fetch_assoc();

// Inicializa variáveis de tabelas
$casos = $conn->query("SELECT * FROM casos WHERE advogado_id = $advogado_id") ?: [];
$clientes = $conn->query("SELECT * FROM clientes") ?: [];
$agenda = $conn->query("SELECT * FROM agenda WHERE advogado_id = $advogado_id ORDER BY data ASC") ?: [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Advogado</title>
  <link rel="stylesheet" href="advogado.css">
</head>
<body>

<div class="container">

  <!-- MENU -->
  <nav id="menu"> 
      <ul>
        <li class="logo">
          <a href="index.html">
            <img src="IMAGENS/logo sem fundo.png" alt="Logo do Site" style="height: 90px;">
          </a>
        </li>

        <li><a href="login.php" id="btn-abrir-login">Login/Cadastro</a></li>
        <li><a href="advogado.php" class="animated-button ativo">Advogado</a></li>
        <li><a href="admin.html" class="animated-button">Administrador</a></li>
      </ul>
  </nav>

  <main class="container">

    <!-- DASHBOARD -->
    <section id="dashboard" class="card">
      <h2>Bem-vindo, <?= htmlspecialchars($adv['nome'] ?? 'Advogado') ?></h2>
      <p>Casos ativos: <?= is_object($casos) ? $casos->num_rows : 0 ?></p>
      <p>Compromissos hoje: <?= is_object($agenda) ? $agenda->num_rows : 0 ?></p>
      <p><a href="logout_advogado.php" style="color:red; font-weight:bold;">Sair</a></p>
    </section>

    <!-- CASOS -->
    <section id="casos" class="card">
      <h2>Gerenciamento de Casos</h2>
      <ul id="lista-casos">
      <?php if (is_object($casos) && $casos->num_rows > 0): ?>
        <?php while($c = $casos->fetch_assoc()): ?>
          <li>
            <?= htmlspecialchars($c['titulo']) ?> - <?= htmlspecialchars($c['status']) ?>
            <button onclick="excluirCaso(<?= $c['id'] ?>)">❌</button>
          </li>
        <?php endwhile; ?>
      <?php else: ?>
        <li>Nenhum caso cadastrado.</li>
      <?php endif; ?>
      </ul>
    </section>

    <!-- CLIENTES -->
    <section id="clientes" class="card">
      <h2>Clientes</h2>
      <button onclick="mostrarFormularioCliente()">+ Novo Cliente</button>
      <form id="form-cliente" style="display:none; margin-top:1rem;">
        <label>Nome: <input type="text" id="nomeCliente" required></label><br><br>
        <label>Caso: <input type="text" id="casoCliente" required></label><br><br>
        <button type="submit">Cadastrar</button>
      </form>

      <ul id="lista-clientes">
      <?php if (is_object($clientes) && $clientes->num_rows > 0): ?>
        <?php while($cli = $clientes->fetch_assoc()): ?>
          <li><?= htmlspecialchars($cli['nome']) ?> — <?= htmlspecialchars($cli['email']) ?></li>
        <?php endwhile; ?>
      <?php else: ?>
        <li>Nenhum cliente cadastrado.</li>
      <?php endif; ?>
      </ul>
    </section>

    <!-- AGENDA -->
    <section id="agenda" class="card">
      <h2>Agenda</h2>
      <button onclick="mostrarFormularioAgenda()">+ Novo Compromisso</button>
      <form id="form-agenda" style="display:none; margin-top:1rem;">
        <label>Data: <input type="date" id="dataCompromisso" required></label><br><br>
        <label>Descrição: <input type="text" id="descricaoCompromisso" required></label><br><br>
        <button type="submit">Adicionar</button>
      </form>

      <ul id="lista-agenda">
      <?php if (is_object($agenda) && $agenda->num_rows > 0): ?>
        <?php while($ag = $agenda->fetch_assoc()): ?>
          <li>📅 <?= date('d/m/Y', strtotime($ag['data'])) ?> — <?= htmlspecialchars($ag['descricao']) ?>
            <button onclick="excluirAgenda(this)">❌</button>
          </li>
        <?php endwhile; ?>
      <?php else: ?>
        <li>Nenhum compromisso agendado.</li>
      <?php endif; ?>
      </ul>
    </section>

  </main>

</div>

<script src="advogado.js"></script>

</body>
</html>
