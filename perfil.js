// perfil.js — animações suaves + feedback de sucesso para ambos os perfis

document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".admin-container");
  const titulo = document.querySelector("h1");
  const form = document.querySelector(".form-perfil");
  const botao = document.querySelector(".btn-salvar");

  if (!container || !form || !botao) return;

  // ======== ANIMAÇÕES INICIAIS ========
  // fade e "subida" do container
  container.style.opacity = 0;
  container.style.transform = "translateY(30px)";
  setTimeout(() => {
    container.style.transition = "all 0.6s ease";
    container.style.opacity = 1;
    container.style.transform = "translateY(0)";
  }, 100);

  // efeito de digitação suave no título
  if (titulo) {
    const textoOriginal = titulo.textContent;
    titulo.textContent = "";
    titulo.style.opacity = 0;

    setTimeout(() => {
      titulo.style.opacity = 1;
      let i = 0;
      const interval = setInterval(() => {
        titulo.textContent += textoOriginal[i];
        i++;
        if (i === textoOriginal.length) clearInterval(interval);
      }, 50);
    }, 400);
  }

  // animação de entrada dos inputs
  const inputs = form.querySelectorAll("input");
  inputs.forEach((input, i) => {
    input.style.opacity = 0;
    input.style.transform = "translateY(15px)";
    setTimeout(() => {
      input.style.transition = "all 0.4s ease";
      input.style.opacity = 1;
      input.style.transform = "translateY(0)";
    }, 150 * i + 800);
  });

  // ======== BOTÃO E FEEDBACK DE SUCESSO ========
  form.addEventListener("submit", (e) => {
    e.preventDefault(); // evita envio imediato só pra exibir animação

    botao.disabled = true;
    botao.style.cursor = "not-allowed";

    // cria loader girando
    const loader = document.createElement("div");
    loader.classList.add("loader");
    botao.textContent = "";
    botao.appendChild(loader);

    // loader por 1,2s → check verde
    setTimeout(() => {
      loader.remove();
      const check = document.createElement("div");
      check.classList.add("checkmark");
      check.innerHTML = "✔️";
      botao.appendChild(check);
      botao.style.background = "linear-gradient(90deg, #4CAF50, #00b36b)";
      botao.style.boxShadow = "0 0 20px rgba(76, 175, 80, 0.4)";

      // volta ao normal depois de 1.5s
      setTimeout(() => {
        botao.textContent = "Salvar Alterações";
        botao.disabled = false;
        botao.style.cursor = "pointer";
        botao.style.background = "";
        botao.style.boxShadow = "";
      }, 1500);
    }, 1200);
  });
});
// --- Transição de entrada suave da página ---
document.body.classList.add("fade-transition");

window.addEventListener("load", () => {
  document.body.classList.add("loaded");
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
