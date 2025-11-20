<?php
// generate_hash.php — RODE APENAS UMA VEZ e depois REMOVA/RENOMEIE!

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    if(strlen($senha) < 6) {
        $error = "Senha muito curta (mínimo 6 caracteres).";
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Gerar hash da senha</title>
<style>
  body{font-family:Arial,Helvetica,sans-serif;padding:30px;background:#f4f6fb}
  .box{background:#fff;padding:20px;border-radius:8px;max-width:600px;margin:auto;box-shadow:0 6px 20px rgba(0,0,0,.08)}
  input{padding:10px;border-radius:6px;border:1px solid #ccc;width:100%}
  button{padding:10px 14px;margin-top:10px;background:#0a195f;color:#fff;border:none;border-radius:6px;cursor:pointer}
  .hash{word-break:break-all;background:#f0f4ff;padding:10px;border-radius:6px;margin-top:12px}
  .err{color:#b00020}
</style>
</head>
<body>
  <div class="box">
    <h2>Gerar hash seguro para senha (use uma vez)</h2>
    <form method="POST">
      <label>Digite a senha que deseja usar para o admin:</label><br><br>
      <input type="password" name="senha" required placeholder="Sua senha segura">
      <button type="submit">Gerar hash</button>
    </form>

    <?php if(!empty($error)): ?>
      <p class="err"><?=htmlspecialchars($error)?></p>
    <?php endif; ?>

    <?php if(!empty($hash)): ?>
      <p>Hash gerado — copie todo o texto abaixo e cole no arquivo <code>login_admin.php</code> na variável <code>$adminPassHash</code>:</p>
      <div class="hash"><?=htmlspecialchars($hash)?></div>
      <p style="margin-top:12px;color:#555">OBS: Após copiar, delete este arquivo do servidor por segurança.</p>
    <?php endif; ?>
  </div>
</body>
</html>
