      // URL da API
      const url = 'http://reserva.laboratorio.app.br:10100';

      // Função para fazer a requisição GET para a API
      function fazerRequisicao() {
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  var data = JSON.parse(xhr.responseText);
                  exibirResultado(data);
              }
          };
          xhr.open("GET", url + "/produtos", true);
          xhr.send();
      }
      
      // Função para exibir o resultado na tabela
      function exibirResultado(data) {
          var tabela = document.getElementById("resultadoTabela");
          tabela.innerHTML = "";
      
          data.forEach(function (item) {
              var row = tabela.insertRow();
              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);
              var cell4 = row.insertCell(3);
              var cell5 = row.insertCell(4);
              var cell6 = row.insertCell(5);
              var cell7 = row.insertCell(6);
      
              cell1.innerHTML = item.id;
              cell2.innerHTML = item.codbarra;
              cell3.innerHTML = item.nome;
              cell4.innerHTML = item.desc;
              cell5.innerHTML = item.valor;
              cell6.innerHTML = '<button>editar</button>';
              cell7.innerHTML = '<button onclick=excluirProduto(\'' + item.id + '\')">Excluir</button>';
          });
      }
      
      // Função para excluir um produto
      function excluirProduto(idProduto){
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function(){
              if(xhr.readyState === 4 && xhr.status === 200){
                  document.getElementById("resposta").value = xhr.responseText;
                  fazerRequisicao();
              }
          };
      
          xhr.open("DELETE", url + "/produto/" + idProduto, true);
          xhr.send();
      }
      
      // Função para pegar dados dos input e fazer a requisição POST para a API
      function adicionarProduto() {
          const produto = {
              _idProduto: document.getElementById("idProduto").value,
              nome: document.getElementById("nomeProduto").value,
              codbarra: document.getElementById("codigoBarra").value,
              desc: document.getElementById("descricaoProduto").value,
              valor: document.getElementById("valorProduto").value,
          };
      
          // Imprime o objeto no console
          console.log(produto);
      
          // Cria uma nova requisição
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Atualiza a tabela com os novos dados
                  fazerRequisicao();
              }
          };
      
          // Abre a requisição
          xhr.open("POST", url + "/produto", true);
      
          // Define o cabeçalho da requisição
          xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      
          // Envia a requisição
          xhr.send(JSON.stringify(produto));
      }