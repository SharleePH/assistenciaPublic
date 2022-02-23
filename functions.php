<?php
function getEmployeesWithAttendanceCount($start, $end)
{
    $query = "select employees.name, 
sum(case when status = 'presence' then 1 else 0 end) as presence_count,
sum(case when status = 'absence' then 1 else 0 end) as absence_count 
 from employee_attendance
 inner join employees on employees.id = employee_attendance.employee_id
 where date >= ? and date <= ?
 group by employee_id;";
    $db = getDatabase();
    $statement = $db->prepare($query);
    $statement->execute([$start, $end]);
    return $statement->fetchAll();
}

function saveAttendanceData($date, $employees)
{
    deleteAttendanceDataByDate($date);
    $db = getDatabase();
    $db->beginTransaction();
    $statement = $db->prepare("INSERT INTO employee_attendance(employee_id, date, status) VALUES (?, ?, ?)");
    foreach ($employees as $employee) {
        $statement->execute([$employee->id, $date, $employee->status]);
    }
    $db->commit();
    return true;
}

function deleteAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM employee_attendance WHERE date = ?");
    return $statement->execute([$date]);
}
function getAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT employee_id, status FROM employee_attendance WHERE date = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}


function deleteEmployee($id)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM employees WHERE id = ?");
    return $statement->execute([$id]);
}

function updateEmployee($name, $id)
{
    $db = getDatabase();
    $statement = $db->prepare("UPDATE employees SET name = ? WHERE id = ?");
    return $statement->execute([$name, $id]);
}
function getEmployeeById($id)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT id, name FROM employees WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetchObject();
}

function saveEmployee($name)
{
    $db = getDatabase();
    $statement = $db->prepare("INSERT INTO employees(name) VALUES (?)");
    return $statement->execute([$name]);
}

function getEmployees()
{
    $db = getDatabase();
    $statement = $db->query("SELECT id, name FROM employees WHERE activo=1 ORDER BY name");
    return $statement->fetchAll();
}

function existeRelacion($idEmpleado, $idCurso){
    $db = getDatabase();
    $statement = $db->query("SELECT count(*) as total
    FROM asistencia.relacioncursoempleado a
    WHERE a.idCurso=$idCurso AND idEmpleado=$idEmpleado");
    return $statement->fetchAll();
}

function eliminaRelacionEmpleados($idCurso){
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM relacioncursoempleado WHERE idCurso = ?");
    return $statement->execute([$idCurso]);
}

function insertaRelacion($idEmpleado, $idCurso){
    $db = getDatabase();
    $db->beginTransaction();
    $statement = $db->prepare("INSERT INTO relacioncursoempleado(idCurso, idEmpleado) 
    VALUES (?, ?)");    
    $statement->execute([$idCurso, $idEmpleado]);
    $db->commit();
    return true;
}

function obtenerCursosDeHoy($dia){
    $final = $dia." 23:59:59";
    /*echo "SELECT idCurso, nombreCurso FROM cursos WHERE fechaInicial>='$dia' AND fechaFinal<='$final'";
    die();*/
    $db = getDatabase();
    $statement = $db->prepare("SELECT idCurso, nombreCurso FROM cursos WHERE fechaInicial>=? AND fechaFinal<=?");
    $statement->execute([$dia, $final]);
    return $statement->fetchAll();
}

function obtenerCursosRangoDeFechas($diaInicial, $diaFinal){
    $final = $diaFinal." 23:59:59";
    $db = getDatabase();
    $statement = $db->prepare("SELECT idCurso, nombreCurso, fechaInicial FROM cursos WHERE fechaInicial>=? AND fechaFinal<=?");
    $statement->execute([$diaInicial, $final]);
    return $statement->fetchAll();
}

function getVarFromEnvironmentVariables($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("The environment file ($file) does not exists. Please create it");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("The specified key (" . $key . ") does not exist in the environment file");
    }
}

function getDatabase()
{
    $password = getVarFromEnvironmentVariables("MYSQL_PASSWORD");
    $user = getVarFromEnvironmentVariables("MYSQL_USER");
    $dbName = getVarFromEnvironmentVariables("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

function obtenerCursos()
{
    $db = getDatabase();
    $statement = $db->query("SELECT idCurso, nombreCurso, fechaInicial, fechaFinal FROM cursos");
    return $statement->fetchAll();
}

function obtenerCursosXID($id)
{
    $db = getDatabase();
    $statement = $db->query("SELECT idCurso, nombreCurso FROM cursos WHERE idCurso=$id");
    //$statement->execute([$id]);
    return $statement->fetchAll();
}

function obtenerProveedores()
{
    $db = getDatabase();
    $statement = $db->query("SELECT idProveedor, nombreProveedor FROM proveedores");
    return $statement->fetchAll();
}

function obtenerProveedoresXID($id)
{
    $db = getDatabase();
    $statement = $db->query("SELECT idProveedor, nombreProveedor FROM proveedores WHERE idProveedor=?");
    $statement->execute([$id]);
    return $statement->fetchAll();
}

function obtenerEmpleadosXID($id)
{
    $db = getDatabase();
    $statement = $db->query("SELECT id, name FROM employees WHERE id=$id");
    return $statement->fetchAll();
}

function obtenerRelacionCursoEmpleados($idCurso)
{
    $db = getDatabase();
    $statement = $db->query("SELECT *
    FROM asistencia.relacioncursoempleado a
    LEFT OUTER JOIN employees b ON b.id=a.idEmpleado
    LEFT OUTER JOIN cursos c ON a.idCurso=c.idCurso
    WHERE a.idCurso=$idCurso ORDER BY b.name");
    return $statement->fetchAll();
}

function saveCurso($name, $idProveedor, $inicio, $final, $descripcion, $idTipoCurso)
{
    $db = getDatabase();
    $db->beginTransaction();
    $statement = $db->prepare("INSERT INTO cursos(nombreCurso, idProveedor, fechaInicial, fechaFinal, descripcionCurso, idTipoCurso) 
    VALUES (?, ?, ?, ?, ?,?)");    
    $statement->execute([$name, $idProveedor, $inicio, $final, $descripcion, $idTipoCurso]);
    $db->commit();
    return true;
}

function obtenerTipos()
{
    $db = getDatabase();
    $statement = $db->query("SELECT idTipoCurso, nombreCurso FROM tipocurso");
    return $statement->fetchAll();
}
