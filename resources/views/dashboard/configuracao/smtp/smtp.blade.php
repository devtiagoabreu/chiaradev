@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: CONFIGURAÇÕES SMTP -->
    <section id="smtp-settings" class="page-content mt-5 active">


        <!-- Exibindo mensagens de sucesso ou erro -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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

        <form class="dashboard-form" action="{{ route('smtp.update') }}" method="POST">
            @csrf
            <h1 class="page-title mb-5 mt-3" style="text-align: center">Configurações de E-mail (SMTP)</h1>
            <div class="form-group">
                <label for="host">Servidor SMTP</label>
                <input type="text" id="host" name="host" placeholder="smtp.example.com"
                    value="{{ old('host', optional($smtp)->host) }}">
            </div>
            <div class="form-group">
                <label for="port">Porta</label>
                <input type="number" id="port" name="port" placeholder="587"
                    value="{{ old('port', optional($smtp)->port) }}">
            </div>
            <div class="form-group">
                <label for="encryption">Criptografia</label>
                <select id="encryption" name="encryption" class="form-control">
                    <option value="" disabled {{ old('encryption', optional($smtp)->encryption) ? '' : 'selected' }}>
                        Selecione
                    </option>
                    <option value="tls" {{ old('encryption', optional($smtp)->encryption) == 'tls' ? 'selected' : '' }}>
                        TLS
                    </option>
                    <option value="ssl" {{ old('encryption', optional($smtp)->encryption) == 'ssl' ? 'selected' : '' }}>
                        SSL
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="seu-email@example.com"
                    value="{{ old('username', optional($smtp)->username) }}">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="********">
            </div>
            <div class="form-group">
                <label for="from_address">Endereço de E-mail</label>
                <input type="email" id="from_address" name="from_address" placeholder="seu-email@example.com"
                    value="{{ old('from_address', optional($smtp)->from_address) }}">
            </div>
            <button type="submit" class="submit-btn">Salvar Configurações</button>
        </form>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
