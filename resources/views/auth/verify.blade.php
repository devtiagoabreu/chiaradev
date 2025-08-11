@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 20px;">
    <div class="login-container" style="animation: fadeInUp 0.6s ease-out;" role="main" aria-labelledby="verify-title">
        <header class="text-center mb-4">
            <h1 id="verify-title" style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.6rem; color: #333;">
                Verifique Seu E-mail
            </h1>
        </header>

        <div class="text-center" style="font-size: 1rem; font-family: 'Montserrat', sans-serif;">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2 text-success" aria-hidden="true"></i>
                    <span>Um novo link de verificação foi enviado para o seu e-mail.</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <p class="mb-3">
                Antes de continuar, verifique seu e-mail para encontrar o link de verificação.
            </p>

            <p class="mb-0">
                Se você não recebeu o e-mail,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-decoration-none" style="color: #a9818a; font-weight: 600;">
                        clique aqui para solicitar outro
                    </button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection
