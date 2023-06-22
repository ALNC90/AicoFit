<?php 
    session_start();
    echo "<script>console.log('id antes de inicar sesión');</script>";
    echo "<script>console.log(".$_SESSION['client_id'].");</script>";
    include 'db_connection.php';
    if(isset($_SESSION["client_id"]))
    {
        $id = $_SESSION["client_id"];
        echo "<script>console.log(".$_SESSION['client_id'].");</script>";
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result);
    }
    else
    {
        header("Location:index.php");
        session_destroy();
    }
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
        button
        {
            background-color: #0db9d3;
            border: none;
            color: #0db9d3;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 3px;
            background-color: transparent;
            border: 2px solid #0db9d3;
        }
        button:hover
        {
            background-color: #034458;
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
        <?php
            $id_rou = $row["id"];
            $sql_rou = "SELECT * FROM routines WHERE id_client = '$id_rou'";
            $result_rou = mysqli_query($connection,$sql_rou);

            if(mysqli_num_rows($result_rou) > 0)
            {
                echo "<table>
                        <tr>
                            <th>Rutina</th>
                            <th>Entrenador</th>
                        </tr>";
                while($row_rou = mysqli_fetch_assoc($result_rou))
                {
                    
                    $id_trainer = $row_rou['id_trainer'];
                    $sql_trainer = "SELECT username FROM trainers WHERE id = '$id_trainer'";
                    $result_trainer = mysqli_query($connection,$sql_trainer);
                    $row_trainer = mysqli_fetch_assoc($result_trainer);

                    echo "<tr>
                            <td>Nombre: " . $row_rou['name_rou'] . "<br> Grupo muscular: " . $row_rou['muscular_group'] . "<br> Descripción: " . $row_rou['description_rou'] . "</td>
                            <td>" . $row_trainer['username'] . "</td>
                        </tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "<div style=display:center;>No hay rutinas disponibles.</div>";
            }
            ?>
            <br>
            <div style="display:center"><button onclick="location.href='sign_out.php'">Salir</button></div>
    </body>
</html>