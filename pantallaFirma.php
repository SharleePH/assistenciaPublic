<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance system with PHP - By Parzibyte</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="jquery.min.js"></script>
    <script src="signature_pad.js"></script>
    <script src="pantallaFirma.js"></script>
    <style>
        body {
            padding-top: 80px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-info fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" id="botonMenu" aria-label="Mostrar u ocultar menú">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="employees.php">Empleados <i class="fa fa-users"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cursos.php">Cursos <i class="fa fa-users"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cursoEmpleados.php">Empleado - Cursos <i class="fa fa-users"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attendance_register.php">Registro de asistencia <i class="fa fa-check-double"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attendance_report.php">Reporte de asistencia <i class="fa fa-file-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>
<main class="container-fluid">

    <!-- Contenedor y Elemento Canvas -->
    <div id="signature-pad" class="row signature-pad" >
        <div class="col-12 description text-center">Firma</div>
        <div class="offset-2  col-lg-8 signature-pad--body">
            <center>
                <canvas style="width: 400px; height: 150px; border: 1px black solid; " id="canvas"></canvas>
            </center>
        </div>
    </div>

    <!-- Formulario que recoge los datos y los enviara al servidor -->
    <form id="form" action="./guardaFirma.php" method="post">
        <input type="hidden" name="base64" value="" id="base64">
        <input type="hidden" name="idEmpleado" id="idEmpleado" value="<?PHP echo $_GET['idEmpleado'];?>">
        <input type="hidden" name="idCurso" id="idCurso" value="<?PHP echo $_GET['idCurso'];?>">
        <center>
            <button id="saveandfinish" class="btn btn-lg btn-success">Guardar</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='button' id="saveandfinish" class="btn btn-lg btn-info" onclick="javascript:limpiaCanvas();" value='Limpiar'>
        </center>
    </form>



    <script type="text/javascript">

        var wrapper = document.getElementById("signature-pad");

        var canvas = wrapper.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
        });

        function resizeCanvas() {

        var ratio =  Math.max(window.devicePixelRatio || 1, 1);

        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

        signaturePad.clear();
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        </script>
        <script>

        document.getElementById('form').addEventListener("submit",function(e){

            var ctx = document.getElementById("canvas");
            var image = ctx.toDataURL(); // data:image/png....
            document.getElementById('base64').value = image;
        },false);

        function limpiaCanvas(){
            var canvas = document.getElementById("canvas");
            var ctx = canvas.getContext("2d");
            // Borramos el área que nos interese
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    </script>
  </body>
</html>

