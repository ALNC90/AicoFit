<?php
include 'db_connection.php';

//Elimina las rutinas de la tabla de rutinas
if (isset($_POST["id"])) {
    $routine_id = $_POST["id"];
    $sql = "DELETE FROM routines WHERE id_rou = '$routine_id'";
    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("Rutina eliminada correctamente.");</script>';
        echo "<script>window.location.href='trainer_profile.php';</script>";
    }
}
?>
