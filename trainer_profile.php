<?php 
    session_start();
    /*echo "<script>console.log('Sesion inciada');</script>";
    echo "<script>console.log(".$_SESSION['trainer_id'].");</script>";
    echo "<script>console.log(".$_SESSION['prueba'].");</script>";*/
    include 'db_connection.php';
    echo "<script>console.log('Sesion inciada 2222');</script>";
    if(isset($_SESSION["trainer_id"]))
    {
        /*echo "<script>console.log('Entro en condición');</script>";
        echo "<script>console.log(".$_SESSION['trainer_id'].");</script>";
        echo "<script>console.log(".$_SESSION['prueba'].");</script>";*/
        $id = $_SESSION["trainer_id"];
        /*echo "<script>console.log('Muestro id');</script>";
        echo "<script>console.log(".$id.");</script>";*/
        $sql = "SELECT * FROM trainers WHERE id = '$id'";
        $result = mysqli_query($connection,$sql);
        $row_trainer = mysqli_fetch_array($result);
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
        <title>Perfil de: <?php echo ''.$row_trainer['username'].''; ?></title>
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
        .div_button
        {
            text-align: center;
            align-items: center;
        }
        table
        {
            text-align: center;
            margin-left:auto; 
            margin-right:auto;
            font-size: 14px;  
            width: 55%;  
            font-family: 'News Gothic';
        }
        tbody tr:nth-child(odd) 
        {
            background-color: #ced4da;
        }

        tbody tr:nth-child(even) 
        {
            background-color: #e9ecef;
            
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
        textarea {
            height: 100px;
            width: 100%;
        }
    </style>
    <body>
        <span><h1>Bienvenido <?php echo ''.$row_trainer['username'].''; ?>!</h1></span>
        <span><h3>Elije una de las dos funciones:</h3><span>
        <div class="div_button">
            <button onclick="showCreateForm()">Crear rutina</button> 
            <button onclick="showDeleteTable()">Borrar rutina</button>
            <br><br>
            <button onclick="location.href='sign_out.php'">Salir</button>
            <br><br>
        </div>
        <div style=" width: 20%; margin: 0 auto; text-align: left; font-family:'News Gothic'">
            <form name="routine_form" id="routine_form" style="display:none" method="post">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name"><br><br>
                <label for="muscle-group">Grupo Muscular:</label>
                <input type="text" id="muscle-group" name="muscle-group"><br><br>
                <label for="description">Descripción:</label>
                <textarea id="description" name="description"></textarea><br><br>
                <label for="client">Cliente:</label>
                <select id="client" name="client">
                    <option value="" disable selected>Selecciona el cliente</option>
                    <?php
                        $sql = "SELECT firstname,surename,id FROM users";
                        $result = mysqli_query($connection,$sql);

                        if (mysqli_num_rows($result) > 0)
                        {
                            while($row_client = mysqli_fetch_assoc($result))
                            {
                                echo "<option value='". $row_client["id"] ."'>" .$row_client["surename"] .' ' . $row_client["firstname"] ."</option>";
                            }
                        }
                    ?>
                </select><br><br>
                <input type="submit" value="Crear Rutina" name="submit">
                <?php
                    if (isset($_POST['submit']))
                    {
                        $name = $_POST['name'];
                        $muscle_group = $_POST['muscle-group'];
                        $description = $_POST['description'];
                        $client = $_POST['client'];
                        $trainer = $row_trainer['id'];

                        $sql_query = "INSERT INTO routines (name_rou,muscular_group,description_rou,id_client,id_trainer) VALUES ('$name','$muscle_group','$description',$client,$trainer)";
                        mysqli_query($connection,$sql_query);  
                    }
                ?>
            </form>
        </div>
        <div id="delete_table" style="display:none;" name="delete_table">
            <?php
                $id_trainer = $row_trainer['id'];
                $sql_table = "SELECT * FROM routines WHERE id_trainer = '$id_trainer'";
                $result_table = mysqli_query($connection,$sql_table);

                if (mysqli_num_rows($result) > 0)
                {
                    echo "<table>
                            <tr>
                                <th>Rutina</th>
                                <th>Borrar</th>
                            </tr>";
                    while ($row_table = mysqli_fetch_assoc($result_table))
                    {
                        echo "<tr>
                                <td>Nombre:" . $row_table['name_rou'] . "<br> Grupo muscular:" . $row_table['muscular_group'] . "<br> Descripción:" . $row_table['description_rou'] . "</td>
                                <td style='padding-top:25px; width:200px;'>
                                    <form method='post' action='delete_routine.php'>
                                        <input type='hidden' name='id' value='". $row_table["id_rou"] ."'>
                                        <input type='submit' value='Borrar' name='delete_rou' style='padding:12px; font-size:14px; width:150px;'>
                                    </form>
                                </td>
                            </tr>";
                    }
                    echo "</table>";
                }
                else
                {
                    echo "No hay rutinas creadas.";
                }
            ?>
        </div>
        <script>
            function showCreateForm() 
            {
                document.getElementById("routine_form").style.display = "block";
                document.getElementById("delete_table").style.display = "none";
            }
            function showDeleteTable() 
            {
                document.getElementById("routine_form").style.display = "none";
                document.getElementById("delete_table").style.display = "block";
            }
        </script>
    </body>
</html>