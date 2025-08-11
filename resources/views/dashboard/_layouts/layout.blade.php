<!doctype html>
<html lang="en">
<!-- Início da seção de cabeçalho -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>
    <!-- Início das tags de acessibilidade -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Fim das tags de acessibilidade -->
    <!-- Início das meta tags principais -->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE é um Dashboard Bootstrap 5 gratuito, com 30 páginas de exemplo usando Vanilla JS. Totalmente acessível com conformidade WCAG 2.1 AA." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, painel admin bootstrap 5, dashboard bootstrap 5, gráficos bootstrap 5, calendário bootstrap 5, datepicker bootstrap 5, tabelas bootstrap 5, datatable bootstrap 5, datatable vanilla js, colorlibhq, painel admin colorlibhq, painel admin colorlibhq acessível, WCAG compliant" />
    <!-- Fim das meta tags principais -->
    <!-- Início das funcionalidades de acessibilidade -->
    <!-- Links de pular serão adicionados dinamicamente pelo accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!-- Fim das funcionalidades de acessibilidade -->
    <!-- Início das fontes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!-- Fim das fontes -->
    <!-- Início do plugin de terceiros (OverlayScrollbars) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!-- Fim do plugin de terceiros (OverlayScrollbars) -->
    <!-- Início do plugin de terceiros (Bootstrap Icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!-- Fim do plugin de terceiros (Bootstrap Icons) -->
    <!-- Início do plugin obrigatório (AdminLTE) -->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!-- Fim do plugin obrigatório (AdminLTE) -->
    <!-- Início do apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- Fim do apexcharts -->
    <!-- Início do jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    <!-- Fim do jsvectormap -->
    <script src="{{ asset('js/dashboard/menu_dashboard.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('style/dashboard/menu_dashboard.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('style/dashboard/style.css') }}"> --}}
</head>
<!-- Fim da seção de cabeçalho -->

<!-- Início da seção do corpo -->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!-- Início do Wrapper do aplicativo -->
    <div class="app-wrapper">
        <!-- Início do Cabeçalho -->
        <nav class="app-header navbar navbar-expand bg-body ">
            <!-- Início do Container -->
            <div class="container-fluid">
                <!-- Início dos Links da Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a href="{{ route('dashboard.index') }}"
                            class="nav-link">Home</a></li>
                </ul>
                <!-- Fim dos Links da Navbar -->
                <!-- Início dos Links da Navbar (direita) -->
                <ul class="navbar-nav ms-auto">
                    <!--início::Menu suspenso do usuário-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&size=160"
                                class="user-image rounded-circle shadow" alt="Imagem do Usuário" />
                            <span class="d-none d-md-inline">{{ Auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--início::Imagem do Usuário-->
                            <li class="user-header text-bg-primary">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&size=160"
                                    class="rounded-circle shadow" alt="Imagem do Usuário" />


                                <p>
                                    {{ Auth()->user()->name }}
                                    <small>Membro desde
                                        {{ Auth()->user()->created_at->translatedFormat('d \d\e F \d\e Y') }}</small>
                                </p>
                            </li>
                            <!--fim::Imagem do Usuário-->
                            <a href="{{ route('usuario.edit', Auth()->user()->id) }}"
                                class="btn btn-default btn-flat float-right">Perfil</a>
                            <!--início::Rodapé do Menu-->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="button" onclick="confirmarLogout()"
                                    class="btn btn-default btn-flat float-end">Sair</button>
                            </form>

                    </li>
                    <!--fim::Rodapé do Menu-->
                </ul>
                </li>
                <!--fim::Menu suspenso do usuário-->
                </ul>
                <!--fim::Links de navegação-->
            </div>
            <!--fim::Container-->
        </nav>
        <!--fim::Cabeçalho-->
        <!--início::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--início::Marca do Sidebar-->
            <div class="sidebar-brand p-5">
                <!--início::Imagem da Marca-->
                <img src="{{ asset('img/logo.svg') }}"  alt="Logo da Chiara" />
            </div>
            <!--fim::Marca do Sidebar-->
            <!--início::Wrapper do Sidebar-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--início::Menu do Sidebar-->

                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="fas fa-users"></i>
                                <p>
                                    Usuário
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('usuario.index') }}" class="nav-link ">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                                @auth
                                    @if (auth()->user()->acesso === 'Admin')
                                        <li class="nav-item">
                                            <a href="{{ route('usuario.create') }}" class="nav-link">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>Cadastrar Usuário</p>
                                            </a>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Revendedores
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('app.revendedor.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Revendedor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('app.revendedor.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Cadastrar Revendedor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('app.garantia.index') }}" class="nav-link">
                                <i class="fas fa-shield-halved"></i>
                                <p>Garantias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('whatsapp') }}" class="nav-link">
                                <i class="fas fa-share-nodes"></i>
                                <p>Redes Sociais</p>
                            </a>
                        </li>
                        @auth
                            @if (auth()->user()->acesso === 'Admin')
                                <li class="nav-item">
                                    <a href="{{ route('smtp') }}" class="nav-link">
                                        <i class="fas fa-cogs"></i>
                                        <p>configuração</p>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <!--fim::Menu do Sidebar-->
                </nav>
            </div>
            <!--fim::Wrapper do Sidebar-->
        </aside>
        <!--fim::Sidebar-->
        <!--início::Main App-->
        <main class="app-main">
            <!--início::Cabeçalho do Conteúdo do App-->
            <div class="app-content-header">
                <!--início::Container-->
                <div class="container-fluid">
                    <!--início::Linha-->
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('conteudo')
                        </div>
                    </div>
                    <!--fim::Linha-->
                </div>
                <!--fim::Container-->
            </div>
            <!--fim::Cabeçalho do Conteúdo do App-->
        </main>
    </div>
    <!-- /.Início da coluna -->
    <!-- Fim da estrutura do aplicativo -->
    <!-- Início dos scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Início do plugin de terceiros (OverlayScrollbars) -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!-- Fim do plugin de terceiros (OverlayScrollbars) -->
    <!-- Início do plugin necessário (popperjs para o Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!-- Fim do plugin necessário (popperjs para o Bootstrap 5) -->
    <!-- Início do plugin necessário (Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- Fim do plugin necessário (Bootstrap 5) -->
    <!-- Início do plugin necessário (AdminLTE) -->
    <script src="./js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fim do plugin necessário (AdminLTE) -->
    <!-- Início da configuração do OverlayScrollbars -->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });

        function confirmarLogout() {
            Swal.fire({
                title: 'Deseja sair?',
                text: "Você será desconectado da plataforma.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--primary-color'),
                cancelButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--sidebar-bg'),
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar',
                background: getComputedStyle(document.documentElement).getPropertyValue('--card-bg'),
                color: getComputedStyle(document.documentElement).getPropertyValue('--text-color'),
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <!--end::OverlayScrollbars Configure-->
</body>
<!--end::Body-->

</html>
