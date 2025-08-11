@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: LISTAR USUÁRIOS -->
    <section id="user-list" class="page-content">

        <h1 class="page-title">Lista de Usuários</h1>

        <!-- Formulário de Pesquisa -->
        <div class="toolbar">
            <form method="GET" action="{{ route('usuario.index') }}" class="search-form">
                <input type="text" id="user-search" name="user-search" class="search-input"
                    placeholder="Buscar por nome ou email..." value="{{ request('user-search') }}">
                <button type="submit" class="search-btn">Buscar</button>
            </form>
        </div>

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

        <!-- Tabela de Usuários -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nível de Acesso</th>
                        <th>Data de Cadastro</th>
                        @auth
                            @if (auth()->user()->acesso === 'Admin')
                                <th>Ações</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody class="mb-3">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->acesso ?? 'Usuário Padrão' }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (auth()->user()->acesso === 'Admin' && auth()->user()->id === 1)
                                    <!-- Ícone de Ver -->
                                    <a href="{{ route('usuario.edit', $user->id) }}" class="btn btn-primary" title="Ver">
                                        <i class="fas fa-eye"></i> <!-- Ícone de Olho -->
                                    </a>
                                @elseif(auth()->user()->acesso === 'Admin' && $user->id !== 1)
                                    <!-- Ícone de Ver -->
                                    <a href="{{ route('usuario.edit', $user->id) }}" class="btn btn-primary"
                                        title="Ver">
                                        <i class="fas fa-eye"></i> <!-- Ícone de Olho -->
                                    </a>
                                @endif

                                @if (auth()->user()->acesso === 'Admin')
                                    <!-- Formulário para deletar com ícone de Lixeira -->
                                    <form action="{{ route('usuario.destroy', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        @if ($user->id !== 1)
                                            <button type="button" class="btn btn-danger" onclick="confirmarExclusao(this)"
                                                title="Excluir">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif

                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarExclusao(button) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não poderá ser desfeita.",
                icon: 'warning',
                background: '#f7f5f6', // Fundo suave da marca
                color: '#4a4a4a', // Texto cinza escuro
                iconColor: '#a9818a', // Rosa antigo para ícone
                showCancelButton: true,
                confirmButtonColor: '#a9818a', // Rosa antigo para botão confirmar
                cancelButtonColor: '#6c757d', // Cinza neutro
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar',
                customClass: {
                    title: 'fw-semibold',
                    confirmButton: 'text-white',
                    cancelButton: ''
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = button.closest('form');
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>

@endsection
