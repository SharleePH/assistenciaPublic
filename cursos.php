<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$cursos = obtenerCursos();
?>
<div class="row">
    <div class="offset-2 col-8">
        <h3 class="text-center">Cursos</h3>
    </div>    
    <div class="col-2">
        <a href="curso_add.php" class="btn btn-sm btn-success mb-2">Agregar Curso <i class="fa fa-plus"></i></a>
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
                        <th class='col-lg-1'>Edici&oacute;n</th>
                        <th class='col-lg-1'>Eliminar</th>
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
                                <a class="btn btn-sm btn-warning" href="curso_edit.php?id=<?php echo $curso->idCurso ?>">
                                Editar <i class="fa fa-edit"></i>
                            </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="curso_delete.php?id=<?php echo $curso->idCurso ?>">
                                Borrar <i class="fa fa-trash"></i>
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
