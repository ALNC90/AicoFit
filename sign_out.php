<?php
session_start(); //Recoge los datos de la sesión
$_SESSION = array(); //Almacena todos los datos de la sesion
session_destroy(); //Los destruye
header('Location:index.php'); //Redirige al usaurio
?>