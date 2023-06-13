<?php 
    session_start();
    include 'db_connection.php';
    if(isset($_SESSION["user_id"]))
    {
        $id = $_SESSION["user_id"];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result);
    }
    else
    {
        header("Location:index.php");
    }
    session_write_close();
?>
<html lang="es">
    <head>
        <meta name="Author" content="Alin Ioan Chelemen">
        <meta name="Description" content="Página de gimnasio">
        <meta name="Keywords" content="PHP, Gym, HTML">
        <meta charset="UTF-8">
        <title>Perfil de: <?php echo ''.$row['firstname'].''; ?></title>
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
        p
        {
            font-family: 'News Gothic';
            font-size:20px;
        }
        span
        {
            text-align: center;
        }
        tbody tr:nth-child(odd) 
        {
            background-color: #ced4da;
        }

        tbody tr:nth-child(even) 
        {
            background-color: #e9ecef;
            
        }
        table
        {
            text-align: center;
            margin-left:auto; 
            margin-right:auto;
            font-size: 20px;  
            width: 50%;  
            font-family: 'News Gothic';
        }
    </style>
    <body>
        <span><h1>Bienvenido <?php echo ''.$row['firstname'].''; ?>!</h1></span>
        <span><h3>Tus datos son los siguientes:</h3><span>
        <br>
        <table>
            <tr>
               <th>Nombre</th>
               <th>Apellidos</th>
               <th>Edad</th>
               <th>Peso</th>
               <th>Estatura</th>
            </tr>
            <tr>
               <td><?php echo ''.$row['firstname'].''; ?></td>
               <td><?php echo ''.$row['surename'].''; ?></td>
               <td><?php echo ''.$row['age'].''; ?></td>
               <td><?php echo ''.$row['u_weight'].''; ?></td>
               <td><?php echo ''.$row['u_height'].''; ?></td>
            </tr>
        </table>
        <br>
        <span><h3>Rutina asignadas:</h3><span>
    </body>
</html>