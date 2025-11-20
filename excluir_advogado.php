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

    // Verifica se o advogado existe
    $check = $conn->prepare("SELECT * FROM advogados WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Exclui o advogado
        $delete = $conn->prepare("DELETE FROM advogados WHERE id = ?");
        $delete->bind_param("i", $id);
        if ($delete->execute()) {
            echo "<script>
                alert('Advogado excluído com sucesso!');
                window.location.href = 'admin.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao excluir o advogado.');
                window.location.href = 'admin.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Advogado não encontrado.');
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
