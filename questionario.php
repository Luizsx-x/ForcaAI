<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="questionario.css" />
    <link rel="stylesheet" href="forms.css" />
    <link rel="shortcut icon" href="IMAGENS/Força Jurídica.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Home</title>

    <style>
      /* CSS exclusivo dos cards — não afeta navbar nem filtros */
      .lista-advogados {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 40px;
      }

      .card-advogado {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        width: 280px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
      }

      .card-advogado:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
      }

      .card-header {
        background: #7ab6f3ff;
        color: #fff;
        padding: 15px;
        text-align: center;
      }

      .card-header h3 {
        margin: 0;
        font-size: 20px;
      }

      .card-body {
        padding: 15px;
        color: #333;
        text-align: left;
      }

      .card-body p {
        margin: 5px 0;
      }

      .card-body img {
        width: 100%;
        border-radius: 6px;
        margin-top: 10px;
      }
    </style>
</head>
<body>
   <div class="tudo">
       <div class="container">
            <nav id="menu"> 
                <ul>
                    <li class="logo">
                      <a href="index.html">
                        <img src="IMAGENS/logo sem fundo.png" alt="Logo do Site" style="height: 90px;">
                      </a>
                    </li>
                    <li><a href="login.php" id="btn-abrir-login"><span>Login/Cadastro</span></a></li>
                    <li><a href="advogado.php"><button class="animated-button" id="btn_advogado"><span>Advogado</span> <span></a></button></li>
                    <li><a href="admin.php"><button class="animated-button" id="btn_advogado"><span>Administrador</span> <span></a></button></li>
                </ul>
            </nav>
       </div>
   </div>

<br><br><br><br><br>

<?php
require_once 'conexao/conexao.php';

// Buscar advogados e especialidades
$sql = "SELECT a.id, a.nome, a.email, a.telefone, a.oab_frente, GROUP_CONCAT(e.nome SEPARATOR ', ') AS especialidades
        FROM advogados a
        LEFT JOIN advogado_especialidade ae ON ae.advogado_id = a.id
        LEFT JOIN especialidades e ON e.id = ae.especialidade_id
        GROUP BY a.id
        ORDER BY a.nome ASC";
$result = $conn->query($sql);
$advogados = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $advogados[] = $row;
    }
}
?>
  <br>
  <br>


<div class="filtro-ia-container">
  <div class="filtro-container">
    <h2>Pesquisar Advogados</h2>
    <div class="filtros">
        <input type="text" placeholder="Nome" class="filtro-input" id="filtro-nome">

        <select class="filtro-input" id="estado">
            <option value="">Selecione o Estado</option>
            <option value="SP">São Paulo</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="MG">Minas Gerais</option>
            <option value="BA">Bahia</option>
            <option value="PR">Paraná</option>
        </select>

        <select class="filtro-input" id="especialidade">
            <option value="">Selecione a Especialidade</option>
            <option value="civil">Direito Civil</option>
            <option value="penal">Direito Penal</option>
            <option value="trabalhista">Direito Trabalhista</option>
        </select>
    </div>

    <div class="filtro-botoes">
        <button class="btn-limpar">Limpar filtros</button>
        <button class="btn-pesquisar">Pesquisar</button>
    </div>
  </div>


    <div class="filtro-advogado">
  <label for="problema">A "da uma Força AI" te ajuda a encontrar o advogado perfeito para o seu caso</label>
  <textarea id="problema" placeholder="Conte-nos sobre o seu problema..."></textarea>
  <button id="buscar">Buscar advogado</button>
  <p id="resultado"></p>
    </div>
   <br>

  <div id="lista-advogados" class="lista-advogados">
    <?php if (empty($advogados)): ?>
      <p>Nenhum advogado cadastrado ainda.</p>
    <?php else: ?>
      <?php foreach ($advogados as $adv): ?>
        <div class="card-advogado">
          <div class="card-header">
            <h3><?php echo htmlspecialchars($adv['nome']); ?></h3>
            <p class="esp"><?php echo htmlspecialchars($adv['especialidades'] ?: '—'); ?></p>
          </div>
          <div class="card-body">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($adv['email']); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($adv['telefone']); ?></p>
            <?php if (!empty($adv['oab_frente'])): ?>
              <img src="<?php echo htmlspecialchars($adv['oab_frente']); ?>" alt="Foto do Advogado">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const nomeInput = document.getElementById('filtro-nome');
  const estadoSelect = document.getElementById('estado');
  const espSelect = document.getElementById('especialidade');
  const limparBtn = document.querySelector('.btn-limpar');
  const lista = document.getElementById('lista-advogados');

  function filtrar() {
    const nome = nomeInput.value.toLowerCase();
    const estado = estadoSelect.value.toLowerCase();
    const esp = espSelect.value.toLowerCase();

    const cards = lista.querySelectorAll('.card-advogado');
    cards.forEach(card => {
      const text = card.innerText.toLowerCase();
      const matchesNome = !nome || text.includes(nome);
      const matchesEsp = !esp || text.includes(esp);
      const matchesEstado = !estado || text.includes(estado);
      card.style.display = (matchesNome && matchesEsp && matchesEstado) ? '' : 'none';
    });
  }

  nomeInput.addEventListener('input', filtrar);
  estadoSelect.addEventListener('change', filtrar);
  espSelect.addEventListener('change', filtrar);

  limparBtn.addEventListener('click', e => {
    e.preventDefault();
    nomeInput.value = '';
    estadoSelect.value = '';
    espSelect.value = '';
    filtrar();
  });
});
</script>
</body>
</html>
