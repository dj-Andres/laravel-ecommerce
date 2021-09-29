@extends('layouts.reports.report')
@section('title')Reporte Venta @endsection
@section('styles')
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(../public/images/dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }
        .right{
            float: right;
        }
        .right span{
            color: #5D6975;
            /*text-align: right;
            /*font-size: 0.8em;*/
        }
        .center{
            text-align: center;
        }
        .center span{
            color: #5D6975;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }
        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
@endsection
@section('header')
    <header class="clearfix">
        <div id="logo">
            <img src="../public/admin/images/logo.png">
        </div>
        <div class="center">
            <h4>Datos de la Empresa</h4>
            <div><span>Empresa </span>Test</div>
            <div><span>N° Ruc </span>0707012605</div>
            <div><span>Dirección </span>Pasaje</div>
        </div>
        <div id="project">
            <h4>Datos del Cliente</h4>
            <div><span>Cliente</span>{{ $sale->client->name }}</div>
            <div><span>Dirección</span>{{ $sale->client->address }}</div>
            <div><span>Telefono</span>{{ $sale->client->phone }}</div>
            <div><span>EMAIL</span>{{ $sale->client->email }}</div>
        </div>
        <div class="right">
            <h4>Datos del Vendedor</h4>
            <div><span>Vendedor</span> {{ $sale->user->name }} </div>
            <div><span>Fecha Venta</span> {{ $sale->sale_date }} </div>
        </div>
    </header>
@endsection
@section('content')
    @include('layouts.reports.title_reporte',['reporte' => 'Ventas'])
    <table>
        <thead>
            <tr>
                <th style="border-bottom: 1px solid #C1CED9;">CANTIDAD</th>
                <th style="border-bottom: 1px solid #C1CED9;">PRODUCTO</th>
                <th style="border-bottom: 1px solid #C1CED9;">PRECIO VENTA $</th>
                <th style="border-bottom: 1px solid #C1CED9;">SUBTOTAL $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saleDetails as $saleDetail)
                <tr>
                    <td style="text-align: center;">{{ $saleDetail->cantidad }}</td>
                    <td style="text-align: center;">{{ $saleDetail->product->name }}</td>
                    <td style="text-align: center;">$ {{ $saleDetail->price }}</td>
                    <td style="text-align: center;">$ {{ number_format($saleDetail->cantidad*$saleDetail->price - $saleDetail->cantidad*$saleDetail->price*$saleDetail->descuento/100, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <p align="right" style="margin-left: -20px;">SUBTOTAL:</p>
                </td>
                <td class="total">
                    <p align="right" style="text-align: center;">$ {{ number_format($subtotal, 2) }}
                    <p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p align="right">TOTAL IMPUESTO ({{ $sale->impuesto }}%):</p>
                </td>
                <td class="total">
                    <p align="right" style="text-align: center;">$ {{ number_format($subtotal*$sale->impuesto/100, 2) }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="grand total">
                    <p align="right">TOTAL PAGAR:</p>
                </td>
                <td class="grand total">
                    <p align="right" style="text-align: center;">$ {{ number_format($sale->total,2) }}
                    <p>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
