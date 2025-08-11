@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 20px;">
    <div class="login-container" style="animation: fadeInUp 0.6s ease-out;" role="main" aria-labelledby="register-title">
        <header class="text-center mb-4">
            <h1 id="register-title" style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.6rem; color: #333;">
                Criar Nova Conta
            </h1>
        </header>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Nome -->
            <div class="form-group">
                <label for="name" class="form-label fw-semibold">Nome completo</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    placeholder="Seu nome completo">

                @error('name')
                    <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <!-- E-mail -->
            <div class="form-group">
                <label for="email" class="form-label fw-semibold">E-mail</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="exemplo@dominio.com">

                @error('email')
                    <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <!-- Senha -->
            <div class="form-group">
                <label for="password" class="form-label fw-semibold">Senha</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password"
                    placeholder="Digite sua senha">

                @error('password')
                    <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmação -->
            <div class="form-group mb-4">
                <label for="password-confirm" class="form-label fw-semibold">Confirmar senha</label>
                <input id="password-confirm" type="password"
                    class="form-control"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirme sua senha">
            </div>

            <!-- Botão -->
            <button type="submit" class="btn btn-lg w-100 text-white"
                style="background-color: #a9818a; font-weight: 600; letter-spacing: 0.03em; border-radius: 10px; padding: 14px 0;">
                Registrar
            </button>
        </form>
    </div>
</div>
@endsection
