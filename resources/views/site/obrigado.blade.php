<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado! - Chiara Semijoias</title>
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <main class="container">
        <header>
            <div class="logo-container">
                <img src="{{asset('img/logo.svg')}}" alt="Logo Chiara Semijoias" class="logo">
            </div>
            <h1 class="page-title">Cadastro Recebido! ✨</h1>
            <p class="page-subtitle" style="max-width: 300px; margin: 15px auto;">Obrigado pelo seu interesse! Entraremos em contato pelo WhatsApp em breve.</p>
        </header>
        <section class="links">
            <a href="{{route('site.index')}}" class="link-button">← Voltar para o Início</a>
        </section>
    </main>
</body>
</html>