@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1>Control de Pagos</h1>
    <a href="">
        <a class="btn btn-success mt-2" href="{{ route('pays.create') }}">
            <i class="fas fa-plus-square"></i> Nuevo Pago
        </a>
    </a>
@stop
@section('content')
<x-alert_index/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Numero</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pays as $key => $pay)
                    <tr>
                        <td>{{ $pay->id }}</td>
                        <td>{{ date('d-m-Y',strtotime($pay->date)) }}</td>
                        <td>{{ $pay->reservation->client->name }}</td>
                        <td>{{ $pay->type }}</td>
                        <td>{{ $pay->number }}</td>
                        <td>
                            <a href="{{ route('pays.show',$pay->id) }}" class="btn btn-warning" title="Imprimir Boleta">
                                <i class="fas fa-print"></i>
                            </a>
                            {!! Form::open(['route'=>['pays.destroy',$pay->id],'method'=>'delete','class'=>'d-inline']) !!}
                                <button type="submit" class="btn btn-danger" title="Eliminar Reserva">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop