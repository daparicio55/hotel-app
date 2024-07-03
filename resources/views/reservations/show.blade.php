<!DOCTYPE html>
<html>
<head>
    <title>Reservación de Hotel</title>
    <style>
        @page {
            size: A4;
            margin: 2;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .hotel-info {
            margin-bottom: 20px;
        }

        .hotel-info img {
            max-width: 200px;
            height: auto;
        }

        .reservation-details {
            margin-bottom: 20px;
        }

        .room-list {
            margin-bottom: 20px;
        }

        .room-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .room-list th, .room-list td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reservación de Hotel</h1>
    </div>

    <div class="hotel-info">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
            <!-- Background shape -->
            <rect width="200" height="200" fill="#F0F0F0" />
            
            <!-- Tree icon -->
            <path fill="#6CB74E" d="M100,30c-16.569,0-30,13.431-30,30c0,14.271,13.074,35.679,23.211,55.295  c0.937,1.89,2.804,2.863,4.696,1.926c1.89-0.937,2.863-2.804,1.926-4.696C94.924,92.662,90,73.82,90,60  c0-11.046,8.954-20,20-20c11.046,0,20,8.954,20,20c0,13.82-4.924,32.662-8.832,48.525c-0.937,1.89-0.064,3.759,1.826,4.696  c1.89,0.937,3.759,0.064,4.696-1.826C116.926,125.679,130,104.271,130,90c0-16.569-13.431-30-30-30z" />
            
            <!-- Text -->
            <text x="100" y="150" font-family="Arial, sans-serif" font-size="20" text-anchor="middle" fill="#333333">Hotel</text>
          </svg>
        <h2>HOTEL EL BUEN SUEÑO</h2>
        <p>RUC: 123456789</p>
    </div>

    <div class="reservation-details">
        <h2>Detalles de la Reservación</h2>
        <p>Realizado por: {{ $reservation->client->name }}</p>
        <p>Fecha de Inicio: {{ date('d-m-Y',strtotime($reservation->start)) }}</p>
        <p>Fecha de Fin: {{ date('d-m-Y',strtotime($reservation->end)) }}</p>
    </div>

    <div class="room-list">
        <h2>Habitaciones Reservadas</h2>
        <table>
            <thead>
                <tr>
                    <th>HABITACIÓN</th>
                    <th>CAPACIDAD</th>
                    <th>PRECIO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservation->rooms as $room)
                    <tr>
                        <td style="text-align: center">{{ $room->number }}</td>
                        <td style="text-align: center">{{ $room->capacity }}</td>
                        <td style="text-align: center">{{ $room->price }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right"><h4>TOTAL</h4></td>
                    <td style="text-align: center"><h4>S/. {{ $reservation->rooms->sum('price') }}</h4></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>