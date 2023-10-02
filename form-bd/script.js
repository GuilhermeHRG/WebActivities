// URL da API
const url = 'http://reserva.laboratorio.app.br:10100';

// Dados do produto
const produto = {
    nomeProduto: 'Nome do Produto',
    codigoBarra: 'Código de Barra',
    descricaoProduto: 'Descrição do Produto',
    idProduto: 'ID do Produto',
    valorProduto: 'Valor do Produto'
};

// Opções da requisição
const options = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(produto)
};

// Faz a requisição para a API
fetch(url, options)
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Erro:', error));
