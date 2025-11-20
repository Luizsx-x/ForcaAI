document.addEventListener('DOMContentLoaded', () => {
  // Selecione todos os itens de FAQ
  const faqItems = document.querySelectorAll('.faq-item');

  // Adiciona o comportamento de clique nos itens de FAQ
  faqItems.forEach(item => {
    item.addEventListener('click', () => {
      // Se o item já estiver ativo, desativa
      if (item.classList.contains('active')) {
        item.classList.remove('active');
      } else {
        // Fecha todos os outros itens e ativa o item clicado
        faqItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
      }
    });
  });


  // Fechar pelo overlay
  overlay.addEventListener('click', () => {
    [formLogin, formLoginAdvogado, formCadastroAdvogado].forEach(f => f?.classList.contains('abrir') && fecharForm(f));
  });
});
// cards

    const carrossel = document.getElementById('carrossel');
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');

    const scrollAmount = 300; // 

    btnNext.addEventListener('click', () => {
        carrossel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    btnPrev.addEventListener('click', () => {
        carrossel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
   
  function loginAdmin(event) {
    event.preventDefault();
    const user = document.getElementById("admin-user").value;
    const pass = document.getElementById("admin-pass").value;

    if (user === "admin" && pass === "1234") {
      window.location.href = "admin.html"; 
    } else {
      alert("Usuário ou senha inválidos!");
    }
  }

    
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
