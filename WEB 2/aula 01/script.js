let historico = [];

        function sortearNumero() {
            const intervalo = parseInt(document.getElementById('interval').value);
            let numeroSorteado;
            do {
                numeroSorteado = Math.floor(Math.random() * intervalo) + 1;
            } while (historico.includes(numeroSorteado));
            
            historico.push(numeroSorteado);
            document.getElementById('numero-sorteado').innerText = numeroSorteado;
            atualizarHistorico();
        }

        function atualizarHistorico() {
            const historyList = document.getElementById('history');
            historyList.innerHTML = '';
            historico.forEach(numero => {
                const li = document.createElement('li');
                li.textContent = numero;
                historyList.appendChild(li);
            });
        }