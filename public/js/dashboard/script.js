document.addEventListener('DOMContentLoaded', () => {

    // // ==================== LÓGICA DO MENU RETRÁTIL E NAVEGAÇÃO ====================



    // Gráfico de Atividade Mensal (Leads vs Garantias)
    const monthlyCtx = document.getElementById('monthlyActivityChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [
                {
                    label: 'Leads',
                    data: [
                        leadsPorMes[1], leadsPorMes[2], leadsPorMes[3], leadsPorMes[4],
                        leadsPorMes[5], leadsPorMes[6], leadsPorMes[7], leadsPorMes[8],
                        leadsPorMes[9], leadsPorMes[10], leadsPorMes[11], leadsPorMes[12]
                    ], // Dados de leads por mês
                    backgroundColor: 'rgba(169, 129, 138, 0.7)',
                    borderColor: 'rgba(169, 129, 138, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Garantias',
                    data: Array(12).fill(garantia), // Usando o valor de "garantia" para todos os meses
                    backgroundColor: 'rgba(140, 106, 115, 0.7)',
                    borderColor: 'rgba(140, 106, 115, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Gráfico de Origem dos Leads (TikTok, Instagram, WhatsApp)
    const leadSourceCtx = document.getElementById('leadSourceChart').getContext('2d');
    new Chart(leadSourceCtx, {
        type: 'doughnut',
        data: {
            labels: ['TikTok', 'Instagram', 'WhatsApp'],
            datasets: [{
                data: [cliquesTikTok, cliquesInstagram, cliquesWhatsapp], // Dados de cada origem
                backgroundColor: ['#000000', '#E1306C', '#25D366'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    // ==================== CHAMADAS INICIAIS ====================
    initCharts();
});
