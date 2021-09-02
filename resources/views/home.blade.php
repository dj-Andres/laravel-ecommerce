@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Panel de Administración
            </h3>
        </div>
        <div class="row">
                @foreach ($totalcompra as $totalc)
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card text-white bg-warning">
                        <div class="card-body pb-0">
                            <div class="float-right">
                                <i class="fas fa-cart-arrow-down fa-4x"></i>
                            </div>
                            <div class="text-value h4">
                                <strong>$ {{ number_format($totalc->totalcompra,2) }} (MES ACTUAL)</strong>
                            </div>
                            <div class="h3">Compras</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            <a href="{{ route('purchases.index') }}" class="small-box-footer h4">Compras <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach ($totalventa as $totalv)
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card  text-white bg-info">
                        <div class="card-body pb-0">
                            <div class="float-right">
                                <i class="fas fa-shopping-cart fa-4x"></i>
                            </div>
                            <div class="text-value h4">
                                <strong>$ {{ number_format($totalv->totalventa,2) }} (MES ACTUAL) </strong>
                            </div>
                            <div class="h3">Ventas</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            <a href="{{ route('sales.index') }}" class="small-box-footer h4">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Ventas diarias
                    </h4>
                    <canvas id="ventas_diarias" height="100"></canvas>
                    <div id="orders-chart-legend" class="orders-chart-legend"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fas fa-gift"></i>
                            Compras - Meses
                        </h4>
                        <canvas id="compras"></canvas>
                        <div id="orders-chart-legend" class="orders-chart-legend"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fas fa-chart-line"></i>
                            Ventas - Meses
                        </h4>
                        <canvas id="ventas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col -md-12 grid margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-envelope"> Productos más vendidos</i></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Codigo</th>
                                        <th>Nombre</th>
                                        <th>Codigo Producto</th>
                                        <th>Stock</th>
                                        <th>Cantidad Vendida</th>
                                        <th>Ver detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($productosvendidos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->name }}</td>
                                        <td>{{ $producto->code }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>{{ $producto->cantidad }}</td>
                                        <td>
                                            <a href="{{ route('product.show',$producto->id) }}" class="btn btn-primary btn-sm"> <i class="far fa-eye"></i> Ver Detalle</a>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/chart.js') !!}
    <script>
        $(document).ready(function(){
            let ventas = document.getElementById('ventas_diarias').getContext('2d');
            let charVentas = new Chart(ventas,{
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia)
                {
                    $dia = $ventadia->dia;
                    echo '"'. $dia.'",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasdia as $reg)
                        {echo ''. $reg->totaldia.',';} ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            let varVenta=document.getElementById('ventas').getContext('2d');
            let charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($ventamensual as $reg)
                {
                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                    $mes_traducido=strftime('%B',strtotime($reg->mes));

                    echo '"'. $mes_traducido.'",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventamensual as $reg)
                        {echo ''. $reg->totalmes.',';} ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            let varCompra=document.getElementById('compras').getContext('2d');
            let charCompra = new Chart(varCompra, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($compramensual as $reg)
                        {
                        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                        $mes_traducido=strftime('%B',strtotime($reg->mes));

                        echo '"'. $mes_traducido.'",';} ?>],
                        datasets: [{
                            label: 'Compras',
                            data: [<?php foreach ($compramensual as $reg)
                                {echo ''. $reg->totales.',';} ?>],

                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth:3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
