$(document).ready(function() {

    // Gráfica de Área: Progreso de Tareas Completadas por Mes
    var ctxArea = document.getElementById('revenue-chart-canvas').getContext('2d');
    var areaChart = new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [
                {
                    label: 'Tareas Completadas',
                    data: [5, 7, 8, 6, 12, 10, 13, 15, 11, 13, 16, 17],
                    borderColor: 'rgba(60,141,188,0.8)',
                    backgroundColor: 'rgba(60,141,188,0.3)',
                    fill: true
                },
                {
                    label: 'Tareas KO',
                    data: [2, 3, 2, 5, 4, 3, 5, 3, 4, 2, 4, 5],
                    borderColor: 'rgba(255,99,132,0.8)',
                    backgroundColor: 'rgba(255,99,132,0.3)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 20
                }
            }
        }
    });



    // Gráfica Donut: Distribución de Estados de las Tareas
    var ctxDonut = document.getElementById('sales-chart-canvas').getContext('2d');
    var donutChart = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Pendientes', 'Completadas', 'En Proceso'],
            datasets: [{
                data: [40, 30, 30], // Proporción en porcentajes
                backgroundColor: ['#f56954', '#00a65a', '#f39c12']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Gráfica de Barras: Comparación de Tareas por Tipo de Fuente
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['S3', 'StartTime', 'LogGroup'],
            datasets: [{
                label: 'Tareas',
                backgroundColor: ['#3b8bba', '#f39c12', '#00a65a'],
                data: [15, 10, 5] // Número de tareas por tipo
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 20
                }
            }
        }
    });

});