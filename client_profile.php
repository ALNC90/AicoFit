<?php 
    session_start();
    include 'db_connection.php';
    print_r($_SESSION);
    if(isset($_SESSION["user_id"]))
    {
        echo '<h1>¡Bienvenido, '. $user['firstname']. '!</h1>';
    $sql = $connection->prepare('SELECT * FROM users WHERE id = ?');
    $sql->execute([$_SESSION['user_id']]);
    $user = $sql->fetchassoc();
    }
    else
    {
        echo '<h1>NO FUNAIOC</h1>';
    }
?>