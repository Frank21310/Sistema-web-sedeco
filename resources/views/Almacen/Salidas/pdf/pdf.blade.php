<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Entrada</title>
    <style>
        @page {
            margin-top: 1.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2.5cm;
            margin-right: 2.5cm;
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            src: url('/assets/ttf/Montserrat-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            src: url('/assets/ttf/Montserrat-Bold.ttf') format('truetype');
        }

        header {
            position: relative;
            height: 150px;
            width: 100%;
        }

        main {
            margin-top: 1cm;
        }


        p {
            font-family: 'Montserrat';
            font-weight: bold;
            font-size: 15px;
            margin: 2;
            color: rgb(0, 0, 0);

        }

        .full-width-table {
            width: 100%;
            border-collapse: collapse;

        }

        .full-width-table th,
        .full-width-table td {

            border: 1px solid black;
            padding: 2px;
            text-align: left;

        }

        .full-width-table th:first-child {
            width: 70%;
        }

        .full-width-table th:nth-child(2),
        .full-width-table td:nth-child(2) {
            width: 20%;
            text-align: center;

        }
        .full-width-table th:nth-child(3),
        .full-width-table td:nth-child(3) {
            width: 10%;
            text-align: center;

        }

        .full {
            width: 100%;
            border-collapse: collapse;
        }

        .Firmas {
            border-collapse: collapse;
            width: 100%;
            margin-top: 2cm;

        }

        .Firmas td {
            border: none;
            padding: 10px;
            margin: 0;
            text-align: center;
        }

        .Firmas p {
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td style="width: 60%;">
                    <img src="assets/img/sedeco.png" alt="" width="400px">
                    <p>Departamento de Recursos Materiales y Servicios Generales</p>
                    <p>Solicitante:{{ $Entrada->Departamento->nombre_departamento }}</p>
                    
                    
                </td>
                <td style="width: 40%;">
                    <p>Salida del Almacen</p>
                    <p>Factura:{{ $Entrada->factura }}</p>
                    <p>Folio de la factura:{{ $Entrada->folio }}</p>
                    <p>Fecha de salida del almacén: {{ \Carbon\Carbon::parse($Salida->fechasalida)->format('d/m/Y') }}</p>
                    <p>Fecha de factura:  {{ \Carbon\Carbon::parse($Entrada->fechafactura)->format('d/m/Y') }}</p>
                    

                </td>
            </tr>
        </table>
    </header>
    <main>
        <div>
            <table class="full-width-table">
                <thead>
                    <tr>
                        <th style="text-align: center;">Descripción</th>
                        <th>Unidad de medida</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->descripcion }}</td>
                            <td>{{ $articulo->Unidad->nombre_unidad }}</td>
                            <td>{{ $articulo->cantidad }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            <table class="Firmas">
                <tbody>
                    <tr>
                        <td>
                            <p>_______________________________</p>
                            <p>{{ $Entrada->Empleado->nombre }} {{ $Entrada->Empleado->apellido_paterno }}
                                {{ $Entrada->Empleado->apellido_materno }}</p>
                            <p>{{ $Entrada->Empleado->Cargos->nombre_cargo }}</p>
                        </td>
                        <td>
                            <p>_______________________________</p>
                            <p>C. Pedro Alberto Perez Sosa</p>
                            <p>Jefe del Depto. de Recursos Materiales y Servicios Generales</p>
                        </td>
                        <td>
                            <p>_______________________________</p>
                            <p>Recibe</p>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>
