@extends('adminlte::page')

@section('title', 'Registrar Reservación')

@section('content_header')
    <h1>Registro de Reservación</h1>
    <a href="{{ route('reservations.index') }}" class="btn btn-danger mt-2"><i class="fas fa-backward"></i> Regresar</a>
@stop
@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::open(['route'=>'reservations.store','method'=>'post']) !!}
    <x-card-info title="Datos de usuario">
        <x-slot name="body">
            <input type="hidden" name="id" id="id" value="0">
            <input type="text" class="form-control" name="dni" id="dni" required placeholder="ingrese numero de DNI">
            <button type="button" id="btn_search_dni" class="btn btn-primary btn-sm d-block mt-1"><i class="fas fa-search-plus"></i></button>
            <label for="name" class="mt-1">Nombre y Apellidos</label>
            <input readonly type="text" name="name" id="name" class="form-control" required placeholder="ingrese nombres y apellidos">
            <label for="email" class="mt-1">Correo</label>
            <input readonly type="mail" name="email" id="email" class="form-control" required placeholder="ingrese correo electrónico">
            <label for="phone" class="mt-1">Teléfono</label>
            <input readonly type="phone" name="phone" id="phone" class="form-control" required placeholder="ingrese numero telefónico">
        </x-slot>
        <x-slot name="footer">
            <small class="text-muted">Busque el cliente con su numero de DNI, de lo contratrio debera de ingresarlo manualmente</small>
        </x-slot>
    </x-card-info>
    <x-card-info title="Datos de la reservación">
        <x-slot name="body">
            <label for="date" class="mt-1">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" required>
            <label for="days">Número de días</label>
            <input type="number" name="days" id="days" value="1" min="1" class="form-control" required>
            <button type="button" id="btn_check_rooms" class="btn btn-primary d-block mt-2 btn-sm"><i class="fas fa-search"></i> Mostrar habitaciones disponibles</button>
            <label for="people" class="mt-1">Número de personas</label>
            <input type="number" name="people" id="people" class="form-control" required>
            <label class="mt-2">Habitaciones Disponibles</label>
            <select id="rooms" class="form-control">
            </select>
            <button type="button" id="btn_add_room" class="btn btn-info btn-sm mt-2">
                <i class="fas fa-plus"></i> Agregar habitación
            </button>
        </x-slot>
        <x-slot name="footer">
            <span class="text-muted">Seleccione la fecha de inicio y la cantidad de dias que estará hospedado para ver los cuartos disponibles</span>
        </x-slot>
    </x-card-info>
    <x-card-info title="Habitaciones Reservadas">
        <x-slot name="body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th style="width: 100px">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_rooms">

                </tbody>
            </table>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Reservación
            </button>
        </x-slot>
    </x-card-info>
{!! Form::close() !!}
@stop

@section('js')
    <script src="{{ asset('assets/js/reservations.js') }}"></script>
@stop