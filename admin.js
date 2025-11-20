// ==== FUNÇÕES PARA CARREGAR OS DADOS ====

// Carregar Usuários
function carregarUsuarios() {
  fetch("backend/usuarios.php")
    .then(res => res.json())
    .then(dados => {
      let tbody = "";
      dados.forEach(user => {
        tbody += `
          <tr>
            <td>${user.id}</td>
            <td>${user.nome}</td>
            <td>${user.email}</td>
            <td>
              <button onclick="excluirUsuario(${user.id})" class="btn-excluir">Excluir</button>
            </td>
          </tr>
        `;
      });
      document.querySelector("#usuarios tbody").innerHTML = tbody;
    })
    .catch(err => console.error("Erro ao carregar usuários:", err));
}

// Carregar Advogados
function carregarAdvogados() {
  fetch("backend/advogados.php")
    .then(res => res.json())
    .then(dados => {
      let tbody = "";
      dados.forEach(adv => {
        tbody += `
          <tr>
            <td>${adv.id}</td>
            <td>${adv.nome}</td>
            <td>${adv.oab}</td>
            <td>${adv.email}</td>
            <td>${adv.status}</td>
            <td>
              ${adv.status === "Pendente" 
                ? `<button onclick="aprovarAdvogado(${adv.id})" class="btn-aprovar">Aprovar</button>` 
                : ""}
              <button onclick="excluirAdvogado(${adv.id})" class="btn-excluir">Remover</button>
            </td>
          </tr>
        `;
      });
      document.querySelector("#advogados tbody").innerHTML = tbody;
    })
    .catch(err => console.error("Erro ao carregar advogados:", err));
}

// ==== FUNÇÕES DE AÇÃO (CHAMAM PHP) ====

// Excluir Usuário
function excluirUsuario(id) {
  fetch("backend/acao.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `tipo=excluir_usuario&id=${id}`
  })
  .then(() => carregarUsuarios())
  .catch(err => console.error("Erro ao excluir usuário:", err));
}

// Excluir Advogado
function excluirAdvogado(id) {
  fetch("backend/acao.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `tipo=excluir_advogado&id=${id}`
  })
  .then(() => carregarAdvogados())
  .catch(err => console.error("Erro ao excluir advogado:", err));
}

// Aprovar Advogado
function aprovarAdvogado(id) {
  fetch("backend/acao.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `tipo=aprovar_advogado&id=${id}`
  })
  .then(() => carregarAdvogados())
  .catch(err => console.error("Erro ao aprovar advogado:", err));
}

// ==== INICIALIZAÇÃO ====
// Quando a página carregar, chama as funções
window.onload = () => {
  carregarUsuarios();
  carregarAdvogados();
};
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
