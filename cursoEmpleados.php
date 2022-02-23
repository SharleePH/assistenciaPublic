<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$cursos = obtenerCursos();
?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center">Relaci&oacute;n (Curso - Empleados)</h3>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="tabla" class="table table-sm stripe display compact">
                <thead>
                    <tr>
                        <th class='col-lg-1'>Id</th>
                        <th class='col-lg-5'>Nombre</th>
                        <th class='col-lg-2'>Inicia</th>
                        <th class='col-lg-2'>Termina</th>
                        <th class='col-lg-2'><center>Acciones</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso) { ?>
                        <tr>
                            <td>
                                <?php echo $curso->idCurso ?>
                            </td>
                            <td>
                                <?php echo $curso->nombreCurso ?>
                            </td>
                            <td>
                                <?php echo $curso->fechaInicial ?>
                            </td>
                            <td>
                                <?php echo $curso->fechaFinal ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="relacionarEmpleados.php?id=<?php echo $curso->idCurso ?>">
                                    Empleados <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-warning" href="curso_edit.php?id=<?php echo $curso->idCurso ?>">
                                    Edit <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="curso_delete.php?id=<?php echo $curso->idCurso ?>">
                                Delete <i class="fa fa-trash"></i>
                            </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#tabla').DataTable({
        "paging": true // false to disable pagination (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
</script>
<?php
include_once "footer.php";
