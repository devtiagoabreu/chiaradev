@extends('dashboard._layouts.layout')

@section('conteudo')
    <!-- PÁGINA: LISTAR GARANTIAS -->
    <section id="warranty-list" class="page-content active">
        <h1 class="page-title mb-3 mt-3">Lista de Garantias Ativadas</h1>
        <div class="toolbar">
            <input type="search" id="warranty-search" class="search-input" placeholder="Buscar por cliente, CPF ou produto...">
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Produto</th>
                        <th>Data da Compra</th>
                        <th>Revendedor</th>
                    </tr>
                </thead>
                <tbody id="warranty-table-body">
                    @if ($garantias && $garantias->count() > 0)
                        @foreach ($garantias as $garantia)
                            <tr>
                                <td>{{ $garantia->nome_completo }}</td>
                                <td>{{ $garantia->cpf }}</td>
                                <td>{{ $garantia->produto_codigo }}</td>
                                <td>{{ \Carbon\Carbon::parse($garantia->data_compra)->format('d/m/Y') }}</td>
                                <td>{{ $garantia->nome_da_revendedora }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Nenhuma garantia encontrada.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination-container">
                @if ($garantias->onFirstPage())
                    <span class="disabled">« Anterior</span>
                @else
                    <a href="{{ $garantias->previousPageUrl() }}">« Anterior</a>
                @endif

                @for ($i = 1; $i <= $garantias->lastPage(); $i++)
                    <a href="{{ $garantias->url($i) }}"
                        class="{{ $garantias->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($garantias->hasMorePages())
                    <a href="{{ $garantias->nextPageUrl() }}">Próxima »</a>
                @else
                    <span class="disabled">Próxima »</span>
                @endif
            </div>
        </div>
    </section>
    <style>
        .page-content {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endsection
