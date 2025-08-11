@extends('dashboard._layouts.layout')

@section('conteudo')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('alert_message'))
        <script>
            Swal.fire({
                title: 'Olá!',
                text: "{{ session('alert_message') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    <!-- PÁGINA: DASHBOARD HOME -->
    <section id="dashboard-home" class="page-content active">
        <!-- Cards com informações principais -->
        <div class="kpi-cards">
            <!-- Card de Total de Leads -->
            <div class="card">
                <i class="fas fa-users-line card-icon"></i>
                <div class="card-content">
                    <h3>Total de Leads</h3>
                    <p>{{ $cliquesTotal }}</p>
                </div>
            </div>

            <!-- Card de Garantias Ativas -->
            <div class="card">
                <i class="fas fa-shield-alt card-icon"></i>
                <div class="card-content">
                    <h3>Garantias Ativas</h3>
                    <p>{{ $garantia }}</p>
                </div>
            </div>

            <!-- Card de Garantias nos Últimos 30 dias -->
            <div class="card">
                <i class="fas fa-calendar-alt card-icon"></i>
                <div class="card-content">
                    <h3>Garantias (Últimos 30 dias)</h3>
                    <p>{{ $garantiasUltimos30Dias }}</p>
                </div>
            </div>

            <!-- Card de Revendedores Aprovados -->
            <div class="card">
                <i class="fas fa-store-alt card-icon"></i>
                <div class="card-content">
                    <h3>Revendedores Aprovados</h3>
                    <p>{{ $revendedorAprovados }}</p>
                </div>
            </div>
        </div>

        <!-- Containers dos Gráficos -->
        <div class="charts-container mt-5">
            <!-- Gráfico de Atividade Mensal (Leads vs Garantias) -->
            <div class="chart-wrapper">
                <h3>Atividade Mensal (Leads e Garantias)</h3>
                <canvas id="monthlyActivityChart"></canvas>
            </div>

            <!-- Gráfico de Origem dos Leads -->
            <div class="chart-wrapper mt-5 mb-5">
                <h3>Origem dos Leads</h3>
                <canvas id="leadSourceChart"></canvas>
            </div>
        </div>
    </section>

    <script>
        // Pegando os dados do Blade
        const cliquesTotal = @json($cliquesTotal);
        const cliquesTikTok = @json($cliquesTikTok);
        const cliquesInstagram = @json($cliquesInstagram);
        const cliquesWhatsapp = @json($cliquesWhatsapp);
        const garantia = @json($garantia);
        const garantiasUltimos30Dias = @json($garantiasUltimos30Dias);
        const revendedorAprovados = @json($revendedorAprovados);
        const leadsPorMes = @json($leadsPorMes); // Dados mensais de leads
        const garantiasPorMes = @json($garantiasPorMes)
    </script>
@endsection
