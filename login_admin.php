<?php
session_start();

// Se já estiver logado, redireciona para o painel
if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true) {
    header("Location: admin.php");
    exit();
}

// === CONFIGURAÇÃO: altere apenas aqui ===
$adminUser     = "admtcc";



$adminPassHash = '$2y$10$8Ewxu5jzQCdU5EvsUr8qWO0PQxkQlJyqb8CI.YenzIr03VFocwOVe'; 
// (hash da senha gerado pelo password_hash)
// ========================================

$msg = 'Faça login com suas credenciais de administrador.';

if (isset($_POST['login'])) {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['senha'] ?? '';

    // Verifica usuário e senha
    if ($user === $adminUser && password_verify($pass, $adminPassHash)) {
        session_regenerate_id(true);
        $_SESSION['admin_logged'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Administrador | Força Jurídica</title>
<link rel="shortcut icon" href="IMAGENS/Força Jurídica.png" type="image/png">
<style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif}
    body{background:linear-gradient(135deg,#0a195f,#3050b0);display:flex;justify-content:center;align-items:center;height:100vh;color:#333}
    .login-container{background:#fff;padding:40px 50px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.2);width:100%;max-width:420px;text-align:center}
    .login-container h2{color:#0a195f;margin-bottom:18px;font-size:1.6rem}
    form{display:flex;flex-direction:column;gap:12px}
    input[type="text"],input[type="password"]{padding:12px;border-radius:8px;border:1px solid #ccc;font-size:1rem}
    button{padding:12px;border-radius:8px;border:none;background-color:#0a195f;color:#fff;font-size:1rem;cursor:pointer;transition:background .25s}
    button:hover{background-color:#3050b0}
    .msg{color:#b00020;margin-bottom:6px}
    .note{font-size:.9rem;color:#666;margin-top:10px}
</style>
</head>
<body>
  <div class="login-container">
    <h2>Login Administrador</h2>

    <?php if($msg != ''): ?>
      <div class="msg"><?=htmlspecialchars($msg)?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit" name="login">Entrar</button>
    </form>

    <p class="note">Use um navegador seguro. Certifique-se de acessar via HTTPS.</p>
  </div>
</body>
</html>
