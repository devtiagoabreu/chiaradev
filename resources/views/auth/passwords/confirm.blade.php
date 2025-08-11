@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 20px;">
    <div class="login-container" role="main" aria-labelledby="confirm-title" style="animation: fadeInUp 0.6s ease-out;">
        <header class="mb-4 text-center">
            <h1 id="confirm-title" style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.8rem; color: #333;">
                Confirmar Senha
            </h1>
        </header>

        <p class="mb-4 text-center text-muted" style="font-size: 0.95rem;">
            Por favor, confirme sua senha antes de continuar.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="password" class="form-label fw-semibold">Senha</label>
                <input
                    id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password"
                    placeholder="Digite sua senha"
                    aria-describedby="passwordHelp"
                >
                @error('password')
                    <div class="invalid-feedback d-block" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-lg w-100 text-white"
                        style="background-color: #a9818a; font-weight: 600; letter-spacing: 0.03em;">
                    Confirmar Senha
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-decoration-none small"
                       style="color: #a9818a; font-weight: 500;">
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
