<?php
include "conexao.php"; // conecta no banco

$id = 1; // futuramente pegar da sessão
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

$sql = "UPDATE clientes SET nome=?, email=?, telefone=?".($senha?", senha=?":"")." WHERE id=?";
$stmt = $conn->prepare($sql);

if($senha){
    $stmt->bind_param("ssssi", $nome, $email, $telefone, $senha, $id);
} else {
    $stmt->bind_param("sssi", $nome, $email, $telefone, $id);
}

$stmt->execute();
header("Location: ../editar_cliente.html?sucesso=1");
?>
