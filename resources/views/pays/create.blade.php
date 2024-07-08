@extends('adminlte::page')

@section('title', 'Nuevo Registro de Pago')

@section('content_header')
    <h1>Registrar Pago</h1>
    <a class="btn btn-danger mt-2" href="{{ route('pays.index') }}">
        <i class="fas fa-backward"></i> Listado de Pagos
    </a>
@stop

@section('content')
{!! Form::open(['route'=>'pays.store','method'=>'post']) !!}
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <label for="reservation">Seleccione Reservacion a pagar</label>
            <select name="reservation" class="form-control">
                @foreach ($reservations as $reservation)
                    <option value="{{ $reservation->id }}">Cliente: {{ $reservation->client->name }} Total: {{ $reservation->rooms->sum('price') }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-6">
            <label for="type">Tipo de Comprobante</label>
            <select name="type" class="form-control">
                <option value="Boleta">Boleta</option>
                <option value="Factura">Factura</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-6">
            <label for="pago" class="mt-2">Tipo de Pago</label>
            <select name="pago" class="form-control">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Yape">Yape</option>
                <option value="Plin">Plin</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-6">
            <label for="date" class="mt-2">Fecha de Pago</label>
            <input type="date" name="date" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-info mt-3">
                <i class="fas fa-save"></i> Guardar Pago
            </button>
        </div>
    </div>
{!! Form::close() !!}
@stop