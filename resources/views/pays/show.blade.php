<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .t-detalles{
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #000;
        }
        .t-detalles th, .t-detalles td{
            border: 1px solid #000;
            padding: 5px;
        }        
    </style>
</head>
<body>
    <div>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td style="width: 30%">
                        <img src="./assets/img/logo.jpeg" alt="logo.png" style="width: 80%">
                    </td>
                    <td style="width: 30%; text-align: center">
                        <h3>HOTELES CALIFORNIA</h3>
                        <p>Jr. Amazonas #587 - Chachapoyas - Chachapoyas - Amazonas</p>
                        <p>Telf. 965214785 - 014-5236872</p>
                    </td>
                    <td style="width: 60%; text-align: center">
                        <h3>RUC: 12345678911</h3>
                        <h3>{{ Str::upper($pay->type) }} DE VENTA</h3>
                        <h4>001 - N° {{ $pay->number }}</h4>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <header>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td style="width: 60%">
                        Nombre: {{ $pay->reservation->client->name }}
                    </td>
                    <td style="width: 30%">
                        DNI: {{ $pay->reservation->client->dni }}
                    </td>
                    <td style="width: 30%">
                        <p>Fecha</p>
                        <p>{{ date('d-m-Y',strtotime($pay->date)) }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>
    <main>
        <table class="t-detalles">
            <thead>
                <tr>
                    <th style="width: 50px">Cant</th>
                    <th>Descripcion</th>
                    <th>P. Unit</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pay->reservation->rooms as $rom)
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Habitacion {{ $rom->number }}</td>
                        <td style="text-align: right; padding-right: 10px">{{ $rom->price }}</td>
                        <td style="text-align: right; padding-right: 10px">{{ $rom->price }}</td>
                    </tr>
                    
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right">
                        <h3>TOTAL</h3>
                    </td>
                    <td style="text-align: right; padding-right: 10px">
                        <h3>S/ {{ $pay->reservation->rooms->sum('price') }}</h3>
                    </td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>
</html>