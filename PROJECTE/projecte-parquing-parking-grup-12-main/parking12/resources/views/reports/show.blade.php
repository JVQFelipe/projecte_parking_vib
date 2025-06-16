<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">Informe {{ $report->title }}</h2>

        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Detalls del Informe</h3>
            <p class="text-gray-600"><strong>Parking:</strong> {{ $report->parking->name }}</p>
            <p class="text-gray-600"><strong>Ingressos totals:</strong> {{ $report->total_ingressos }} €</p>
            <p class="text-gray-600"><strong>Total de Tickets:</strong> {{ $report->total_tickets }}</p>
            <p class="text-gray-600"><strong>Temps mitjà d'estància:</strong> {{ $report->avg_time }} minutos</p>
            <p class="text-gray-600"><strong>Fecha de Creació:</strong> {{ $report->created_at->format('d/m/Y') }}</p>
            <p class="text-gray-600"><strong>Places ocupades:</strong> {{ $occupied }}</p>
            <p class="text-gray-600"><strong>Places disponibles:</strong> {{ $available }}</p>
        </div>

        <!-- Gráfico de barras para mostrar estadísticas -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Estadísticas Gráficas</h3>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="occupancyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Incluir Chart.js desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('occupancyChart').getContext('2d');
        var occupancyChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Plazas Ocupadas', 'Plazas Disponibles'], 
                datasets: [{
                    label: 'Estadísticas del Informe', 
                    data: [{{ $occupied }}, {{ $available }}], 
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)'], 
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)'], 
                    borderWidth: 1 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#333'  // Asegura que las etiquetas de la leyenda sean legibles
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
