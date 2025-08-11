<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Chiara Semijoias</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--background-color);
        }

        .login-container {
            background-color: var(--white-color);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeSlideIn 0.8s ease forwards;
        }

        @keyframes fadeSlideIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container .logo-container {
            margin-bottom: 30px;
        }

        .login-container h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .login-container .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .login-container .form-group input.is-invalid {
            border-color: #dc3545;
        }

        .login-container .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .login-container .submit-button {
            margin-top: 10px;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <header>
            <div class="logo-container">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo Chiara Semijoias" class="logo">
            </div>
            <h1>Acesso ao Dashboard</h1>
        </header>

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif

                <div style="text-align: right; margin-top: 6px;">
                    <a href="{{ route('password.request') }}"
                        style="font-size: 0.875rem; color: #a86d7a; text-decoration: none;">
                        Esqueceu a senha?
                    </a>
                </div>
            </div>

            @if ($errors->has('email') || $errors->has('password'))
                <div class="invalid-feedback" style="text-align:center; margin-bottom: 10px;">
                    Email ou senha incorretos.
                </div>
            @endif

            <button type="submit" class="submit-button">Entrar</button>
        </form>

    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            const button = this.querySelector('.submit-button');
            button.textContent = 'Autenticando...';
            button.disabled = true;
        });
    </script>
</body>

</html>
