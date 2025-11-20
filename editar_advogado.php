<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login/login_admin.php");
    exit();
}

include_once __DIR__ . '/conexao/conexao.php';

// Verifica se foi passado o ID do advogado
if (!isset($_GET['id'])) {
    echo "<script>alert('ID inválido.'); window.location.href='admin.php';</script>";
    exit();
}

$id = intval($_GET['id']);

// Busca os dados do advogado
$sql = "SELECT * FROM advogados WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<script>alert('Advogado não encontrado.'); window.location.href='admin.php';</script>";
    exit();
}

$advogado = $result->fetch_assoc();

// Atualiza os dados ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $estado = $_POST['estado'];

    $update = $conn->prepare("UPDATE advogados SET nome=?, email=?, telefone=?, estado=? WHERE id=?");
    $update->bind_param("ssssi", $nome, $email, $telefone, $estado, $id);

    if ($update->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Advogado</title>
    <style>
        body {
            font-family: "Merriweather", serif;
            background-color: #f8f9fb;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            background: white;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(3,43,92,0.08);
        }
        h1 {
            text-align: center;
            color: #083a73;
            margin-bottom: 30px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #0b4f9a;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 5px;
        }
        .btn {
            display: inline-block;
            background: #0b4f9a;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
        }
        .btn:hover { background: #083a73; }
        .voltar {
            display: inline-block;
            background: #777;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
        }
        .voltar:hover { background: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Advogado</h1>
        <form method="POST">
            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($advogado['nome']); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($advogado['email']); ?>" required>

            <label>Telefone</label>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($advogado['telefone']); ?>" required>

            <label>Estado</label>
            <input type="text" name="estado" value="<?php echo htmlspecialchars($advogado['estado']); ?>" required>

            <button type="submit" class="btn">Salvar</button>
            <a href="admin.php" class="voltar">Voltar</a>
        </form>
    </div>
</body>
</html>
