<meta charset="UTF-8">
<script src="jquery.min.js"></script>
<script src="signature_pad.js"></script>
<script>
    document.getElementById('form').addEventListener("submit",function(e){

    var ctx = document.getElementById("canvas_1-1");
    var image = ctx.toDataURL(); // data:image/png....
    document.getElementById('base64').value = image;
    },false);
</script>
<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$curso                         = obtenerCursosXID($_GET['idCurso']);
$empleados                     = obtenerempleadosXID($_GET['idCurso']);
$empleadosRelacionadosXIdCurso = obtenerRelacionCursoEmpleados($_GET['idCurso']);
$empleados                     = getEmployees();
?>

<div class="row">
    <div class="col-12">
        <h3 class="text-center"><?PHP echo "Lista de asistencia del curso ".$curso[0]->nombreCurso."" ?></h3>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="tabla" class="table table-sm stripe display compact order-column">
                <thead>
                    <tr>
                        <th class='col-lg-1'>Id</th>
                        <th class='col-lg-9'>Empleado</th>
                        <th class='col-lg-2'>Firma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i=0;
                        foreach ($empleadosRelacionadosXIdCurso as $empleado) {
                            if($i>=0){
                            echo "<tr>";
                                echo "<td>".$empleado->idEmpleado."</td>";
                                echo "<td>".$empleado->name."</td>";
                                echo "<td>";
                                ?>
                                <!--<div id="<?PHP echo "signature-pad_".$i;?>" class="signature-pad" >
                                    <div id="signature-pad" class="signature-pad" >
                                        <div class="signature-pad--body">
                                            <canvas style="width: 100%; height: 100px; border: 1px black solid; " id="<?php echo "canvas_".$empleado->idEmpleado."-".$empleado->idCurso;?>"></canvas>
                                        </div>
                                    </div>
                                </div>-->
                                <?PHP
                                $path = "firmas/".$empleado->idCurso."/".$empleado->idEmpleado."/";
                                if (!file_exists($path)) {
                                    ?>
                                    <center>
                                      <input class='btn btn-sm btn-success' type='button' name='firma' id='firma' value='Firmar' onclick="javascript:firmar('<?PHP echo $empleado->idEmpleado; ?>','<?PHP echo $empleado->idCurso;?>')">
                                    </center>
                                    <?PHP
                                }else{
                                  ?>                             
                                  <?PHP
                                  echo "<img src='./firmas/".$empleado->idCurso."/".$empleado->idEmpleado."/sign.png' width='200px'>";
                                }
                                ?>
                                
                                <?PHP
                                echo "</td>";
                            echo "</tr>";
                            $i++;
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>   
<?php
include_once "footer.php";
?>
<script type="text/javascript">
var cantidad = '<?PHP echo $i;?>'

function limpiaCanvas(idEmpleado, idCurso, i){
    var canvas = document.getElementById("canvas_"+idEmpleado+"-"+idCurso);
    var ctx = canvas.getContext("2d");
    // Borramos el área que nos interese
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

for(j=0; j<=cantidad; j++){
    var wrapper = document.getElementById("signature-pad_"+j);
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
}

function resizeCanvas() {

  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();

function firmar(idEmpleado, idCurso){
  window.location="pantallaFirma.php?idEmpleado="+idEmpleado+"&idCurso="+idCurso;
}
</script>