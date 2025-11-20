<?php
session_start();
require_once 'conexao/conexao.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo  = $_POST['tipo'] ?? '';
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $senha = $conn->real_escape_string($_POST['senha'] ?? '');

    if (!$email || !$senha) {
        $msg = "Preencha todos os campos.";
    } else {
        if ($tipo === 'cliente') {
            $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha' LIMIT 1";
        } elseif ($tipo === 'advogado') {
            $sql = "SELECT * FROM advogados WHERE email = '$email' AND senha_hash = '$senha' LIMIT 1";
        } else {
            $msg = "Selecione o tipo de login.";
            $sql = '';
        }

        if ($sql) {
            $res = $conn->query($sql);
            if ($res && $res->num_rows > 0) {
                $user = $res->fetch_assoc();
                $_SESSION['usuario'] = $user;
                $_SESSION['tipo'] = $tipo;

                if ($tipo === 'advogado') {
                    $_SESSION['advogado_logged'] = true;
                    $_SESSION['advogado_id'] = $user['id'];
                    header("Location: advogado.php");
                    exit;
                } else {
                    $_SESSION['cliente_logged'] = true;
                    $_SESSION['cliente_id'] = $user['id'];
                    header("Location: index.php");
                    exit;
                }
            } else {
                $msg = "Email ou senha inválidos.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<link rel="shortcut icon" href="IMAGENS/Força Jurídica.png" type="image/png" />
<style>
/* MESMO CSS DO CADASTRO */
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Arial', sans-serif; }
body, html { height: 100%; background-color: #fff; }
.container { display: flex; height: 100vh; }
.form-container { flex: 1; padding: 60px; background: #fff; }
.form-container h1 { color: #0a195f; margin-bottom: 30px; }
.tabs { display: flex; margin-bottom: 20px; }
.tab { background: none; border: none; font-size: 16px; margin-right: 20px;
       padding-bottom: 10px; border-bottom: 2px solid transparent; cursor: pointer;
       color: #0a195f; transition: 0.3s ease; }
.tab.active { border-bottom: 2px solid #0a195f; font-weight: bold; }
form { display: flex; flex-direction: column; }
label { margin: 10px 0 5px; color: #0a195f; font-weight: 600; }
input { height: 52px; font-size: 16px; padding: 0 12px; border: 1px solid #ccc;
        border-radius: 6px; margin-bottom: 15px; width: 100%; }
button.login-btn { padding: 12px; background-color: #0a195f; color: #fff; border: none;
                   border-radius: 6px; cursor: pointer; font-weight: bold; margin-bottom: 15px;
                   height: 52px; font-size: 16px; }
.form-tab { display: none; flex-direction: column; }
.form-tab.active { display: flex; }
.msg-box { padding:10px; margin-bottom:15px; border-radius:6px;
           background:#f2f2f2; color:#333; font-weight:bold; }
.side-panel { flex: 1; background: radial-gradient(circle at top left, #3044a0, #0a195f); }
</style>
</head>
<body>
<div class="container">
  <div class="form-container">
    <h1>Login</h1>

    <?php if($msg): ?>
      <div class="msg-box"><?php echo $msg; ?></div>
    <?php endif; ?>

    <div class="tabs">
      <button class="tab active" data-tab="advogado">Advogado</button>
      <button class="tab" data-tab="cliente">Cliente</button>
    </div>

    <!-- Formulário Advogado -->
    <form id="loginAdvogado" class="form-tab active" method="post" action="">
      <input type="hidden" name="tipo" value="advogado" />
      <label>Email</label>
      <input type="email" name="email" required />
      <label>Senha</label>
      <input type="password" name="senha" required />
      <button type="submit" class="login-btn">Entrar</button>
            <p style="text-align:center;">Não tem conta? <a href="cadastro.php" style="color:#0a195f; font-weight:bold;">Cadastrar</a></p>

    </form>

    <!-- Formulário Cliente -->
    <form id="loginCliente" class="form-tab" method="post" action="">
      <input type="hidden" name="tipo" value="cliente" />
      <label>Email</label>
      <input type="email" name="email" required />
      <label>Senha</label>
      <input type="password" name="senha" required />
      <button type="submit" class="login-btn">Entrar</button>
      <p style="text-align:center;">Não tem conta? <a href="cadastro.php" style="color:#0a195f; font-weight:bold;">Cadastrar</a></p>
    </form>

  </div>
  <div class="side-panel"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab");
  const forms = {
    advogado: document.getElementById("loginAdvogado"),
    cliente: document.getElementById("loginCliente"),
  };
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      tabs.forEach((t) => t.classList.remove("active"));
      tab.classList.add("active");
      const tipo = tab.getAttribute("data-tab");
      Object.values(forms).forEach((f) => f.classList.remove("active"));
      forms[tipo].classList.add("active");
    });
  });
});
</script>
</body>
</html>
