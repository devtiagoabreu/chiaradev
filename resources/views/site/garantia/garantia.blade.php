<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ativar Garantia - Chiara Semijoias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/imask"></script>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
    <main class="container">
        <header>
            <div class="logo-container">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo Chiara Semijoias" class="logo">
            </div>
            <h1 class="page-title">Ativar Garantia</h1>
        </header>

        <!-- Formulário para Ativar Garantia -->
        <form id="warranty-form" class="form-container" action="{{ route('garantia.store') }}" method="POST">
            @csrf
            <!-- Campo de Nome Completo -->
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome_completo" value="{{ old('nome_completo') }}"
                    placeholder="Ex. Maria joana" required>
                <small class="form-error">{{ $errors->first('nome_completo') }}</small>
            </div>

            <!-- Campo CPF com Validação -->
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required maxlength="14"
                    required placeholder="000.000.000-00" autocomplete="off" />
                <small class="form-error">{{ $errors->first('cpf') }}</small>
            </div>

            <!-- Campo Instagram -->
            <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" id="instagram" name="instagram" placeholder="@seu_usuario" required
                    value="{{ old('instagram') }}">
                <small class="form-error">{{ $errors->first('instagram') }}</small>
            </div>

            <!-- Campo Produto ou Código da Peça -->
            <div class="form-group">
                <label for="produto">Produto ou Código da Peça</label>
                <input type="text" id="produto" name="produto_codigo" value="{{ old('produto_codigo') }}"
                    required>
            </div>

            <!-- Campo Data da Compra -->
            <div class="form-group">
                <label for="data_compra">Data da Compra</label>
                <input type="date" id="data_compra" name="data_da_compra" value="{{ old('data_da_compra') }}"
                    required>
            </div>

            <!-- Campo Nome da Revendedora (se aplicável) -->
            <div class="form-group">
                <label for="revendedora">Nome da Revendedora (se aplicável)</label>
                <input type="text" id="revendedora" name="nome_da_revendedora"
                    value="{{ old('nome_da_revendedora') }}">
            </div>

            <!-- Campo WhatsApp -->
            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input type="tel" id="whatsapp" name="whatsapp" placeholder="(XX) XXXXX-XXXX"
                    value="{{ old('whatsapp') }}" required>
            </div>

            <!-- Checkbox de Aceite de Termos -->
            <div class="form-group checkbox-group">
                <input type="checkbox" id="termos" name="aceite_termos" required
                    {{ old('aceite_termos') ? 'checked' : '' }}>
                <label for="termos">
                    Li e aceito os
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termosModal">termos de garantia e política
                        de privacidade</a>.
                </label>
            </div>


            <!-- Checkbox de Aceite de Promoções -->
            <div class="form-group checkbox-group">
                <input type="checkbox" id="promocoes" name="aceite_whatsapp" required
                    {{ old('aceite_whatsapp') ? 'checked' : '' }}>
                <label for="promocoes">
                    Aceito receber mensagens no WhatsApp com atualizações e promoções.
                </label>
            </div>

            <!-- Botão de Submissão -->
            <button type="submit" class="submit-button">Ativar Minha Garantia</button>
        </form>
    </main>

    <div id="whatsapp-confirm-modal" class="modal-overlay">
        <div class="modal-content">
            <!-- TEXTO ALTERADO AQUI -->
            <h2 class="modal-title">Quase lá!</h2>
            <p class="modal-text">Seus dados foram validados. Para finalizar, clique no botão abaixo e envie a mensagem
                de confirmação no WhatsApp.</p>
            <button id="confirm-and-send-btn" class="modal-button whatsapp-button">
                <i class="fab fa-whatsapp"></i> Confirmar no WhatsApp
            </button>
            <button id="close-confirm-modal-btn" class="close-modal">Cancelar</button>
        </div>
    </div>

    <div class="modal fade" id="termosModal" tabindex="-1" aria-labelledby="termosModalLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 95%; width: 900px; display: flex; justify-content: center; align-items: center;">
            <!-- Modal Content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termosModalLabel">Termos de Garantia e Privacidade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body" style="padding: 40px;">
                    <p><strong>CHIARA SEMIJOIAS</strong><br>
                        <strong>TERMO DE GARANTIA</strong>
                    </p>

                    <p><strong>1. Garantia Legal e Contratual</strong><br>
                        Este documento tem como finalidade assegurar ao consumidor os direitos garantidos pelo Código de
                        Defesa do Consumidor (Lei nº 8.078/90), além de estabelecer as condições da garantia contratual
                        oferecida pela empresa Chiara Semijoias.</p>

                    <p><strong>2. Vigência da Garantia</strong><br>
                        A garantia é válida por 01 (um) ano a contar da data de compra, desde que o presente Termo
                        esteja devidamente preenchido e o cliente tenha realizado o cadastro completo de garantia junto
                        à loja, incluindo o aceite dos termos.</p>

                    <p><strong>3. Cobertura da Garantia</strong><br>
                        Durante o período de vigência, esta garantia cobre exclusivamente:<br>
                        - Defeitos de fabricação;<br>
                        - Desgaste natural do banho;<br>
                        - Quebra do fecho por defeito de fabricação.</p>

                    <p><strong>4. Exclusões de Garantia</strong><br>
                        Estão excluídos da cobertura:<br>
                        - Peças escurecidas por sujeira;<br>
                        - Peças quebradas ou arrebentadas na trama;<br>
                        - Danos causados por impacto, queda, amassados, arranhões ou uso inadequado;<br>
                        - Danos decorrentes de uso de produtos químicos, cosméticos, contato com suor excessivo, água do
                        mar ou piscina;<br>
                        - Peças incompletas ou com sinais de tentativa de reparo externo.</p>

                    <p><strong>5. Recomendações de Uso</strong><br>
                        Para manter a qualidade e a durabilidade das peças, recomenda-se:<br>
                        - Evitar contato com perfumes, cremes, produtos de limpeza, suor excessivo e ambientes
                        úmidos;<br>
                        - Retirar as peças antes do banho, da prática de esportes e do uso de piscinas ou mar.</p>

                    <p><strong>6. Dicas de Conservação</strong><br>
                        - Limpar as peças com frequência, utilizando água e sabão neutro;<br>
                        - Secar bem com pano macio e armazenar separadamente, em local seco e arejado.</p>

                    <p><strong>7. Ativação da Garantia</strong><br>
                        A garantia somente será válida mediante:<br>
                        - Preenchimento completo do formulário de garantia;<br>
                        - Apresentação da nota fiscal ou comprovante de compra;<br>
                        - Confirmação de que o cliente segue a loja no Instagram (@chiarasemijoias);<br>
                        - Aceite, no ato do cadastro, do recebimento de comunicações e promoções por WhatsApp.</p>

                    <p><strong>8. Atendimento</strong><br>
                        Para acionamento da garantia, entre em contato via WhatsApp (16) 99361-2101, informando os dados
                        da compra e apresentando foto ou vídeo da peça para avaliação prévia.</p>

                    <hr>

                    <h6>Política de Privacidade</h6>
                    <p>
                        Ao preencher o formulário de ativação de garantia ou interagir com nossos canais de atendimento,
                        a Chiara Semijoias coleta alguns dados pessoais com o objetivo de oferecer um serviço
                        personalizado, eficiente e seguro.
                    </p>

                    <p><strong>Dados coletados:</strong></p>
                    <ul>
                        <li>Nome completo</li>
                        <li>CPF</li>
                        <li>Número de WhatsApp</li>
                        <li>Usuário do Instagram</li>
                        <li>Código ou descrição do produto adquirido</li>
                        <li>Data da compra</li>
                        <li>Nome da revendedora (quando informado)</li>
                    </ul>

                    <p>
                        Esses dados são fornecidos voluntariamente por você e são utilizados exclusivamente para:
                    </p>
                    <ul>
                        <li>Identificar o consumidor e ativar a garantia do produto;</li>
                        <li>Realizar atendimentos e comunicações relacionadas à compra e pós-venda;</li>
                        <li>Enviar atualizações, ofertas e conteúdos promocionais via WhatsApp, quando autorizado;</li>
                        <li>Atender às obrigações legais ou regulatórias, se necessário.</li>
                    </ul>

                    <p>
                        A Chiara Semijoias respeita sua privacidade e se compromete a não compartilhar suas informações
                        com terceiros sem seu consentimento, salvo quando exigido por lei.
                    </p>

                    <p>
                        Seus dados são armazenados de forma segura e utilizados apenas pelo tempo necessário para os
                        fins descritos acima. Você pode solicitar a correção ou exclusão de seus dados a qualquer
                        momento, entrando em contato pelos nossos canais oficiais.
                    </p>

                    <p>
                        Ao prosseguir com o preenchimento e envio do formulário, você declara estar ciente e de acordo
                        com esta Política de Privacidade.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="modal-button" id="btnConcordo"
                        style="background: #A9818A">Concordo</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Variaveis para js --}}
    <!-- Carregar o Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const numeroWhatsapp = @json($whatsapp->whatsapp ?? '');
        const mensagem = @json($whatsapp->mensagem_garantia ?? '');

        if (!numeroWhatsapp) {
            alert('Número do WhatsApp não está configurado. Por favor, entre em contato com o administrador.');
            window.location.href = '/';
        }
    </script>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Estilo geral do modal */
        .modal-dialog {
            max-width: 900px;
            width: 100%;
            margin: 1.75rem auto;
        }

        .modal-content {
            padding: 20px 30px;
            border-radius: 8px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-body {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #333;
        }

        .modal-body h6 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #a9818a;
        }

        .modal-body p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .modal-body ul {
            padding-left: 1.25rem;
            margin-bottom: 1.2rem;
        }

        .modal-body ul li {
            margin-bottom: 0.5rem;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Responsividade para telas menores */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-content {
                padding: 15px 20px;
            }

            .modal-body h6 {
                font-size: 1rem;
            }

            .modal-footer {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</body>

</html>
