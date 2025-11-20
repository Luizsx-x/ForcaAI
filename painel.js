(painel.js)
function novoCaso() {
  const lista = document.getElementById("lista-casos");
  const li = document.createElement("li");
  li.textContent = "Novo processo - Em andamento";
  lista.appendChild(li);
  alert("Novo caso criado!");
}

function novoCliente() {
  alert("Formulário para cadastrar cliente!");
}
function mostrarFormularioCliente() {
  document.getElementById("form-cliente").style.display = "block";
}

document.getElementById("form-cliente").addEventListener("submit", function(e) {
  e.preventDefault();

  let nome = document.getElementById("nomeCliente").value;
  let caso = document.getElementById("casoCliente").value;

  if (nome && caso) {
    let li = document.createElement("li");
    li.textContent = `${nome} - ${caso}`;
    document.getElementById("lista-clientes").appendChild(li);

    // Limpa o formulário
    document.getElementById("nomeCliente").value = "";
    document.getElementById("casoCliente").value = "";
    document.getElementById("form-cliente").style.display = "none";
  }
});

function salvarClientes() {
  let clientes = [];
  document.querySelectorAll("#lista-clientes li").forEach(li => {
    clientes.push(li.textContent);
  });
  localStorage.setItem("clientes", JSON.stringify(clientes));
}

function carregarClientes() {
  let clientes = JSON.parse(localStorage.getItem("clientes")) || [];
  clientes.forEach(cliente => {
    let li = document.createElement("li");
    li.textContent = cliente;
    document.getElementById("lista-clientes").appendChild(li);
  });
}

// Chama ao carregar a página
window.onload = carregarClientes;

// Atualiza sempre que cadastrar
document.getElementById("form-cliente").addEventListener("submit", function() {
  salvarClientes();
});

function excluirCaso(botao) {
  let li = botao.parentElement; // pega o <li> do processo
  li.remove();
}

function novoCaso() {
  let numero = prompt("Digite o número do processo:");
  let status = prompt("Digite o status (Andamento, Concluído, etc.):");

  if (numero && status) {
    let li = document.createElement("li");
    li.innerHTML = `Processo #${numero} - ${status} <button onclick="excluirCaso(this)">❌</button>`;
    document.getElementById("lista-casos").appendChild(li);
  }
}

function excluirAgenda(botao) {
  let li = botao.parentElement;
  li.remove();
}

document.getElementById("form-agenda").addEventListener("submit", function(e) {
  e.preventDefault();

  let data = document.getElementById("dataCompromisso").value;
  let descricao = document.getElementById("descricaoCompromisso").value;

  if (data && descricao) {
    let li = document.createElement("li");
    li.innerHTML = `📅 ${data} - ${descricao} <button onclick="excluirAgenda(this)">❌</button>`;
    document.getElementById("lista-agenda").appendChild(li);

    // Limpa e esconde o formulário
    document.getElementById("dataCompromisso").value = "";
    document.getElementById("descricaoCompromisso").value = "";
    document.getElementById("form-agenda").style.display = "none";
  }
});

    function mostrarFormularioAgenda() {
  document.getElementById("form-agenda").style.display = "block";
}

document.getElementById("form-agenda").addEventListener("submit", function(e) {
  e.preventDefault();

  let data = document.getElementById("dataCompromisso").value;
  let descricao = document.getElementById("descricaoCompromisso").value;

  if (data && descricao) {
    let li = document.createElement("li");
    li.textContent = `📅 ${data} - ${descricao}`;
    document.getElementById("lista-agenda").appendChild(li);

    // Limpa e esconde o formulário
    document.getElementById("dataCompromisso").value = "";
    document.getElementById("descricaoCompromisso").value = "";
    document.getElementById("form-agenda").style.display = "none";
  }
});

// --- Funções da Agenda --- //

// Exibir formulário
function mostrarFormularioAgenda() {
  document.getElementById("form-agenda").style.display = "block";
}

// Excluir compromisso
function excluirAgenda(botao) {
  let li = botao.parentElement;
  li.remove();
  salvarAgenda(); // atualiza no localStorage
}

// Salvar compromissos no localStorage
function salvarAgenda() {
  let compromissos = [];
  document.querySelectorAll("#lista-agenda li").forEach(li => {
    compromissos.push(li.textContent.replace("❌", "").trim());
  });
  localStorage.setItem("agenda", JSON.stringify(compromissos));
}

// Carregar compromissos do localStorage
function carregarAgenda() {
  let compromissos = JSON.parse(localStorage.getItem("agenda")) || [];
  compromissos.forEach(c => {
    let li = document.createElement("li");
    li.innerHTML = `${c} <button onclick="excluirAgenda(this)">❌</button>`;
    document.getElementById("lista-agenda").appendChild(li);
  });
}

// Cadastrar novo compromisso
document.getElementById("form-agenda").addEventListener("submit", function(e) {
  e.preventDefault();

  let data = document.getElementById("dataCompromisso").value;
  let descricao = document.getElementById("descricaoCompromisso").value;

  if (data && descricao) {
    let li = document.createElement("li");
    li.innerHTML = `📅 ${data} - ${descricao} <button onclick="excluirAgenda(this)">❌</button>`;
    document.getElementById("lista-agenda").appendChild(li);

    salvarAgenda(); // salva após adicionar

    // Limpa e esconde o formulário
    document.getElementById("dataCompromisso").value = "";
    document.getElementById("descricaoCompromisso").value = "";
    document.getElementById("form-agenda").style.display = "none";
  }
});

// Carregar agenda ao abrir a página
window.onload = carregarAgenda;
window.onload = function() {
  carregarAgenda();

  // Cadastrar novo compromisso
  document.getElementById("form-agenda").addEventListener("submit", function(e) {
    e.preventDefault();

    let data = document.getElementById("dataCompromisso").value;
    let descricao = document.getElementById("descricaoCompromisso").value;

    if (data && descricao) {
      let li = document.createElement("li");
      li.innerHTML = `📅 ${data} - ${descricao} <button onclick="excluirAgenda(this)">❌</button>`;
      document.getElementById("lista-agenda").appendChild(li);

      salvarAgenda(); // salva após adicionar

      // Limpa e esconde o formulário
      document.getElementById("dataCompromisso").value = "";
      document.getElementById("descricaoCompromisso").value = "";
      document.getElementById("form-agenda").style.display = "none";
    }
  });
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
