<?php 
    session_start();
    include 'db_connection.php';
    if(isset($_SESSION["user_id"]))
    {
        $id = $_SESSION["user_id"];
        $sql = "SELECT * FROM trainers WHERE id = '$id'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result);
    }
    else
    {
        header("Location:index.php");
    }
?>
<html lang="es">
    <head>
        <meta name="Author" content="Alin Ioan Chelemen">
        <meta name="Description" content="Página de gimnasio">
        <meta name="Keywords" content="PHP, Gym, HTML">
        <meta charset="UTF-8">
        <title>Perfil de: <?php echo ''.$row['username'].''; ?></title>
    </head>
    <style>
        h1 
        {
            font-family: "Clean Sports Stencil";
            background: -webkit-linear-gradient(-85deg,  #0db9d3 20%  , #034458 60%); /* Degradado de color al texto*/
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -webkit-text-stroke: 0.0001px White;
            font-size: 40px;
        }
        h3
        {
            font-family: 'News Gothic';
            font-style: italic;
        }
        span
        {
            text-align: center;
            align-items: center;
        }
        div
        {
            text-align: center;
            align-items: center;
        }
    </style>
    <body>
        <span><h1>Bienvenido <?php echo ''.$row['username'].''; ?>!</h1></span>
        <span><h3>Elije una de las dos funciones:</h3><span>
        <div>
            <button>Crear rutina</button> 
            <button>Borrar rutina</button>
        <div>
    </body>
</html>