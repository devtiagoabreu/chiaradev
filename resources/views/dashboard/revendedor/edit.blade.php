@extends('dashboard._layouts.layout')

@section('conteudo')
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
        <form class="dashboard-form" method="POST" action="{{ route('app.revendedor.update', $revendedor->id) }}">
            @csrf
            <h1 class="page-title mt-3 mb-5" style="text-align: center">Editar Revendedor</h1>
            @method('PUT') <!-- Para indicar que é uma requisição PUT (atualização) -->
            <div class="form-group">
                <label for="seller-name">Nome Completo</label>
                <input type="text" id="seller-name" name="nome_completo"
                    value="{{ old('nome_completo', $revendedor->nome_completo) }}" class="upercase" required>
            </div>

            <div class="form-group">
                <label for="seller-cpf">CPF</label>
                <input type="text" id="seller-cpf" name="cpf" value="{{ old('cpf', $revendedor->cpf) }}" required>
            </div>

            <div class="form-group">
                <label for="seller-whatsapp">WhatsApp</label>
                <input type="tel" id="seller-whatsapp" name="whatsapp"
                    value="{{ old('whatsapp', $revendedor->whatsapp) }}" required>
            </div>

            <div class="form-group">
                <label for="seller-city">Cidade/Estado</label>
                <input type="text" id="seller-city" name="cidade_estado"
                    value="{{ old('cidade_estado', $revendedor->cidade_estado) }}" class="upercase" required>
            </div>

            <div class="form-group">
                <label for="seller-instagram">Instagram (Opcional)</label>
                <input type="text" id="seller-instagram" name="instagram"
                    value="{{ old('instagram', $revendedor->instagram) }}">
            </div>

            <div class="form-group">
                <label for="tipo_vendedor">Seu interesse principal:</label>
                <select id="tipo_vendedor" name="tipo_vendedor" required>
                    <option value="Varejo"
                        {{ old('tipo_vendedor', $revendedor->tipo_vendedor) === 'Varejo' ? 'selected' : '' }}>Varejo
                    </option>
                    <option value="Atacado"
                        {{ old('tipo_vendedor', $revendedor->tipo_vendedor) === 'Atacado' ? 'selected' : '' }}>Atacado
                    </option>
                </select>
            </div>

            <!-- Campo Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Pendente" {{ old('status', $revendedor->status) === 'Pendente' ? 'selected' : '' }}>
                        Pendente</option>
                    <option value="Aprovado" {{ old('status', $revendedor->status) === 'Aprovado' ? 'selected' : '' }}>
                        Aprovado</option>
                    <option value="Rejeitado" {{ old('status', $revendedor->status) === 'Rejeitado' ? 'selected' : '' }}>
                        Rejeitado</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Salvar Revendedor</button>
        </form>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
