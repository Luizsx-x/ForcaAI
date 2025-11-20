<?php
require_once 'conexao/conexao.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit;
}
$sql = "SELECT id, nome, email, telefone, data_criacao FROM clientes ORDER BY id DESC";
$res = $conn->query($sql);
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Painel</title></head>
<body>
<h2>Painel - Bem vindo <?php echo htmlspecialchars($_SESSION['user_nome']); ?></h2>
<p><a href="?action=logout">Sair</a></p>
<h3>Lista de clientes</h3>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Criado em</th></tr>
<?php while($row = $res->fetch_assoc()): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo htmlspecialchars($row['nome']); ?></td>
<td><?php echo htmlspecialchars($row['email']); ?></td>
<td><?php echo htmlspecialchars($row['telefone']); ?></td>
<td><?php echo $row['data_criacao']; ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
