@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Reporte Rango de Fecha
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte Rango de Fecha</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Información de la Reporte Rango de Fecha</h4>
                        </div>
                        <div class="row">
                            {!! Form::open(['route'=>'report.report_results','method'=>'POST']) !!}
                                <div class="col-12 col-md-3 text-center">
                                    <span>Fecha inicial</span>
                                    <div class="form-group">
                                        <input class="form-control" type="date" value="{{old('fecha_ini')}}" name="fecha_ini" id="fecha_ini">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <span>Fecha final</span>
                                    <div class="form-group">
                                        <input class="form-control" type="date" value="{{old('fecha_fin')}}" name="fecha_fin" id="fecha_fin">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 text-center mt-4">
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary btn-sm">Consultar</button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 text-center">
                                    <span>Total de ingresos: <b> </b></span>
                                    <div class="form-group">
                                        <strong>$ {{$total}}</strong>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="orden-listing">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th style="width:50px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><a href="{{route('sales.show', $sale)}}">{{$sale->id}}</a></th>
                                        <td>{{\Carbon\Carbon::parse($sale->sale_date)->format('d M y h:i a')}}</td>
                                        <td>{{$sale->total}}</td>
                                        <td>{{$sale->status}}</td>
                                        <td style="width: 50px;">
                                            <a href="{{route('sales.pdf', $sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-file-pdf"></i></a>
                                            <a href="{{route('sales.print', $sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-print"></i></a>
                                            <a href="{{route('sales.show', $sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-eye"></i></a>
                                        </td>
                                    </tr>
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
{!! Html::script('admin/js/data-table.js') !!}
<script>
    window.onload = function(){
        const fecha = new Date();
        const mount = fecha.getMonth()+1;
        const day = fecha.getDate();
        const year = fecha.getFullYear();

        if(day<10)
          day='0'+day;
        if(mount<10)
          mount='0'+mount;

        document.getElementById('fecha_fin').value=year+"-"+mount"-"+day;
    }
</script>
@endsection

