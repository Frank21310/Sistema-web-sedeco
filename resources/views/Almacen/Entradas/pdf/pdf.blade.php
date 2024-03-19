<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Entrada</title>
    <style>
        /* Estilos para el encabezado */
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .header h1 {
            margin: 0;
            padding: 10px 0;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px;
            /* Tamaño de la imagen */
            height: auto;
        }

        .header .info {
            position: absolute;
            right: 0;
            top: 0;
        }

        /* Estilos para el cuerpo */
        .body {
            margin: 0 20px;
        }

        .body table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .body table,
        .body table th,
        .body table td {
            border: 1px solid black;
        }

        .body th,
        .body td {
            padding: 8px;
            text-align: left;
        }

        /* Estilos para las firmas */
        .firmas {
            margin-top: 20px;
        }

        .firmas table {
            width: 100%;
            border-collapse: collapse;
        }

        .firmas td {
            border: none;
            padding: 5px;
            text-align: center;
            position: relative;
        }

        .firmas .linea {
            border-top: 1px solid black;
            width: 33%;
            /* Divide en tres partes iguales */
        }

        .firmas .texto {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Estilos para el pie de página */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="header">
        <img src="assets/img/sedeco.png" alt="Logo">
        <div class="info">
            <p>Información adicional del encabezado</p>
            <p>Otra información del encabezado si es necesario</p>
        </div>
    </div>

    <!-- Cuerpo -->
    <div class="body">
        <h2>Datos de la Entrada</h2>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Descripción 1</td>
                    <td>Unidad 1</td>
                    <td>Cantidad 1</td>
                </tr>
                <tr>
                    <td>Descripción 2</td>
                    <td>Unidad 2</td>
                    <td>Cantidad 2</td>
                </tr>
                <!-- Agrega más filas según sea necesario -->
            </tbody>
        </table>

        <!-- Firmas -->
        <div class="firmas">
            <table>
                <tr>
                    <td class="linea"></td>
                    <td></td>
                    <td class="linea"></td>
                    <td></td>
                    <td class="linea"></td>
                </tr>
                <tr>
                    <td class="texto">Entrega</td>
                    <td></td>
                    <td class="texto">Jefe</td>
                    <td></td>
                    <td class="texto">Recibe</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
