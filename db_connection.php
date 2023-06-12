<?php
    $connection = mysqli_init();
    mysqli_real_connect($connection,"aicofit-sqlserver.mysql.database.azure.com", "Aicofit_Admin", '3^cf$MzKfMu9Y#!u2CT5HDpV', "aicofit_db", 3306);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>