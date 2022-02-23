<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$employees = getEmployees();
?>
<div class="row">
    <div class="offset-2 col-8">
        <h3 class="text-center">Asistentes</h3>
    </div>
    <div class="col-2">
        <a href="employee_add.php" class="btn btn-sm btn-success mb-2">Agregar Empleado <i class="fa fa-plus"></i></a>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="tabla" class="table table-sm stripe display compact">
                <thead>
                    <tr>
                        <th class='col-lg-1'>Id</th>
                        <th class='col-lg-9'>Name</th>
                        <th class='col-lg-1'>Edit</th>
                        <th class='col-lg-1'>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td>
                                <?php echo $employee->id ?>
                            </td>
                            <td>
                                <?php echo $employee->name ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="employee_edit.php?id=<?php echo $employee->id ?>">
                                Editar <i class="fa fa-edit"></i>
                            </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="employee_delete.php?id=<?php echo $employee->id ?>">
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
        "paging": true, // false to disable pagination (or any other option)
        "order": [[ 2, "asc" ]]
    });
    $('.dataTables_length').addClass('bs-select');
</script>
<?php
include_once "footer.php";
