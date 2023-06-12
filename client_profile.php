<?php 
    include 'db_connection.php';


    $sql = $connection->prepare('SELECT * FROM users WHERE id = ?');
    $sql->execute([$_SESSION['user_id']]);
    $user = $sql->fetchassoc();

    echo '<h1>¡Bienvenido, '. $user['firstname']. '!</h1>';
?>