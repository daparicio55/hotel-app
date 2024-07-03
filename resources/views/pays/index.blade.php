@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1>Control de Pagos</h1>
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
                    <th>Habitaciones</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $key => $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ date('d-m-Y',strtotime($reservation->date)) }}</td>
                        <td>{{ $reservation->client->name }}</td>
                        <td>
                            <ol>
                                @foreach ($reservation->rooms as $room)
                                    <li>
                                        Habitacion: {{ $room->number }} 
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{{ date('d-m-Y',strtotime($reservation->start)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($reservation->end)) }}</td>
                        <td>
                            <a href="{{ route('reservations.show',$reservation->id) }}" class="btn btn-warning" title="Imprimir Reservación">
                                <i class="fas fa-print"></i>
                            </a>
                            {!! Form::open(['route'=>['reservations.destroy',$reservation->id],'method'=>'delete','class'=>'d-inline']) !!}
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

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop