let historico = [];
        let numerosCartela = [];

        function gerarCartela() {
            numerosCartela = [];
            const intervalo = 75;
            while (numerosCartela.length < 25) {
                const numero = Math.floor(Math.random() * intervalo) + 1;
                if (!numerosCartela.includes(numero)) {
                    numerosCartela.push(numero);
                }
            }
            atualizarCartela();
        }

        function atualizarCartela() {
            const bingoCard = document.getElementById('bingo-card');
            bingoCard.innerHTML = '';
            numerosCartela.forEach(numero => {
                const div = document.createElement('div');
                div.textContent = numero;
                div.classList.add('number');
                bingoCard.appendChild(div);
            });
        }

        function sortearNumero() {
            const intervalo = parseInt(document.getElementById('interval').value);
            let numeroSorteado;
            do {
                numeroSorteado = Math.floor(Math.random() * intervalo) + 1;
            } while (historico.includes(numeroSorteado));
            
            historico.push(numeroSorteado);
            
            atualizarHistorico();
            marcarNumeroCartela(numeroSorteado);
        }

        function marcarNumeroCartela(numero) {
            const index = numerosCartela.indexOf(numero);
            if (index !== -1) {
                const numbers = document.querySelectorAll('.number');
                numbers[index].classList.add('marked');
            }
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

        // Gerar a cartela quando a página carregar
        window.onload = gerarCartela;