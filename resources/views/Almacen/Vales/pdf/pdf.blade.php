<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Vale de salida</title>
    <style>
        @page {
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-left: 2cm;
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
                    <img src="assets/img/sedeco.png" alt="" width="420px">
                    <p>Departamento de Recursos Materiales y Servicios Generales</p>
                    <p>Departamento Solicitante:{{ $Vales->Departamento->nombre_departamento }}</p>
                    @if ($Vales->solicitante != null && $Vales->solicitante != null)
                        <p>Solicitante:{{ $Vales->Solicitante->nombre }} {{ $Vales->Solicitante->apellido_paterno }}
                            {{ $Vales->Solicitante->apellido_materno }}</p>
                            <p>{{ $Vales->Solicitante->Cargos->nombre_cargo }}</p>
                    @endif
                    @if ($Vales->departamento_id == 19)
                        <p>SEMANA DEL {{ $Vales->iniciosemana }} a {{ $Vales->finsemana }} </p>
                    @endif
                </td>
                <td style="width: 40%;">
                    <p>Salida de almacén</p>
                    <p>Material de oficina</p>
                    <p>Fecha de salida: {{ \Carbon\Carbon::parse($Vales->fechasalida)->format('d/m/Y') }}</p>
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
                    @foreach ($detallevales as $detallevale)
                        <tr>
                            <td>{{ $detallevale->Inventario->descripcion }}</td>
                            <td>{{ $detallevale->Inventario->Unidad->nombre_unidad }}</td>
                            <td>{{ $detallevale->salida }}</td>
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
                            <p>___________________________</p>
                            <p>Entrega</p>
                            <p>{{ optional($Vales->Entrega)->nombre?? 'Sin asignar' }}{{ optional($Vales->Entrega)->apellido_paterno?? 'Sin asignar' }}{{ optional($Vales->Entrega)->apellido_materno?? 'Sin asignar' }}</p>
                            <p>{{ optional($Vales->Entrega)->Cargos->nombre_cargo?? 'Sin asignar' }}</p>
                        </td>
                        <td>
                            <p>___________________________</p>
                            <p>C. Pedro Alberto Perez Sosa</p>
                            <p>Jefe del Depto. de Recursos Materiales y Servicios Generales</p>
                        </td>
                        <td>
                            <p>__________________________</p>
                            <p>Recibe</p>
                            @if ($Vales->solicitante != null && $Vales->solicitante != null)
                            <p>{{ $Vales->Solicitante->nombre }} {{ $Vales->Solicitante->apellido_paterno }}
                                {{ $Vales->Solicitante->apellido_materno }}</p>
                            <p>{{ $Vales->Solicitante->Cargos->nombre_cargo }}</p>
                            @endif
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>
