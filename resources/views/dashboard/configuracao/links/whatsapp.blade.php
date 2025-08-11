@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: REDES SOCIAIS -->
    <section id="social-media-settings" class="page-content mt-5 active">

        <!-- Exibindo mensagens de sucesso ou erro -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('erro'))
            <div class="alert alert-danger">
                {{ session('erro') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="dashboard-form" method="POST" action="{{ route('whatsapp.update') }}">
            @csrf
            <h1 class="page-title mb-5 mt-3" style="text-align: center">Configuração de Redes Sociais</h1>
            <div class="form-group">
                <label for="instagram">
                    <i class="fab fa-instagram"></i> URL do Instagram
                </label>
                <input type="url" id="instagram" name="instagram"
                    value="{{ old('instagram', $whatsapp->instagram ?? 'https://www.instagram.com/chiarasemijoias') }}">
            </div>
            <div class="form-group">
                <label for="tiktok">
                    <i class="fab fa-tiktok"></i> <!-- Ícone TikTok -->
                    URL do TikTok
                </label>
                <input type="url" id="tiktok" name="tiktok"
                    value="{{ old('tiktok', $whatsapp->tiktok ?? 'https://www.tiktok.com/@SUA_CONTA_TIKTOK') }}">
            </div>
            <div class="form-group">
                <label for="whatsapp">
                    <i class="bi bi-whatsapp"></i> Número do WhatsApp (formato 5511999998888)
                </label>
                <input type="text" id="whatsapp" name="whatsapp"
                    value="{{ old('whatsapp', $whatsapp->whatsapp ?? '5511999998888') }}">
            </div>
            <div class="form-group">
                <label for="mensagem_garantia">
                    <i class="fas fa-shield-alt"></i> Mensagem de Garantia
                </label>
                <input type="text" id="mensagem_garantia" name="mensagem_garantia"
                    value="{{ old('mensagem_garantia', $whatsapp->mensagem_garantia ?? '') }}">
            </div>
            <div class="form-group">
                <label for="mensagem_loja">
                    <i class="bi bi-shop"></i> Mensagem da Loja
                </label>
                <input type="text" id="mensagem_loja" name="mensagem_loja"
                    value="{{ old('mensagem_loja', $whatsapp->mensagem_loja ?? '') }}">
            </div>
            <button type="submit" class="submit-btn">Salvar Links</button>
        </form>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
