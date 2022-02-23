<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$proveedores = obtenerProveedores();
$tipos = obtenerTipos();
?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center">Agregar Curso</h3>
    </div>
    <div class="offset-2 col-lg-8" style="border:solid 1px; box-shadow: 10px 5px 5px black;">
        <form action="curso_save.php" method="POST">
            </br>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Nombre del curso
                </div>                
                <div class='col-lg-8 bg-primary'>
                    <input name="name" placeholder="Nombre del curso" type="text" id="name" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Tipo Curso
                </div>
                <div class='col-lg-8 bg-primary'>
                    <select name='idTipoCurso' id='idTipoCurso' class='form-control'>
                        <?php
                        echo "<option selected value=''>Seleccione el tipo</option>";
                        $i=0;
                        foreach($tipos as $tipo){
                            echo "<option value='".$tipo->idTipoCurso."'>".$tipo->nombreCurso."</option>";
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Proveedor
                </div>
                <div class='col-lg-8 bg-primary'>
                    <select name='idProveedor' id='idProveedor' class='form-control'>
                        <?php
                        echo "<option selected value=''>Seleccione un proveedor</option>";
                        $i=0;
                        foreach($proveedores as $proveedor){
                            echo "<option value='".$proveedor->idProveedor."'>".$proveedor->nombreProveedor."</option>";
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Hora de inicio
                </div>
                <div class='col-lg-8 bg-primary'>
                    <input type="datetime-local" id='inicio' name='inicio' class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Hora de fin
                </div>
                <div class='col-lg-8 bg-primary'>
                    <input type="datetime-local" id='final' name='final' class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class='col-lg-4 bg-primary text-white'>
                    Descripci&oacute;n del curso
                </div>
                <div class='col-lg-8 bg-primary'>
                    <textarea cols='40' rows='3' name='descripcion' id='descripcion'></textarea>
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
</br></br></br>
<?php
include_once "footer.php";
