// URL da API
const url = 'http://reserva.laboratorio.app.br:10100';

// Opções da requisição
const options = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    }
};

// Função assíncrona para fazer a requisição para a API
async function fetchData(url, options) {
    try {
        const response = await fetch(url, options);
        const data = await response.json();
        console.log(data);
        return data;
    } catch (error) {
        console.log('Erro:', error);
    }
}

// Função para adicionar uma linha na tabela
function adicionarLinhaNaTabela(produto) {
    const tabela = document.getElementById("tabelaProdutos");
    const linha = tabela.insertRow(-1);
    linha.insertCell(0).innerHTML = produto.nome;
    linha.insertCell(1).innerHTML = produto.codbarra;
    linha.insertCell(2).innerHTML = produto.desc;
    linha.insertCell(3).innerHTML = produto._idProduto;
    linha.insertCell(4).innerHTML = produto.valor;
}

// Função para pegar dados dos input
async function adicionarProduto() {
    const produto = {
        _idProduto: document.getElementById("idProduto").value,
        nome: document.getElementById("nomeProduto").value,
        codbarra: document.getElementById("codigoBarra").value,
        desc: document.getElementById("descricaoProduto").value,
        valor: document.getElementById("valorProduto").value,
    };

    // Imprime o objeto no console
    console.log(produto);

    // Atualiza as opções da requisição com o corpo sendo o produto
    options.body = JSON.stringify(produto);

    // Chama a função fetchData e espera pela resposta
    const data = await fetchData(url, options);

    // Se a resposta for bem-sucedida, adiciona uma linha na tabela
    if (data) {
        adicionarLinhaNaTabela(produto);
    }
}
