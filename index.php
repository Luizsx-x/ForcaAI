<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link rel="shortcut icon" href="IMAGENS/Força Jurídica.png" type="image/png" />
    <title>Home</title>
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
<li>
    <a href="advogado_redirect.php">
        <button class="animated-button" id="btn_advogado">
            <span>Advogado</span>
        </button>
    </a>
</li>
<li>
    <a href="login_admin.php">
        <button class="animated-button" id="btn_advogado">
            <span>Administrador</span>
        </button>
    </a>
</li>
</ul>
            </nav>
                    <div class="overlay" id="overlay-perfil"></div>

<div class="perfil-card" id="perfilCard">
  <img src="<?php echo $_SESSION['foto'] ?: 'IMAGENS/user.png'; ?>" 
       alt="Foto do Usuário" class="perfil-foto">
  <h3 class="perfil-nome"><?php echo $_SESSION['nome']; ?></h3>
  <p class="perfil-email"><?php echo $_SESSION['email']; ?></p>

  <div class="perfil-links">
    <a href="editar.php" class="editar-perfil">✏️ Editar Perfil</a>
    <a href="logout.php" class="sair">🚪 Sair</a>
  </div>
</div>

<!-- BOTÃO IMAGEM PERFIL -->
<img src="<?php echo $_SESSION['foto'] ?: 'IMAGENS/user.png'; ?>" 
     alt="Perfil" id="btnPerfil" class="btn-perfil">
rfil.html"><button class="animated-button" id="btn_advogado"><span>Perfil</span> <span></a></button></li>

                </ul>
            </nav>

            <div class="secao-central">
                <div class="text">
                    <h1>Conecte-se a um Advogado</h1>
                    <h3>Conectamos você a profissionais jurídicos de <br>confiança, onde e quando precisar.</h3>
                    <div class="botao_comecar_wrapper">
                        <button class="botao_comecar" onclick="location.href='questionario.html'">COMEÇAR</button>
                    </div>
                </div>
                <div class="imagem-direita">
                    <img src="IMAGENS/temis.png" alt="Descrição" />
                </div>
            </div>

            <div class="overlay" id="overlay"></div>

            <!-- SOBRE NÓS / FALE CONOSCO -->
            <div class="card-info" id="info-empresa">
                <div class="img"></div>
                <span>Sobre Nós</span>
                <p class="info">Somos a BLOOD TECH, uma empresa de desenvolvimento de sites, sistemas e softwares.</p>

            </div>

          
                 <BR>    
        <BR>    

            <BR>
<BR>
<BR>
<BR>
<BR>

    <!--COMO FUNCIONA-->
        <h3>Como a Força Jurídica funciona?</h3>
<img class="ilustra" src="IMAGENS/COMO FUNCIONA.png" alt="Advogado">


<BR>

    
   <!--PERGUNTAS FREQUENTES-->
    <div class="faq-container">
    <div class="faq-title">Perguntas <br> Frequentes</div>

    <div class="faq-item active">
      <div class="faq-question">1. Quem somos?</div>
      <div class="faq-answer">
Somos a Força Jurídica, uma plataforma online que conecta pessoas a advogados especializados em diversas áreas do direito. Nosso objetivo é tornar mais fácil, rápido e seguro o acesso a serviços jurídicos. Através da nossa plataforma, você pode encontrar profissionais de acordo com a sua necessidade e localização, comparar perfis e agendar consultas de forma simples e prática.      </div>
      <div class="arrow"></div>
    </div>

    <div class="faq-item">
      <div class="faq-question">2. Como a Força Jurídica  funciona?</div>
      <div class="faq-answer">
A Força Jurídica te conecta com advogados de forma prática e rápida.      </div>
      <div class="arrow"></div>
    </div>

    <div class="faq-item">
      <div class="faq-question">3. Como entrar em contato com o advogado?</div>
      <div class="faq-answer">
Durante seu cadastro, o advogado informa seu Whatsapp ou seu E-mail, esses dados são disponibilizados aos clientes para que negociem diretamente com o advogado.          </div>
      <div class="arrow"></div>
    </div>

    <div class="faq-item">
      <div class="faq-question">4.  Tenho outras dúvidas</div>
      <div class="faq-answer">
Se sua dúvida não foi respondida anteriormente, entre em contato conosco através do E-mail:<E-mail> forcajuridica@gmail.com    </E-mail>     </div>
      <div class="arrow"></div>
    </div>
  </div>
 
<section class="carrossel">
    <h2>Para quem é a Força Jurídica?</h2>
    <p>Conectamos você com advogados especializados em diversas áreas do direito. <strong>Descubra como podemos te ajudar!</strong></p>

    <div class="carrossel-wrapper">
        <button class="btn-seta esquerda" id="btn-prev">&#10094;</button>

        <div class="carrossel-container" id="carrossel">
            <div class="card">
                <img src="IMAGENS/1.png" alt="Direito Trabalhista" />
                <h3>Direito Trabalhista</h3>
                <p>Demissões, acidentes, assédio moral e mais.</p>
            </div>
            <div class="card">
                <img src="IMAGENS/2.png" alt="Direito do Consumidor" />
                <h3>Direito do Consumidor</h3>
                <p>Produtos com defeito, cobranças abusivas.</p>
            </div>
            <div class="card">
                <img src="IMAGENS/3.png" alt="Direito de Família" />
                <h3>Direito de Família</h3>
                <p>Divórcios, guarda, pensão alimentícia.</p>
            </div>
            <div class="card">
                <img src="IMAGENS/4.png" alt="Direito Previdenciário" />
                <h3>Direito Previdenciário</h3>
                <p>Aposentadoria, INSS, benefícios sociais.</p>
            </div>
            <div class="card">
                <img src="IMAGENS/5.png" alt="Direito Previdenciário" />
                <h3>Direito Aeronáutico e de Aviação</h3>
                <p>  Atuação em casos de atrasos, cancelamentos de voos, bagagens extraviadas
    e responsabilidades das companhias aéreas.</p>
            </div>
<div class="card">
                <img src="IMAGENS/6.png" alt="Direito Previdenciário" />
                <h3>Direito Penal</h3>
                <p>  Para quem precisa de defesa ou orientação em casos de acusações criminais,
    inquéritos policiais, audiências criminais, prisões em flagrante, medidas cautelares
    e demais assuntos relacionados à esfera criminal.</p>
            </div>        </div>

        <button class="btn-seta direita" id="btn-next">&#10095;</button>
    </div>
</section>




 <!--FOOTER-->

  <footer class="site-footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>Sobre Nós</h3>
      <p>Força Jurídica, Conectamos você à advogados de forma rápida e prática.</p>     
     </div>
    
    <div class="footer-section">
      <h3>Mapa do Site</h3>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="questionario.html">Buscar advogados</a></li>
        
      </ul>
    </div>
    
     <div class="footer-section">
      <h3>Contato</h3>
       <p>
        <i class="fas fa-envelope"></i>
<a href="mailto:forcajuridicatcc@gmail.com">forcajuridicatcc@gmail.com</a>
  </p>
    </div>
  </div>    
  </footer> 
  
    <script src="js.js"></script>


<!-- CARD DE PERFIL -->
<div class="overlay" id="overlay-perfil"></div>

<div class="perfil-card" id="perfilCard">
  <img src="IMAGENS/user.png" alt="Foto do Usuário" class="perfil-foto" id="perfil-foto">
  <h3 class="perfil-nome" id="perfil-nome">Nome do Cliente</h3>
  <p class="perfil-email" id="perfil-email">cliente@email.com</p>

  <div class="perfil-links">
    <a href="editar.html" class="editar-perfil">✏️ Editar Perfil</a>
    <a href="logout.php" class="sair">🚪 Sair</a>
  </div>
</div>

<!-- BOTÃO IMAGEM PERFIL -->
<img src="IMAGENS/user.png" alt="Perfil" id="btnPerfil" class="btn-perfil">
    
<script>
const btnPerfil = document.getElementById("btnPerfil");
const perfilCard = document.getElementById("perfilCard");
const overlay = document.getElementById("overlay-perfil");

btnPerfil.addEventListener("click", () => {
  perfilCard.classList.add("mostrar");
  overlay.classList.add("mostrar");
});

overlay.addEventListener("click", () => {
  perfilCard.classList.remove("mostrar");
  overlay.classList.remove("mostrar");
});
</script>

</body>
</html>
