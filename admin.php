<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    // Caminho corrigido: login_admin.php está na raiz do sistema
    header("Location: logout_admin.php");
    exit();
}

// Caminho corrigido para a conexão
include_once __DIR__ . '/conexao/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="cssadmin.css">
  <style>
    body {
      background-color: #f8f9fb;
      font-family: "Merriweather", serif;
    }
    .container {
      width: 90%;
      max-width: 1100px;
      margin: 40px auto;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 24px rgba(3,43,92,0.08);
    }
    h1 {
      font-family: "DM Serif Display", serif;
      color: #083a73;
      margin-bottom: 20px;
      text-align: center;
    }
    h2 {
      color: #0b4f9a;
      margin-top: 50px;
      border-bottom: 2px solid #0b4f9a;
      padding-bottom: 8px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table th, table td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    table th {
      background: #0b4f9a;
      color: #fff;
    }
    .btn-editar, .btn-excluir {
      padding: 6px 12px;
      border-radius: 8px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }
    .btn-editar { background-color: #218838; }
    .btn-excluir { background-color: #c82333; }
    .btn-editar:hover { background-color: #1e7e34; }
    .btn-excluir:hover { background-color: #a71d2a; }
    .logout-btn {
      float: right;
      background: #c70000;
      color: white;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      margin-top: -60px;
    }
    .logout-btn:hover { background: #a10000; }
    .section { margin-bottom: 60px; }
  </style>
</head>
<body>

  <div class="container">
    <h1>Painel Administrativo</h1>
    <a href="logout_admin.php" class="logout-btn">Sair</a>

    <!-- CLIENTES -->
    <div class="section" id="clientes">
      <h2> Clientes</h2>
      <?php
      $sql = "SELECT id, nome, email, telefone, data_criacao FROM clientes ORDER BY id DESC";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          echo '<table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Telefone</th>
                      <th>Data</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>';
          while ($row = $result->fetch_assoc()) {
              echo '<tr>
                      <td>' . $row['id'] . '</td>
                      <td>' . htmlspecialchars($row['nome']) . '</td>
                      <td>' . htmlspecialchars($row['email']) . '</td>
                      <td>' . htmlspecialchars($row['telefone']) . '</td>
                      <td>' . htmlspecialchars($row['data_criacao']) . '</td>
                      <td>
                        <a class="btn-editar" href="editar_cliente.php?id=' . $row['id'] . '">Editar</a>
                        <a class="btn-excluir" href="excluir_cliente.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Excluir</a>
                      </td>
                    </tr>';
          }
          echo '</tbody></table>';
      } else {
          echo "<p>Nenhum cliente encontrado.</p>";
      }
      ?>
    </div>

    <!-- ADVOGADOS -->
    <div class="section" id="advogados">
      <h2> Advogados</h2>
      <?php
      $colunas = [];
      $resCheck = $conn->query("SHOW COLUMNS FROM advogados");
      while ($c = $resCheck->fetch_assoc()) {
          $colunas[] = $c['Field'];
      }

      $queryAdv = "SELECT id, nome, email, telefone";
      if (in_array('estado', $colunas)) $queryAdv .= ", estado";
      if (in_array('data_cadastro', $colunas)) $queryAdv .= ", data_cadastro";
      $queryAdv .= " FROM advogados ORDER BY id DESC";

      $result = $conn->query($queryAdv);

      if ($result && $result->num_rows > 0) {
          echo '<table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Telefone</th>';
          if (in_array('estado', $colunas)) echo '<th>Estado</th>';
          if (in_array('data_cadastro', $colunas)) echo '<th>Data</th>';
          echo '<th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>';
          while ($row = $result->fetch_assoc()) {
              echo '<tr>
                      <td>' . $row['id'] . '</td>
                      <td>' . htmlspecialchars($row['nome']) . '</td>
                      <td>' . htmlspecialchars($row['email']) . '</td>
                      <td>' . htmlspecialchars($row['telefone']) . '</td>';
              if (in_array('estado', $colunas)) echo '<td>' . htmlspecialchars($row['estado']) . '</td>';
              if (in_array('data_cadastro', $colunas)) echo '<td>' . htmlspecialchars($row['data_cadastro']) . '</td>';
              echo '<td>
                      <a class="btn-editar" href="editar_advogado.php?id=' . $row['id'] . '">Editar</a>
                      <a class="btn-excluir" href="excluir_advogado.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este advogado?\')">Excluir</a>
                    </td>
                    </tr>';
          }
          echo '</tbody></table>';
      } else {
          echo "<p>Nenhum advogado encontrado.</p>";
      }
      ?>
    </div>
  </div>

</body>
</html>
<?php
// Fechar a conexão
$conn->close();
?>  