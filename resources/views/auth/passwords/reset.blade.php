@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh; padding: 20px;">
    <div class="login-container" style="animation: fadeInUp 0.5s ease-out;">
        <div class="text-center mb-4">
            <h4 style="color: #333; font-weight: 700;">Redefinir Senha</h4>
        </div>

        <form method="POST" action="{{ route('password.update') }}" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- E-mail -->
            <div class="form-group">
                <label for="email" class="form-label fw-semibold">E-mail</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                    placeholder="exemplo@dominio.com">

                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nova Senha -->
            <div class="form-group">
                <label for="password" class="form-label fw-semibold">Nova Senha</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password"
                    placeholder="Digite sua nova senha">

                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar Senha -->
            <div class="form-group">
                <label for="password-confirm" class="form-label fw-semibold">Confirmar Nova Senha</label>
                <input id="password-confirm" type="password"
                    class="form-control"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirme sua nova senha">
            </div>

            <!-- Botão -->
            <button type="submit" class="btn w-100 text-white" style="background-color: #a9818a; font-weight: 600;">
                Redefinir Senha
            </button>

            <!-- Link de volta -->
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-semibold">
                    Voltar ao login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
