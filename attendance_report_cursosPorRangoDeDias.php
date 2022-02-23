<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";

$cursos = obtenerCursosRangoDeFechas($_GET['start'], $_GET['end']);
?>
<div class="row" id="app">
    <div class="col-12">
        <h3 class="text-center">Cursos del d&iacute;a</h3>
    </div>
    <div class="col-12">
        <div class="form-inline mb-2">
            <label for="date">Date: &nbsp;</label>
            <input disabled @change="refreshEmployeesList" v-model="date" name="date" id="date" type="date" class="form-control">
            <!--<button @click="save" class="btn btn-success ml-2">Save</button>-->
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class='col-lg-1'>Id</th>
                        <th class='col-lg-8'>Nombre Curso</th>
                        <th class='col-lg-2'>Fecha</th>
                        <th class='col-lg-1'>Reporte</th>
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
                                <a class="btn btn-sm btn-success" href="ReporteListaAsistenciaXIdCurso.php?idCurso=<?php echo $curso->idCurso ?>">
                                    Reporte <i class="fa fa-file"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="js/vue.min.js"></script>
<script src="js/vue-toasted.min.js"></script>
<script>
    Vue.use(Toasted);
    const UNSET_STATUS = "unset";
    new Vue({
        el: "#app",
        data: () => ({
            employees: [],
            date: "",
        }),
        async mounted() {
            this.date = this.getTodaysDate();
            await this.refreshEmployeesList();
        },
        methods: {
            getTodaysDate() {
                const date = new Date();
                const month = date.getMonth() + 1;
                const day = date.getDate();
                return `${date.getFullYear()}-${(month < 10 ? '0' : '').concat(month)}-${(day < 10 ? '0' : '').concat(day)}`;
            },
            async save() {
                // We only need id and status, nothing more
                let employeesMapped = this.employees.map(employee => {
                    return {
                        id: employee.id,
                        status: employee.status,
                    }
                });
                // And we need only where status is set
                employeesMapped = employeesMapped.filter(employee => employee.status != UNSET_STATUS);
                const payload = {
                    date: this.date,
                    employees: employeesMapped,
                };
                const response = await fetch("./save_attendance_data.php", {
                    method: "POST",
                    body: JSON.stringify(payload),
                });
                this.$toasted.show("Saved", {
                    position: "top-left",
                    duration: 1000,
                });
            },
            async refreshEmployeesList() {
                // Get all employees
                let response = await fetch("./get_employees_ajax.php");
                let employees = await response.json();
                // Set default status: unset
                let employeeDictionary = {};
                employees = employees.map((employee, index) => {
                    employeeDictionary[employee.id] = index;
                    return {
                        id: employee.id,
                        name: employee.name,
                        status: UNSET_STATUS,
                    }
                });
                // Get attendance data, if any
                response = await fetch(`./get_attendance_data_ajax.php?date=${this.date}`);
                let attendanceData = await response.json();
                // Refresh attendance data in each employee, if any
                attendanceData.forEach(attendanceDetail => {
                    let employeeId = attendanceDetail.employee_id;
                    if (employeeId in employeeDictionary) {
                        let index = employeeDictionary[employeeId];
                        employees[index].status = attendanceDetail.status;
                    }
                });
                // Let Vue do its magic ;)
                this.employees = employees;
            }
        },
    });
</script>
<?php
include_once "footer.php";
