@extends('layouts.main')
@section('title', 'Página Inicial')
@section('content')

<div class="container">
    <h1 class="text-center mt-2">Métricas</h1>

    {{-- Adicionar o gráfico de pizza --}}
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-center">Percentual de chamados resolvidos dentro do prazo no mês atual</h5>
            <div class="chart-container">
                <canvas id="callsPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        
        const resolvedPercentage = {{ $percentResolvedInTime }};
        const notResolvedPercentage = 100 - resolvedPercentage;

       
        const ctx = document.getElementById('callsPieChart').getContext('2d');
        const callsPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Resolvidos', 'Não Resolvidos'],
                datasets: [{
                    data: [resolvedPercentage, notResolvedPercentage],
                    backgroundColor: ['#4caf50', '#f44336'], {{-- Cores para resolvidos e não resolvidos --}}
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>

@endsection
