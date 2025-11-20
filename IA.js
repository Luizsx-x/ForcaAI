function normalize(text) {
  return text.toLowerCase()
             .normalize("NFD")
             .replace(/[\u0300-\u036f]/g, "");
}


const problemasFamilia = ["divórcio", "separação", "dissolução", "guarda", "custódia", "pensão", "adoção", "violência doméstica", "abuso familiar", "reconhecimento de paternidade", "filiação"];
const problemasTrabalhista = ["trabalhista", "emprego", "demissão", "rescisão", "desligamento", "assédio", "bullying", "perseguição", "CLT", "salário", "férias", "13º", "acidente de trabalho", "contrato", "vínculo empregatício"];
const problemasImobiliario = ["imóvel", "casa", "apartamento", "aluguel", "locação", "compra", "venda", "despejo", "condomínio", "taxa", "regulamento", "regularização", "escritura", "registro"];
const problemasCivil = ["contrato", "acordo", "compromisso", "cobrança", "dívida", "inadimplência", "danos morais", "ofensa", "prejuízo", "acidente", "sinistro"];
const problemasPenal = ["criminal", "penal", "crime", "furto", "roubo", "homicídio", "agressão", "prisão", "detenção", "custódia", "defesa criminal", "acusação", "processo penal"];
const problemasTributário = ["tributário", "fiscal", "imposto", "IR", "ICMS", "ISS", "multa", "autuação", "penalidade", "planejamento tributário", "economia de impostos"];
const problemasEmpresarial = ["empresa", "negócio", "sociedade", "contrato social", "acordo de sócios", "disputa societária", "fusão", "aquisição", "recuperação judicial", "falência", "compliance", "governança corporativa", "empresarial", "societário", "contrato comercial", "acordo", "negociação", "constituição de empresa", "abertura de empresa", "registro", "disputa societária", "sócio", "administração", "propriedade intelectual", "patente", "marca", "copyright"];
const problemasAmbiental = ["ambiental", "licenciamento ambiental", "licença", "autorização", "poluição", "contaminação", "degradação ambiental", "multa ambiental", "penalidade", "infração", "desmatamento", "corte ilegal", "devastação"]
const probelmasConsumidor = ["consumidor", "produto defeituoso", "garantia", "troca", "serviço", "atraso", "má prestação", "cobrança indevida", "débito", "reclamação", "protesto", "denúncia"]
const problemasSucessório = ["sucessoes", "herança", "testamento", "partilha", "inventário", "bens", "inventário judicial", "doação", "cessão de bens"]
const problemasContratual = ["contratual", "contrato", "acordo", "compromisso", "obrigação", "revisão de contrato", "alteração", "renegociação", "descumprimento", "inadimplência", "quebra contratual"]


document.getElementById("buscar").addEventListener("click", () => {
  const problema = document.getElementById("problema").value.toLowerCase();
  let advogado = "Advogado Geral";

  if (problemasFamilia.some(p => problema.includes(p))) {
    advogado = "Advogado de Direito de Família";
  } else if (problemasTrabalhista.some(p => problema.includes(p))) {
    advogado = "Advogado Trabalhista";
  } else if (problemasImobiliario.some(p => problema.includes(p))) {
    advogado = "Advogado Imobiliário";
  }

  document.getElementById("resultado").textContent = `Recomendamos: ${advogado}`;
});
document.getElementById("buscar").addEventListener("click", () => {
  const problema = normalize(document.getElementById("problema").value);
  let advogado = "Advogado Geral";

  if (problemasFamilia.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado de Direito de Família";
  } else if (problemasTrabalhista.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Trabalhista";
  } else if (problemasCivil.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado de Direito Civil";
  } else if (problemasPenal.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Penal";
  } else if (problemasTributario.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Tributário";
  } else if (problemasEmpresarial.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Empresarial";
  } else if (problemasAmbiental.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Ambiental";
  } else if (problemasConsumidor.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado do Consumidor";
  } else if (problemasSucessoes.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado de Direito Sucessório";
  } else if (problemasContratual.some(p => problema.includes(normalize(p)))) {
    advogado = "Advogado Contratual";
  }

  document.getElementById("resultado").textContent = `Recomendamos: ${advogado}`;
});





  document.addEventListener('DOMContentLoaded', () => {
        const btnLimpar = document.querySelector('.btn-limpar');

        btnLimpar.addEventListener('click', () => {
            // Limpar todos os inputs de texto
            document.querySelectorAll('.filtro-input[type="text"]').forEach(input => {
                input.value = '';
            });

            // Limpar todos os selects
            document.querySelectorAll('.filtro-input select, select.filtro-input').forEach(select => {
                select.selectedIndex = 0; // Volta para a primeira opção (normalmente o placeholder)
            });

            // Limpar textarea
            const textarea = document.querySelector('#problema');
            if (textarea) {
                textarea.value = '';
            }

            // Limpar resultado se existir
            const resultado = document.getElementById('resultado');
            if (resultado) {
                resultado.textContent = '';
            }
        });
    });