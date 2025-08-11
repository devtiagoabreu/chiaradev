<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="{{ csrf_token() }}">
    <title>Chiara Semijoias - Links Oficiais</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <main class="container">

        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <header>
            <div class="logo-container">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo Chiara Semijoias" class="logo">
            </div>
        </header>

        <!-- ====================================================== -->
        <!--   NOVO: CONTÊINER DA MENSAGEM DE SUCESSO (ADICIONAR)   -->
        <!-- ====================================================== -->
        <div id="success-message-box" class="success-box" style="display: none;">
            <p><i class="fa-solid fa-circle-check"></i> Garantia ativada com sucesso!</p>
            <span class="close-btn">×</span>
        </div>
        <!-- ====================================================== -->

        <section class="links">
            <!-- Botão em destaque para Garantia -->
            <a href="{{ route('garantia.index') }}" id="warranty-btn" class="link-button highlight">
                <i class="fa-solid fa-shield-halved"></i> Ativar Garantia
            </a>

            <!-- Botão para o formulário de Revendedora -->
            <a href="{{ route('revendedor.index') }}" class="link-button">
                <i class="fa-solid fa-gem"></i> Quero Ser Revendedora
            </a>

            <hr class="separator">

            <!-- Links para Redes Sociais -->
            <a href="{{ $instagram }}" onclick="handleSocialClick(event, 'instagram')" target="_blank"
                rel="noopener noreferrer" class="link-button social">
                <i class="fab fa-instagram"></i> Instagram
            </a>

            <a href="{{ $tiktok }}" onclick="handleSocialClick(event, 'tiktok')" target="_blank"
                rel="noopener noreferrer" class="link-button social">
                <i class="fab fa-tiktok"></i> TikTok
            </a>

            <a href="{{ $linkWhatsapp_loja }}" onclick="handleSocialClick(event, 'whatsapp')" target="_blank"
                rel="noopener noreferrer" class="link-button social">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
        </section>

        <footer>
            <p>© 2024 Chiara Semijoias. Todos os direitos reservados.</p>
        </footer>
    </main>

    <div id="warranty-modal-overlay" class="modal-overlay">
        <div class="modal-content">
            <!-- Estado Inicial do Modal -->
            <div id="modal-initial-content">
                <h2 class="modal-title">Quase lá!</h2>
                <p class="modal-text">Para ativar sua garantia, é obrigatório seguir nosso perfil no Instagram. É rápido
                    e você fica por dentro de todas as novidades!</p>
                <a href="https://www.instagram.com/chiarasemijoias" id="follow-instagram-btn" class="modal-button"
                    target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-instagram"></i> Seguir no Instagram
                </a>
                <button id="close-modal-btn" class="close-modal">Fechar</button>
            </div>

            <!-- Estado de Carregamento do Modal -->
            <div id="modal-loading-content" style="display: none;">
                <div class="spinner"></div>
                <h2 class="modal-title">Verificando...</h2>
                <p class="modal-text">Aguarde 10 segundos enquanto confirmamos.<br>Você será redirecionado para o
                    formulário em instantes.</p>
            </div>
        </div>
    </div>
</body>

<script>
    // ====================================================================
    // CONTADOR DE CLICK NOS LINKS
    // ====================================================================
    function handleSocialClick(event, platform) {
        event.preventDefault();

        const targetUrl = event.currentTarget.href;

        fetch('/social-click', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    platform: platform
                })
            })
            .then(response => {
                window.open(targetUrl, '_blank');
            })
            .catch(() => {
                window.open(targetUrl, '_blank');
            });
    }
</script>

</html>
