<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Entrada</title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin-top: 1.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2.5cm;
            margin-right: 2.5cm;
        }

        header {
            position: relative;
            height: 150px;
            /* Adjust the height according to your header content */
            width: 100%;
            /* Make sure the header spans the whole width */
        }

        main {
            margin-top: 1cm;
            /* Adjust this margin to your liking */
        }


        p {
            font-family: 'Montserrat', sans-serif;
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
            width: 60%;
        }

        .full-width-table th:nth-child(2),
        .full-width-table td:nth-child(2),
        .full-width-table th:nth-child(3),
        .full-width-table td:nth-child(3) {
            width: 20%;
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
            /* Espacio entre celdas */
            margin: 0;
            text-align: center;
            /* Centrar texto */
        }

        .Firmas p {
            text-align: center;
            margin: 0;
            /* Eliminar márgenes */
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <header>
        <table>
            <tr>
                <td>
                    <img src="assets/img/sedeco.png" alt="" width="480px">
                    <p>Departamento de Recursos Materiales y Servicios Generales</p>
                    <p>Solicitante:{{ $Entrada->Departamento->nombre_departamento }}</p>
                    <p>Proveedor:{{ $Entrada->Proveedor->nombre }}</p>
                </td>
                <td>
                    <p>Entrada del Almacen</p>
                    <p>Factura:{{ $Entrada->factura }}</p>
                    <p>Folio de la factura:{{ $Entrada->folio }}</p>
                    <p>Fecha de entrada al almacén:{{ $Entrada->fechaentrada }}</p>
                    <p>Fecha de factura: {{ $Entrada->fechafactura }}</p>
                    <p>RFC: {{ $Entrada->Proveedor->rfc }}</p>

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
                            <p>Entrega</p>
                            <p>{{ $Entrada->Proveedor->nombre }}</p>
                        </td>
                        <td>
                            <p>_______________________________</p>
                            <p>C. Pedro Alberto Perez Sosa</p>
                            <p>Jefe del Depto. de Recursos Materiales y Servicios Generales</p>
                        </td>
                        <td>
                            <p>_______________________________</p>
                            <p>Recibe</p>
                            <p>{{ $Entrada->Empleado->nombre }} {{ $Entrada->Empleado->apellido_paterno }}
                                {{ $Entrada->Empleado->apellido_materno }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>
