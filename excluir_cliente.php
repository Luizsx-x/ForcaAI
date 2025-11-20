<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login/login_admin.php");
    exit();
}

include_once __DIR__ . '/conexao/conexao.php';

// Verifica se recebeu o ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Verifica se o cliente existe
    $check = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Exclui o cliente
        $delete = $conn->prepare("DELETE FROM clientes WHERE id = ?");
        $delete->bind_param("i", $id);
        if ($delete->execute()) {
            echo "<script>
                alert('Cliente excluído com sucesso!');
                window.location.href = 'admin.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao excluir o cliente.');
                window.location.href = 'admin.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Cliente não encontrado.');
            window.location.href = 'admin.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID inválido.');
        window.location.href = 'admin.php';
    </script>";
}
?>
