// ===== Elementos =====
const btnSouAdvogado = document.getElementById("btn-login-advogado");

// Criar o overlay se não existir
let overlay = document.getElementById('overlay');
if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'overlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0,0,0,0.7)';
    overlay.style.zIndex = '999';
    overlay.style.display = 'none';
    document.body.appendChild(overlay);
}

// Criar modal de login advogado se não existir
let formLoginAdvogado = document.getElementById('form-login-advogado');
if (!formLoginAdvogado) {
    formLoginAdvogado = document.createElement('div');
    formLoginAdvogado.id = 'form-login-advogado';
    formLoginAdvogado.style.position = 'fixed';
    formLoginAdvogado.style.top = '50%';
    formLoginAdvogado.style.left = '50%';
    formLoginAdvogado.style.transform = 'translate(-50%, -50%)';
    formLoginAdvogado.style.backgroundColor = '#111827';
    formLoginAdvogado.style.padding = '2rem';
    formLoginAdvogado.style.borderRadius = '0.75rem';
    formLoginAdvogado.style.color = '#f3f4f6';
    formLoginAdvogado.style.display = 'none';
    formLoginAdvogado.style.zIndex = '1000';
    formLoginAdvogado.innerHTML = `
        <button id="btn-fechar-login-advogado" style="float:right;">X</button>
        <h2>Login Advogado</h2>
        <form>
            <label>Usuário</label>
            <input type="text" name="username">
            <label>Senha</label>
            <input type="password" name="password">
            <button type="submit">Entrar</button>
        </form>
    `;
    document.body.appendChild(formLoginAdvogado);
}

// ===== Funções =====
function abrirModal() {
    overlay.style.display = 'block';
    formLoginAdvogado.style.display = 'block';
}

function fecharModal() {
    overlay.style.display = 'none';
    formLoginAdvogado.style.display = 'none';
}

// ===== Eventos =====
btnSouAdvogado?.addEventListener('click', e => {
    e.preventDefault();
    abrirModal();
});

document.getElementById('btn-fechar-login-advogado')?.addEventListener('click', fecharModal);
overlay.addEventListener('click', fecharModal);
 

// ====================== FUNÇÕES ======================

function abrirForm(formElement) {
    if (!formElement) return;
    todosModais.forEach(f => f?.classList.remove('abrir'));
    overlay.classList.add('abrir');
    formElement.classList.add('abrir');
}

function fecharForm(formElement) {
    if (!formElement) return;
    formElement.classList.remove('abrir');
    setTimeout(() => {
        if (!todosModais.some(f => f?.classList.contains('abrir'))) overlay.classList.remove('abrir');
    }, 300);
}


// SOBRE NÓS
 document.getElementById("btn-abrir-info-empresa").addEventListener("click", function (e) {
    e.preventDefault(); // evita que a página role para o topo
    const infoEmpresa = document.getElementById("info-empresa");

    if (infoEmpresa.style.display === "none" || infoEmpresa.style.display === "") {
      infoEmpresa.style.display = "block";
    } else {
      infoEmpresa.style.display = "none";
    }
  });
  // --- Efeito de saída suave ao trocar de página ---
document.querySelectorAll("a, form").forEach((el) => {
  el.addEventListener("click", (e) => {
    // só aplica se for link interno ou formulário
    const href = el.getAttribute("href");
    const isLink = el.tagName.toLowerCase() === "a";
    const isForm = el.tagName.toLowerCase() === "form";

    if ((isLink && href && !href.startsWith("#") && !href.startsWith("http")) || isForm) {
      e.preventDefault();
      document.body.style.opacity = "0";
      setTimeout(() => {
        if (isLink) window.location.href = href;
        else el.submit();
      }, 500);
    }
  });
});
