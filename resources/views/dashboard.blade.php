@extends('layout.dashboard.main')

@section('title', 'Dashboard - B2F Official')
@section('namepage', 'Dashboard')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="row">
                {{-- Total Streamer --}}
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Streamer</p>
                                        <h4 class="card-title">{{ $totalStreamer }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Gallery --}}
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-image"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Gallery/Project</p>
                                        <h4 class="card-title">{{ $totalGallery }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Streamer on Schedule --}}
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Streamer on Schedule</p>
                                        <h4 class="card-title">{{ $streamerOnSchedule }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">10 Streamer Teraktif (Bulan Ini)</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            {{-- ID diubah menjadi activeStreamerChart --}}
                            <canvas id="activeStreamerChart"></canvas>
                        </div>
                        <div id="activeStreamerLegend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('activeStreamerChart').getContext('2d');
        
        var colors = [
            '#f3545d',
            '#e67e22',
            '#d35400', 
            '#8e44ad', 
            '#177dff', 
            '#1abc9c', 
            '#2ecc71', 
            '#34495e', 
            '#95a5a6', 
            '#7f8c8d'  
        ];

        var streamerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: "Jumlah Sesi Live",
                    backgroundColor: colors,
                    borderColor: colors,
                    data: {!! json_encode($chartData) !!},
                    borderWidth: 1,
                    borderRadius: 5,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false 
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: { left: 15, right: 15, top: 15, bottom: 15 }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "500",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 20,
                            callback: function(value) { if (value % 1 === 0) { return value; } }
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "500"
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection