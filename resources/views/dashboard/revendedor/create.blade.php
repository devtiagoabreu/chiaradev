@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: CADASTRAR/EDITAR REVENDEDOR -->
    <section id="seller-create" class="page-content active mt-5">

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

        <!-- Formulário de Cadastro -->
        <form class="dashboard-form" method="POST" action="{{ route('app.revendedor.store') }}">
            @csrf
            <h1 class="page-title mb-5 mt-3" style="text-align: center">Cadastrar Novo Revendedor</h1>
            <!-- Nome Completo -->
            <div class="form-group">
                <label for="seller-name">Nome Completo</label>
                <input type="text" id="seller-name" name="nome_completo" value="{{ old('nome_completo') }}"
                    class="upercase" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required maxlength="14"
                    placeholder="000.000.000-00" autocomplete="off" />
                <small class="form-error">{{ $errors->first('cpf') }}</small>
            </div>

            <!-- WhatsApp -->
            <div class="form-group">
                <label for="seller-whatsapp">WhatsApp</label>
                <input type="tel" id="seller-whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required>
            </div>

            <!-- Cidade/Estado -->
            <div class="form-group">
                <label for="seller-city">Cidade/Estado</label>
                <input type="text" id="seller-city" name="cidade_estado" class="upercase"
                    value="{{ old('cidade_estado') }}" required>
            </div>

            <!-- Instagram (Opcional) -->
            <div class="form-group">
                <label for="seller-instagram">Instagram (Opcional)</label>
                <input type="text" id="seller-instagram" name="instagram" value="{{ old('instagram') }}">
            </div>

            <!-- Tipo de Vendedor -->
            <div class="form-group">
                <label for="tipo_vendedor">Tipo de Vendedor</label>
                <select id="tipo_vendedor" name="tipo_vendedor" required>
                    <option value="Varejo" {{ old('tipo_vendedor') === 'Varejo' ? 'selected' : '' }}>Varejo</option>
                    <option value="Atacado" {{ old('tipo_vendedor') === 'Atacado' ? 'selected' : '' }}>Atacado</option>
                </select>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Pendente" {{ old('status') === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Aprovado" {{ old('status') === 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                    <option value="Rejeitado" {{ old('status') === 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                </select>
            </div>

            <!-- Botão de Envio -->
            <button type="submit" class="submit-btn">Salvar Revendedor</button>
        </form>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
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
@endsection
