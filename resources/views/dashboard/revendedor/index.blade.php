@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: LISTAR REVENDEDORES -->
    <section id="seller-list" class="page-content active">
        <h1 class="page-title">Lista de Revendedores</h1>

        <!-- Barra de ferramentas com filtros -->
        <div class="toolbar">
            <!-- Filtro de nome, telefone ou cidade -->
            <form method="GET" action="#">
                <input type="search" id="seller-search" name="search" class="search-input"
                    placeholder="Buscar por nome, telefone" value="{{ request('search') }}">

                <!-- Filtro de status -->
                <select name="status" class="status-select">
                    <option value="">Selecione o Status</option>
                    <option value="Aprovado" {{ request('aprovado') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                    <option value="Pendente" {{ request('pendente') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Rejeitado" {{ request('rejeitado') == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                </select>

                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>WhatsApp</th>
                        <th>Cidade/Estado</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="seller-table-body">
                    @foreach ($revendedores as $revendedor)
                        <tr>
                            <td>{{ $revendedor->nome_completo }}</td>
                            <td>{{ $revendedor->whatsapp }}</td>
                            <td>{{ $revendedor->cidade_estado }}</td>

                            @if ($revendedor->status === 'Aprovado')
                                <td class="status approved">{{ ucfirst($revendedor->status) }}</td>
                            @elseif($revendedor->status === 'Pendente')
                                <td class="status pending">{{ ucfirst($revendedor->status) }}</td>
                            @elseif($revendedor->status === 'Rejeitado')
                                <td class="status rejected">{{ ucfirst($revendedor->status) }}</td>
                            @endif
                            <td>
                                <!-- Botões de Ação com Ícones -->
                                @if ($revendedor->status !== 'Aprovado')
                                    <a href="{{ route('app.revendedor.aprovar', $revendedor->id) }}"
                                        class="btn btn-success" title="Aprovar">
                                        <i class="fas fa-check-circle"></i> <!-- Ícone de Aprovar -->
                                    </a>
                                @endif

                                <a href="{{ route('app.revendedor.edit', $revendedor->id) }}" class="btn btn-primary"
                                    title="Ver">
                                    <i class="fas fa-eye"></i> <!-- Ícone de Ver -->
                                </a>

                                @auth
                                    @if (Auth()->user()->acesso === 'Admin')
                                        <form action="{{ route('app.revendedor.destroy', $revendedor->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmarExclusao(this)"
                                                title="Excluir">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </td>

                        </tr>
                        <tr>
                            <td colspan="5">
                                <hr style="border: 1px solid #ddd; margin: 5px 0;">
                                <!-- Linha horizontal após cada linha -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginação personalizada -->
            <div class="pagination-container">
                @if ($revendedores->onFirstPage())
                    <span class="disabled">« Anterior</span>
                @else
                    <a href="{{ $revendedores->previousPageUrl() }}">« Anterior</a>
                @endif

                {{-- Páginas numéricas --}}
                @for ($i = 1; $i <= $revendedores->lastPage(); $i++)
                    <a href="{{ $revendedores->url($i) }}"
                        class="{{ $revendedores->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($revendedores->hasMorePages())
                    <a href="{{ $revendedores->nextPageUrl() }}">Próxima »</a>
                @else
                    <span class="disabled">Próxima »</span>
                @endif
            </div>
        </div>
    </section>
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
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
