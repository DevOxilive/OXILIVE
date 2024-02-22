<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../../../connection/conexion.php');
    $id = $_POST['selectDept'];
    $sql = "SELECT * FROM empleados WHERE departamento = :id";
    $Emp = $con->prepare($sql);
    $Emp->bindParam(':id', $id);
    $Emp->execute();
    $r = $Emp->fetchAll(PDO::FETCH_ASSOC);
    echo "carga lista";

    if (count($r) > 0) {
        foreach ($r as $row) {
            echo '<option value="' . $row['usuarioSistema'] . '">' . $row['nombres'] . " " . $row['apellidos'] . '</option>';
        }
    } else {
?>
        <option value="" selected disabled>no hay personas en el departamento</option>
<?php
    }
}
