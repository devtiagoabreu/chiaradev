@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: ATUALIZAR USUÁRIO -->
    <section id="user-update" class="page-content mt-5">


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

        <!-- Formulário de Atualização -->
        <form action="{{ route('usuario.update', $user->id) }}" method="POST" class="dashboard-form">
            @csrf
            <h1 class="page-title mt-3 mb-5" style="text-align: center">Atualizar Usuário</h1>
            @method('PATCH')

            <!-- Nome Completo -->
            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="form-control">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="form-control">
            </div>

            <!-- Senha -->
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control">
                <small>Deixe em branco caso não queira alterar a senha.</small>
            </div>

            <!-- Confirmação de Senha -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <label for="acesso">Acesso</label>

                {{-- Ninguém pode editar o acesso do usuário com ID 1 --}}
                @if ($user->id === 1)
                    <select class="form-control" disabled>
                        <option value="user" {{ $user->acesso === 'User' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->acesso === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <input type="hidden" name="acesso" value="{{ $user->acesso }}">

                    {{-- O usuário logado é o super admin (id 1): pode editar qualquer outro --}}
                @elseif(auth()->user()->id === 1)
                    <select id="acesso" name="acesso" class="form-control">
                        <option value="user" {{ $user->acesso === 'User' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->acesso === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>

                    {{-- Admin comum (id diferente de 1), editando usuário que também NÃO é o 1 --}}
                @elseif(auth()->user()->acesso === 'Admin' && auth()->user()->id !== 1 && $user->id !== 1)
                    <select id="acesso" name="acesso" class="form-control">
                        <option value="user" {{ $user->acesso === 'User' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->acesso === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>

                    {{-- Qualquer outra situação: não pode editar --}}
                @else
                    <select class="form-control" disabled>
                        <option value="user" {{ $user->acesso === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->acesso === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <input type="hidden" name="acesso" value="{{ $user->acesso }}">
                @endif
            </div>


            <button type="submit" class="submit-btn">Atualizar Usuário</button>
        </form>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
