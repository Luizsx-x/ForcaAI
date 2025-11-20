document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab");
  const tipoUsuarioInput = document.getElementById("tipoUsuario");

  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      // Remover 'active' de todas
      tabs.forEach(t => t.classList.remove("active"));
      // Adicionar à clicada
      tab.classList.add("active");

      // Atualizar campo oculto com tipo de usuário
      const tipo = tab.getAttribute("data-tab");
      tipoUsuarioInput.value = tipo;
    });
  });

  // Capturar o submit do formulário
  const form = document.getElementById("loginForm");
  form.addEventListener("submit", (e) => {
    e.preventDefault(); // impedir envio real

    const email = document.getElementById("email").value;
    const senha = document.getElementById("senha").value;
    const tipo = tipoUsuarioInput.value;

    alert(`Login como ${tipo.toUpperCase()}:\nEmail: ${email}\nSenha: ${senha}`);
    // Aqui você pode redirecionar, enviar via AJAX, etc.
  });
});
