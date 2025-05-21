let employeeChart; // Variável global

async function fetchChartData(companyId = 'all') {
    // Mostrar loader
    document.getElementById('employeeChartLoader').style.display = 'block';
    document.getElementById('employeeChartWrapper').style.display = 'none';

    try {
        const response = await fetch(`/charts/employee?company_id=${companyId}`);
        const data = await response.json();

        const ctx = document.getElementById('employeeChart').getContext('2d');

        // Se o gráfico já existir, destrói ele antes de criar um novo
        if (employeeChart) {
            employeeChart.destroy();
        }

        employeeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.employee,
                datasets: [{
                    label: 'Funcionários',
                    data: data.number,
                    backgroundColor: '#5e72e4',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.dataset.label || '';
                                const value = context.formattedValue;
                                const department = context.label;
                                return `Depart. ${department}: ${value} funcionários`;
                            }
                        }
                    }
                }
            }
        });

        // Esconde loader e mostra gráfico
        document.getElementById('employeeChartLoader').style.display = 'none';
        document.getElementById('employeeChartWrapper').style.display = 'block';
    } catch (error) {
        console.error('Erro ao buscar dados de funcionários:', error);
    }
}

// Inicializa o gráfico sem filtro
document.addEventListener('DOMContentLoaded', function () {
    fetchChartData();
});

// Escuta alterações nos botões de filtro
document.querySelectorAll('input[name="companyFilter"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        const companyId = this.value;
        fetchChartData(companyId);
    });
});