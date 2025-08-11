<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quero Ser Revendedora - Chiara Semijoias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
    <main class="container">
        <header>
            <div class="logo-container">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo Chiara Semijoias" class="logo">
            </div>
            <h1 class="page-title">Quero Ser Revendedora</h1>
            <p class="page-subtitle">Preencha o formulário e entraremos em contato em breve!</p>
        </header>

        <form id="reseller-form" class="form-container" method="POST" action="{{ route('revendedor.store') }}">
            @csrf

            <!-- Campo de Nome Completo -->
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome_completo" value="{{ old('nome_completo') }}"
                    placeholder="Ex. Maria joana" class="upercase" required>
                <small class="form-error">{{ $errors->first('nome_completo') }}</small>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required maxlength="14"
                    placeholder="000.000.000-00" autocomplete="off" />
                <small class="form-error">{{ $errors->first('cpf') }}</small>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade / Estado</label>
                <input type="text" id="cidade" name="cidade_estado" class="upercase" placeholder="Ex: São Paulo - SP"
                    value="{{ old('cidade_estado') }}" required>
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input type="tel" id="whatsapp" name="whatsapp" placeholder="(XX) XXXXX-XXXX"
                    value="{{ old('whatsapp') }}" required>
            </div>

            <div class="form-group">
                <label for="instagram">Instagram (opcional)</label>
                <input type="text" id="instagram" name="instagram" placeholder="@seu_usuario"
                    value="{{ old('instagram') }}">
                <small class="form-error">{{ $errors->first('instagram') }}</small>
            </div>

            <div class="form-group">
                <label>Seu interesse principal:</label>
                <div class="radio-group">
                    <input type="radio" id="varejo" name="tipo_vendedor" value="Varejo" required
                        {{ old('tipo_vendedor') === 'Varejo' ? 'checked' : '' }}>
                    <label for="varejo">Varejo</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="atacado" name="tipo_vendedor" value="Atacado"
                        {{ old('tipo_vendedor') === 'Atacado' ? 'checked' : '' }}>
                    <label for="atacado">Atacado</label>
                </div>
            </div>

            <button type="submit" class="submit-button">Enviar Cadastro</button>
        </form>
    </main>
    <script src="https://unpkg.com/imask"></script>
    <script>
        // Máscara para CPF
        const cpfMask = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });

        // Máscara para WhatsApp
        const whatsappMask = IMask(document.getElementById('whatsapp'), {
            mask: '(00) 00000-0000'
        });
    </script>
</body>

</html>
