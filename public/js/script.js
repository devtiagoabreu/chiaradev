document.addEventListener("DOMContentLoaded", () => {
    // ====================================================================
    // EXIBIÇÃO MENSAGEM DE SUCESSO
    // ====================================================================
    const successBox = document.getElementById("success-message-box");
    if (successBox) {
        const closeBtn = successBox.querySelector(".close-btn");
        const params = new URLSearchParams(window.location.search);
        if (params.get("status") === "garantia_ok") {
            successBox.style.display = "flex";
            history.replaceState(null, "", window.location.pathname);
        }
        if (closeBtn) {
            closeBtn.addEventListener("click", () => {
                successBox.style.display = "none";
            });
        }
    }

    // ====================================================================
    // CONTADOR DE CLICK EM LINKS
    // ====================================================================
    function handleSocialClick(event, platform) {
        event.preventDefault();  // Impede o redirecionamento imediato

        const targetUrl = event.currentTarget.href;

        // Recupera o CSRF Token do meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/social-click', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken  // Passa o token CSRF no cabeçalho
            },
            body: JSON.stringify({ platform: platform })
        })
            .then(response => {
                window.open(targetUrl, '_blank');  // Abre a URL após a requisição
            })
            .catch(() => {
                window.open(targetUrl, '_blank');  // Caso ocorra erro, ainda abre a URL
            });
    }

    // Atribui o evento aos links sociais
    const socialLinks = document.querySelectorAll('.social-link');  // Seleciona todos os links com a classe 'social-link'
    socialLinks.forEach(link => {
        const platform = link.getAttribute('data-platform');  // Pega o valor do atributo data-platform
        link.addEventListener('click', (event) => {
            handleSocialClick(event, platform);  // Chama a função com a plataforma
        });
    });

    // ====================================================================
    // MODAL DE GARANTIA | CONFIRMA INSTAGRAM
    // ====================================================================
    const warrantyButton = document.getElementById("warranty-btn");
    const modalOverlay = document.getElementById("warranty-modal-overlay");
    const initialContent = document.getElementById("modal-initial-content");
    const loadingContent = document.getElementById("modal-loading-content");
    const followButton = document.getElementById("follow-instagram-btn");
    const closeModalButton = document.getElementById("close-modal-btn");

    if (
        warrantyButton &&
        modalOverlay &&
        followButton &&
        closeModalButton &&
        initialContent &&
        loadingContent
    ) {
        const instagramProfileUrl = "https://www.instagram.com/chiarasemijoias";

        const openModal = () => {
            modalOverlay.style.display = "flex";
        };

        const closeModal = () => {
            modalOverlay.style.display = "none";
            initialContent.style.display = "block";
            loadingContent.style.display = "none";
        };

        warrantyButton.addEventListener("click", (e) => {
            e.preventDefault();
            openModal();
        });

        followButton.addEventListener("click", (e) => {
            e.preventDefault();

            window.open(instagramProfileUrl, "_blank");

            initialContent.style.display = "none";
            loadingContent.style.display = "block";

            setTimeout(() => {
                window.location.href = "garantia";
            }, 10000);
        });

        closeModalButton.addEventListener("click", closeModal);
        modalOverlay.addEventListener("click", (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    }
    // ====================================================================
    // FORMULÁRIO DE GARANTIA E MODAL DE CONFIRMAÇÃO | WHATSAPP
    // ====================================================================
    const warrantyForm = document.getElementById("warranty-form");
    const confirmModal = document.getElementById("whatsapp-confirm-modal");
    const closeModalButtonConfirm = document.getElementById("close-confirm-modal-btn");
    const confirmAndSendButton = document.getElementById("confirm-and-send-btn");

    if (warrantyForm && confirmModal && closeModalButtonConfirm && confirmAndSendButton) {
        // Intercepta o envio do formulário
        warrantyForm.addEventListener("submit", (event) => {
            event.preventDefault();
            if (warrantyForm.checkValidity()) {
                confirmModal.style.display = "flex"; // Abre o modal
            } else {
                alert("Por favor, preencha todos os campos obrigatórios antes de continuar.");
            }
        });

        // Fecha o modal
        const closeConfirmModal = () => {
            confirmModal.style.display = "none";
        };

        closeModalButtonConfirm.addEventListener("click", closeConfirmModal);
        confirmModal.addEventListener("click", (e) => {
            if (e.target === confirmModal) closeConfirmModal();
        });

        // Ação do botão de confirmar no modal
        confirmAndSendButton.addEventListener("click", () => {
            // Desabilita o botão para evitar múltiplos cliques
            confirmAndSendButton.disabled = true;
            confirmAndSendButton.textContent = "Processando...";

            // Simula um tempo de processamento de 1 segundo
            setTimeout(() => {
                const nome = document.getElementById("nome").value;
                const produto = document.getElementById("produto").value;
                const data_compra = document.getElementById("data_compra").value;
                const dataFormatada = new Date(data_compra).toLocaleDateString('pt-BR');

                // const whatsappUrl = `https://wa.me/${numeroWhatsapp}?text=${mensagem}`;
                // const whatsappUrl = `https://wa.me/${numeroWhatsapp}?text=${encodeURIComponent(mensagem)}%0A%0A| Nome: ${encodeURIComponent(nome)}%0A, Código do Produto: ${encodeURIComponent(produto)}%0A, Data da Compra: ${encodeURIComponent(data_compra)|}`;
                const whatsappUrl = `https://wa.me/${numeroWhatsapp}?text=${encodeURIComponent(mensagem)}%0A%0A%2A%2A%2A%20*DADOS%20DA%20GARANTIA*%20%2A%2A%2A%0A%0A*Nome*%3A%20${encodeURIComponent(nome)}%0A*Produto%20(Código)*%3A%20${encodeURIComponent(produto)}%0A*Data%20da%20Compra*%3A%20${encodeURIComponent(dataFormatada)}%0A%0A%2A%2A%2A%20*Obrigado%20por%20ativar%20sua%20garantia!*%2A%2A%2A`;

                // Abre o WhatsApp
                window.open(whatsappUrl, '_blank');

                // Envia o formulário após a simulação
                warrantyForm.submit(); // Envia o formulário

            }, 1000); // Tempo de simulação
        });
    }
    // ====================================================================
    // MÁSCARAS PARA CPF E WHATSAPP (USANDO IMASK)
    // ====================================================================
    const cpfInputMask = document.getElementById("cpf");
    if (cpfInputMask) {
        IMask(cpfInputMask, {
            mask: "000.000.000-00",
        });
    }

    const whatsappInput = document.getElementById("whatsapp");
    if (whatsappInput) {
        IMask(whatsappInput, {
            mask: "(00) 00000-0000",
        });
    }
    // ====================================================================
    // Funcao valida cpf no input e nome/sobrenome -> |garantia|
    // ====================================================================

    // Função para validar o CPF
    function validarCpf(cpf) {
        const cpfLimpo = cpf.replace(/\D/g, ''); // Remove qualquer caractere não numérico
        if (cpfLimpo.length !== 11) return false;

        // Validações básicas de CPF (exemplo de lógica simplificada)
        let soma = 0;
        let resto;

        if (/^(\d)\1{10}$/.test(cpfLimpo)) return false; // Verifica se todos os dígitos são iguais

        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpfLimpo.charAt(i)) * (10 - i);
        }

        resto = soma % 11;
        if (resto < 2) resto = 0;
        else resto = 11 - resto;

        if (parseInt(cpfLimpo.charAt(9)) !== resto) return false;

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpfLimpo.charAt(i)) * (11 - i);
        }

        resto = soma % 11;
        if (resto < 2) resto = 0;
        else resto = 11 - resto;

        return parseInt(cpfLimpo.charAt(10)) === resto;
    }

    // CPF input - valida enquanto digita
    const cpfInput = document.getElementById("cpf");
    if (cpfInput) {
        cpfInput.addEventListener("input", () => {
            const cpf = cpfInput.value;
            const isValid = validarCpf(cpf);

            // Mostra ou esconde o erro de CPF
            if (isValid) {
                cpfInput.setCustomValidity('');
                cpfInput.classList.remove('invalid');
            } else {
                cpfInput.setCustomValidity('CPF inválido');
                cpfInput.classList.add('invalid');
            }
        });
    }

    // Função para validar o nome completo
    function validarNomeCompleto(nome) {
        // Regex para garantir pelo menos dois nomes separados por espaço
        const nomeRegex = /^[a-zA-ZÀ-ÿ]+(\s[a-zA-ZÀ-ÿ]+)+$/;
        return nomeRegex.test(nome);
    }

    const nomeInput = document.getElementById("nome");
    if (nomeInput) {
        nomeInput.addEventListener("input", () => {
            const nome = nomeInput.value;
            const isValid = validarNomeCompleto(nome);

            // Valida e mostra ou esconde a mensagem de erro
            if (isValid) {
                nomeInput.setCustomValidity('');  // Limpa a mensagem de erro
                nomeInput.classList.remove('invalid');  // Remove a classe de erro
            } else {
                nomeInput.setCustomValidity('Por favor, insira seu nome e sobrenome');
                nomeInput.classList.add('invalid');  // Adiciona a classe de erro
            }

            // Força a revalidação
            nomeInput.checkValidity(); // Isto faz a validação acontecer
        });
    }

    // ====================================================================
    // ======================= modal aceitar os termos =======================
    // ====================================================================
    const btnConcordo = document.getElementById('btnConcordo');
    const checkboxTermos = document.getElementById('termos');
    const termosModal = document.getElementById('termosModal');

    btnConcordo.addEventListener('click', function () {
        // Marca o checkbox
        checkboxTermos.checked = true;

        // Fecha o modal via API do Bootstrap
        const modalInstance = bootstrap.Modal.getInstance(termosModal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
});

