<?php
    $connection = mysqli_init(); //Inicia la conexión con la base de datos
    mysqli_real_connect($connection,"aicofit-sqlserver.mysql.database.azure.com", "Aicofit_Admin", '3^cf$MzKfMu9Y#!u2CT5HDpV', "aicofit_db", 3306); //Establece la conexión con la base de datos

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>