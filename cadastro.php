<?php
require_once 'conexao/conexao.php';
$msg = '';

// Array fixo de especialidades para advogados
$especialidades = [
    "Advogado Geral",
    "Advogado de Direito de Família",
    "Advogado Trabalhista",
    "Advogado de Direito Civil",
    "Advogado Penal",
    "Advogado Tributário",
    "Advogado Empresarial",
    "Advogado Ambiental",
    "Advogado do Consumidor",
    "Advogado de Direito Sucessório",
    "Advogado Contratual"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo     = $_POST['tipo'] ?? '';
    $nome     = $conn->real_escape_string($_POST['nome'] ?? '');
    $email    = $conn->real_escape_string($_POST['email'] ?? '');
    $telefone = $conn->real_escape_string($_POST['telefone'] ?? '');
    $senha    = $conn->real_escape_string($_POST['senha'] ?? '');

    if (!$nome || !$email || !$telefone || !$senha) {
        $msg = 'Preencha todos os campos obrigatórios.';
    } else {
        if ($tipo === 'cliente') {
            $aceitou = isset($_POST['aceitou']) ? 1 : 0;
            $maior   = isset($_POST['maior']) ? 1 : 0;

            $check = $conn->query("SELECT id FROM clientes WHERE email = '$email'");
            if ($check && $check->num_rows > 0) {
                $msg = 'Este e-mail já está cadastrado como cliente.';
            } else {
                $sql = "INSERT INTO clientes (nome, email, telefone, senha, aceitou_termos, maior_idade) 
                        VALUES ('$nome', '$email', '$telefone', '$senha', $aceitou, $maior)";
                if ($conn->query($sql) === TRUE) {
                    $msg = '✅ Cadastro de cliente realizado com sucesso.';
                } else {
                    $msg = 'Erro ao cadastrar cliente: ' . $conn->error;
                }
            }
        } elseif ($tipo === 'advogado') {
            $oab_frente = $conn->real_escape_string($_POST['oab_frente'] ?? '');
            $oab_verso  = $conn->real_escape_string($_POST['oab_verso'] ?? '');
            $especialidades_sel = $_POST['especialidades'] ?? [];
            $aceitou = isset($_POST['aceitou']) ? 1 : 0;
            $maior   = isset($_POST['maior']) ? 1 : 0;

            $check = $conn->query("SELECT id FROM advogados WHERE email = '$email'");
            if ($check && $check->num_rows > 0) {
                $msg = 'Este e-mail já está cadastrado como advogado.';
            } else {
                $sql = "INSERT INTO advogados (nome, email, telefone, senha_hash, oab_frente, oab_verso, aceitou_termos, maior_idade) 
                        VALUES ('$nome', '$email', '$telefone', '$senha', '$oab_frente', '$oab_verso', $aceitou, $maior)";
                if ($conn->query($sql) === TRUE) {
                    $advogado_id = $conn->insert_id;
                    foreach ($especialidades_sel as $esp_id) {
                        $esp_id = (int)$esp_id;
                        $conn->query("INSERT INTO advogado_especialidade (advogado_id, especialidade_id) VALUES ($advogado_id, $esp_id)");
                    }
                    $msg = '✅ Cadastro de advogado realizado com sucesso.';
                } else {
                    $msg = 'Erro ao cadastrar advogado: ' . $conn->error;
                }
            }
        } else {
            $msg = 'Selecione o tipo de cadastro.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro</title>
  <link rel="shortcut icon" href="IMAGENS/Força Jurídica.png" type="image/png" />
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Arial', sans-serif; }
    body, html { height: 100%; background-color: #fff; }
    .container { display: flex; height: 140vh; }
    .form-container { flex: 1; padding: 60px; background: #fff; }
    .form-container h1 { color: #0a195f; margin-bottom: 30px; }
    .tabs { display: flex; margin-bottom: 20px; }
    .tab { background: none; border: none; font-size: 16px; margin-right: 20px;
           padding-bottom: 10px; border-bottom: 2px solid transparent; cursor: pointer;
           color: #0a195f; transition: 0.3s ease; }
    .tab.active { border-bottom: 2px solid #0a195f; font-weight: bold; }
    form { display: flex; flex-direction: column; }
    label { margin: 10px 0 5px; color: #0a195f; font-weight: 600; }
    input, select { height: 52px; font-size: 16px; padding: 0 12px; border: 1px solid #ccc;
                    border-radius: 6px; margin-bottom: 15px; width: 100%; }
    .login-btn { padding: 12px; background-color: #0a195f; color: #fff; border: none;
                 border-radius: 6px; cursor: pointer; font-weight: bold; margin-bottom: 15px;
                 height: 52px; font-size: 16px; }
    .side-panel { flex: 1; background: radial-gradient(circle at top left, #3044a0, #0a195f); }
    .checkbox-group { margin-bottom: 20px; font-size: 14px; color: #333; }
    .checkbox-group input { margin-right: 8px; }
    .register { text-align: center; font-size: 14px; color: #666; }
    .register a { color: #0a195f; font-weight: bold; text-decoration: none; }
    .form-tab { display: none; flex-direction: column; }
    .form-tab.active { display: flex; }
    .msg-box { padding:10px; margin-bottom:15px; border-radius:6px;
               background:#f2f2f2; color:#333; font-weight:bold; }
    .termos-link { color: #0a195f; text-decoration: underline; cursor: pointer; }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <h1>Cadastro</h1>

      <?php if($msg): ?>
        <div class="msg-box"><?php echo $msg; ?></div>
      <?php endif; ?>

      <div class="tabs">
        <button class="tab active" data-tab="advogado">Continuar como advogado</button>
        <button class="tab" data-tab="cliente">Continuar como cliente</button>
      </div>

      <!-- Formulário Advogado -->
      <form id="cadastroAdvogado" class="form-tab active" method="post" action="">
        <input type="hidden" name="tipo" value="advogado" />
        <label>* Seu nome</label>
        <input type="text" name="nome" required />
        <label>* Email</label>
        <input type="email" name="email" required />
        <label>* Número de telefone</label>
        <input type="tel" name="telefone" required />
        <label>* Senha</label>
        <input type="password" name="senha" required />
        <label>* Carteira da OAB (Frente)</label>
        <input type="text" name="oab_frente" />
        <label>* Carteira da OAB (Verso)</label>
        <input type="text" name="oab_verso" />

        <fieldset>
          <legend>Especialidades</legend>
          <?php foreach ($especialidades as $index => $esp): ?>
            <label>
              <input type="checkbox" name="especialidades[]" value="<?php echo $index + 1; ?>" />
              <?php echo $esp; ?>
            </label><br>
          <?php endforeach; ?>
        </fieldset>

        <!-- Checkboxes com link para termos -->
        <div class="checkbox-group" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 15px;">
          <label><input type="checkbox" name="aceitou" /> Aceito os <a href="termos_advogado.html" target="_blank" class="termos-link">termos e condições de uso</a></label><br />
          <label><input type="checkbox" name="maior" /> Tenho 18 anos ou mais</label>
        </div>

        <button type="submit" class="login-btn">Cadastrar</button>
      </form>

      <!-- Formulário Cliente -->
      <form id="cadastroCliente" class="form-tab" method="post" action="">
        <input type="hidden" name="tipo" value="cliente" />
        <label>* Seu nome</label>
        <input type="text" name="nome" required />
        <label>* Email</label>
        <input type="email" name="email" required />
        <label>* Número de telefone</label>
        <input type="tel" name="telefone" required />
        <label>* Senha</label>
        <input type="password" name="senha" required />

        <div class="checkbox-group" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 15px;">
          <label><input type="checkbox" name="aceitou" /> Aceito os <a href="termos_usuario.html" target="_blank" class="termos-link">termos e condições de uso</a></label><br />
          <label><input type="checkbox" name="maior" /> Tenho 18 anos ou mais</label>
        </div>

        <button type="submit" class="login-btn">Solicitar conta</button>
        <p class="register">Já tem uma conta? <a href="login.php">Faça o login</a></p>
      </form>
    </div>
    <div class="side-panel"></div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const tabs = document.querySelectorAll(".tab");
      const forms = {
        advogado: document.getElementById("cadastroAdvogado"),
        cliente: document.getElementById("cadastroCliente"),
      };
      tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
          tabs.forEach((t) => t.classList.remove("active"));
          tab.classList.add("active");
          const tipo = tab.getAttribute("data-tab");
          Object.values(forms).forEach((form) => form.classList.remove("active"));
          forms[tipo].classList.add("active");
        });
      });
    });
  </script>
</body>
</html>
