@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 20px;">
    <div class="login-container" role="main" aria-labelledby="reset-title" style="animation: fadeInUp 0.6s ease-out;">
        <header class="mb-4 text-center">
            <h1 id="reset-title" style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.8rem; color: #333;">
                Redefinir Senha
            </h1>
        </header>

        @if (session('status'))
            <div class="alert alert-success text-center fw-semibold" role="alert" style="font-size: 0.95rem;">
                {{ session('status') }}
            </div>
        @endif

        <p class="mb-4 text-center text-muted" style="font-size: 0.95rem;">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <!-- Campo de e-mail -->
            <div class="form-group">
                <label for="email" class="form-label fw-semibold">E-mail</label>
                <input
                    type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autocomplete="email" autofocus
                    placeholder="seuemail@dominio.com"
                    aria-describedby="emailHelp"
                >
                @error('email')
                    <div class="invalid-feedback d-block" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Botão -->
            <div class="d-grid">
                <button type="submit" class="btn btn-lg w-100 text-white"
                    style="background-color: #a9818a; font-weight: 600; letter-spacing: 0.03em;">
                    Enviar link de redefinição
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
