let employeeChart;

async function fetchChartData(companyId = 'all', showLoader = true) {
    if (showLoader) {
        document.getElementById('employeeChartLoader').style.display = 'block';
        document.getElementById('employeeChartWrapper').style.display = 'none';
    }

    try {
        const response = await fetch(`/charts/employee?company_id=${companyId}`);
        const data = await response.json();

        const departmentInfo = data.employee.map((name, index) => ({
            name: name,
            total: data.number[index],
            active: data.actives[index],
            inactive: data.inactives[index]
        }));

        const ctx = document.getElementById('employeeChart').getContext('2d');

        if (employeeChart) {
            employeeChart.destroy();
        }

        const backgroundColors = [
            'rgba(255, 159, 64, 0.25)',   // Laranja claro
            'rgba(75, 192, 192, 0.25)',   // Verde claro
            'rgba(255, 102, 204, 0.25)',  // Rosa chiclete claro
            'rgba(0, 153, 255, 0.25)',    // Azul céu claro
            'rgba(255, 99, 132, 0.25)',   // Rosa claro
            'rgba(54, 162, 235, 0.25)',   // Azul claro
            'rgba(255, 206, 86, 0.25)',   // Amarelo claro
            'rgba(0, 204, 102, 0.25)',    // Verde limão claro
            'rgba(201, 203, 207, 0.25)',  // Cinza claro
            'rgba(153, 102, 255, 0.25)'   // Roxo claro
        ];

        const borderColors = [
            'rgba(255, 159, 64, 1)',     // Laranja escuro
            'rgba(75, 192, 192, 1)',     // Verde escuro
            'rgba(255, 102, 204, 1)',    // Rosa chiclete escuro
            'rgba(0, 153, 255, 1)',      // Azul céu escuro
            'rgba(255, 99, 132, 1)',     // Rosa escuro
            'rgba(54, 162, 235, 1)',     // Azul escuro
            'rgba(255, 206, 86, 1)',     // Amarelo escuro
            'rgba(0, 204, 102, 1)',      // Verde limão escuro
            'rgba(201, 203, 207, 1)',    // Cinza escuro
            'rgba(153, 102, 255, 1)'     // Roxo escuro
        ];

        const datasets = data.employee.map((department, index) => ({
            label: department,
            data: [data.number[index]],
            backgroundColor: backgroundColors[index % backgroundColors.length],
            borderColor: borderColors[index % borderColors.length],
            borderWidth: 2
        }));

        const maxYValue = Math.max(...data.number.map(n => parseInt(n))) + 1.5;

        employeeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Funcionários'],
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const index = context.datasetIndex;
                                const info = departmentInfo[index];
                                return `${info.name}: ${info.total} funcionários (${info.active} ativos, ${info.inactive} inativos)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: maxYValue,
                        ticks: {
                            stepSize: 0.5,
                        }
                    }
                }
            }
        });

        if (showLoader) {
            document.getElementById('employeeChartLoader').style.display = 'none';
            document.getElementById('employeeChartWrapper').style.display = 'block';
        }
    } catch (error) {
        console.error('Erro ao buscar dados de funcionários:', error);
    }
}

// document.addEventListener('DOMContentLoaded', function () {
//     fetchChartData();

//     // Atualiza a cada 5 segundos sem mostrar loader
//     setInterval(() => {
//         fetchChartData('all', false);
//     }, 30000);
// });

document.querySelectorAll('input[name="companyFilter"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        const companyId = this.value;
        fetchChartData(companyId);
    });
});
