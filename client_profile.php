<?php 
    include 'db_connection.php';
    if (!isset($_SESSION['user_id']))
    {
        header('Location: index.php');
        exit;
    }

    $sql = $connection->prepare('SELECT * FROM users WHERE id = ?');
    $sql->execute([$_SESSION['user_id']]);
    $user = $sql->fetch();

    echo '<h1>¡Bienvenido, '. $user['firstname']. '!</h1>';
?>