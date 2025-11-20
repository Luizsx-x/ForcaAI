// ------- CLIENTES -------
function mostrarFormularioCliente() {
    document.getElementById("form-cliente").style.display = "block";
}

document.getElementById("form-cliente")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const nome = document.getElementById("nomeCliente").value;
    const caso = document.getElementById("casoCliente").value;

    const li = document.createElement("li");
    li.textContent = nome + " — Caso: " + caso;

    document.getElementById("lista-clientes").appendChild(li);

    document.getElementById("form-cliente").reset();
    document.getElementById("form-cliente").style.display = "none";
});


// ------- AGENDA -------
function mostrarFormularioAgenda() {
    document.getElementById("form-agenda").style.display = "block";
}

document.getElementById("form-agenda")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const data = document.getElementById("dataCompromisso").value;
    const desc = document.getElementById("descricaoCompromisso").value;

    const li = document.createElement("li");
    li.innerHTML = `📅 ${data.split("-").reverse().join("/")} - ${desc} <button onclick="this.parentElement.remove()">❌</button>`;

    document.getElementById("lista-agenda").appendChild(li);

    document.getElementById("form-agenda").reset();
    document.getElementById("form-agenda").style.display = "none";
});


// ------- CASOS (Apenas remove item visualmente) -------
function excluirCaso(id) {
    if (confirm("Deseja excluir este caso?")) {
        // remove apenas no visual
        event.target.parentElement.remove();

        // SE QUISER EXCLUIR NO BANCO, ME AVISE QUE CRIO O PHP
        console.log("Caso removido visualmente. ID:", id);
    }
}


// ------- AGENDA (remover compromisso) -------
function excluirAgenda() {
    event.target.parentElement.remove();
}
