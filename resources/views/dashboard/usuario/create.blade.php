@extends('dashboard._layouts.layout')

@section('conteudo')

    <!-- PÁGINA: CADASTRAR USUÁRIO -->
    <section id="user-create" class="page-content active mt-5">
        
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
        <form action="{{ route('usuario.store') }}" method="POST" class="dashboard-form">
            @csrf
            <h1 class="page-title mb-5 mt-3" style="text-align: center">Cadastrar Novo Usuário</h1>
            <!-- Nome Completo -->
            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="form-control">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="form-control">
            </div>

            <!-- Senha -->
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <!-- Confirmação de Senha -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="acesso">Acesso</label>
                <select id="acesso" name="acesso" class="form-control">
                    <option value="User" {{ old('acesso') }}>User</option>
                    <option value="Admin" {{ old('acesso') }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Salvar Usuário</button>
        </form>
    </section>
        <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection