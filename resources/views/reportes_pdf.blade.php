<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Temas</title>
    <style>
        @page {
            size: Letter;
            margin: 0mm 10mm 3mm 10mm;
        }
        body {
            font-family: Arial, sans-serif;
        }
        h1{
            text-align: center;
            margin: 10px 0 25px 0;
        }
        .logo {
            height: 100px;
        }
        .logo-container {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .datos-table {
            width: 100%;
            margin-bottom: 20px;
            border: none;
        }
        .datos-table td {
            width: 50%;
            /* text-align: left; */
            border: none;
            padding: 0;
        }
        .datos-table .fecha {
            text-align: right;
        }  
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .main-table, .main-table th, .main-table td {
            border: 1px solid black;
        }
        .footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    
    <div class="logo-container">
        <img class="logo" src="images/page/logo_pdf.png" alt="Logo USFX">
    </div>
    <h1>Reportes de Temas</h1>

    
    <table class="datos-table">
        <tr>
            <td><strong>Asesor: </strong>{{ $asesor->name }}</td>
            <td class="fecha"><strong>Fecha Impresión: </strong>{{ $fecha }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Estudiante</th>
                <th>Estado</th>
                <th>Modalidad</th>
                <th>Tutor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temas as $tema)
                <tr>
                    <td>{{ $tema->titulo }}</td>
                    <td>{{ $tema->estudiante }}</td>
                    <td>{{ $tema->estado }}</td>
                    <td>{{ $tema->tipo }}</td>
                    <td>{{ $tema->tutor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>©2024 USFX - Sistema de Gestión de Temas de Grado</p>
    </div>
</body>
</html>
