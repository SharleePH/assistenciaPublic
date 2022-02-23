<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$empleados = obtenerempleadosXID($_GET['id']);
$empleadosRelacionados = obtenerRelacionCursoEmpleados($empleados[0]->id);
$empleados = getEmployees();
$cursos = obtenerCursosXID($_GET['id']);
?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center"><?PHP echo "Agregar Empleados al curso de ".$cursos[0]->nombreCurso."" ?></h3>
    </div>
    <form class="col-12" action="relacionEmpleado_save.php" method="POST">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tabla" class="table table-sm table-striped table-hover display compact order-column">
                    <thead>
                        <tr>
                            <th class='col-lg-1'>Id</th>
                            <th class='col-lg-8'>Empleado</th>
                            <th><center>Acciones</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleado) { 
                            $value=$empleado->id."-".$_GET['id'];
                            $existe=0;
                            foreach ($empleadosRelacionados as $empleadoRelacionado) {
                                if($empleado->id==$empleadoRelacionado->idEmpleado){
                                    $existe=1;
                                }
                                ?>                                
                            <?php 
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php echo $empleado->id ?>
                                </td>
                                <td>
                                    <?php echo $empleado->name ?>
                                </td>
                                <td>
                                    <?php
                                    if($existe==1){
                                        ?>
                                        <center>
                                            <input type='checkbox' class='form-check-input' id="<?PHP echo $value;?>" name="<?PHP echo $value;?>" checked>
                                        </center>
                                        <?php
                                    }else{
                                        ?>
                                        <center>
                                            <input type='checkbox' class='form-check-input' id="<?PHP echo $value;?>" name="<?PHP echo $value;?>">
                                        </center>
                                        <?PHP
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?PHP
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success">
                Save <i class="fa fa-check"></i>
            </button>
        </div>
    </form>
</div>
<!--<script>
    $('#tabla').DataTable({
        "paging": true, // false to disable pagination (or any other option)
        "order": [[ 2, "asc" ]]
    });
    $('.dataTables_length').addClass('bs-select');
</script>-->
<?php
include_once "footer.php";
