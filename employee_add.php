<?php
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center">Agregar Empleado</h3>
    </div>
    <div class="offset-2 col-lg-8" style="border:solid 1px; box-shadow: 10px 5px 5px black;">
        <form action="employee_save.php" method="POST">
            </br>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Nombre
                </div>
                <div class='col-lg-8 bg-primary'>
                    <input name="name" placeholder="Name" type="text" id="name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                </br>
                <button class="btn btn-success">
                    Save <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
