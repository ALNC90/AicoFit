<?php 
    session_start(); //Se inicia la sesión y se almacenan los valores de la sesión
    include 'db_connection.php'; //Incluimos la conexión a la base de datos
    //Comprobamos que la variable Session de trainer_id tiene valor
    if(isset($_SESSION["trainer_id"]))
    {
        $id = $_SESSION["trainer_id"]; //Asignamos ese valor a una variable
        //Realizamos una query donde se alamcene en row_trainer la fila que corresponde con ese id y sus datos
        $sql = "SELECT * FROM trainers WHERE id = '$id'"; 
        $result = mysqli_query($connection,$sql);
        $row_trainer = mysqli_fetch_array($result);
    }
    else
    {
        header("Location:index.php"); //Si la condición no se cumple reddirigimos al usuario a la pagina pricipal
        session_destroy(); //Destruimos la sesión
    }
?>
<html lang="es">
    <head>
        <meta name="Author" content="Alin Ioan Chelemen">
        <meta name="Description" content="Página de gimnasio">
        <meta name="Keywords" content="PHP, Gym, HTML">
        <meta charset="UTF-8">
        <title>Perfil de: <?php echo ''.$row_trainer['username'].''; ?></title> <!-- Mostramos el perfil del usuario -->
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
        <span><h1>Bienvenido <?php echo ''.$row_trainer['username'].''; ?>!</h1></span> <!-- Damos la bienvenida al usaurio -->
        <span><h3>Elije una de las dos funciones:</h3><span>
        <div class="div_button">
            <button onclick="showCreateForm()">Crear rutina</button> <!-- Ejecutamos un función en el momento que pulsamos el botón -->
            <button onclick="showDeleteTable()">Borrar rutina</button> <!-- Ejecutamos un función en el momento que pulsamos el botón -->
            <br><br>
            <button onclick="location.href='sign_out.php'">Salir</button> <!-- Ejecutamos la función de redirigirnos a la página de sign_out en el momento que pulsamos el botón -->
            <br><br>
        </div>
        <div style=" width: 20%; margin: 0 auto; text-align: left; font-family:'News Gothic'">
            <!-- Formulario para la creación de rutina -->
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
                        //Realizamos una query para recoger los siguientes valores de todos los usuarios que hay en la tabla users
                        $sql = "SELECT firstname,surename,id FROM users";
                        $result = mysqli_query($connection,$sql);

                        //Comprobamos que hayan filas en el result mediante la comprobación de que hayan mas de 0 filas
                        if (mysqli_num_rows($result) > 0)
                        {
                            //Realizamos un bucle while que que va almacenando en row cada fila y la va almacenando en las distintas opciones que tenemos
                            while($row_client = mysqli_fetch_assoc($result))
                            {
                                echo "<option value='". $row_client["id"] ."'>" .$row_client["surename"] .' ' . $row_client["firstname"] ."</option>";
                            }
                        }
                    ?>
                </select><br><br>
                <input type="submit" value="Crear Rutina" name="submit">
                <?php
                    //Si el botón de submit tiene valor se cumple la condición
                    if (isset($_POST['submit']))
                    {
                        //Recogemos todos los valores introducidos por el usuario
                        $name = $_POST['name'];
                        $muscle_group = $_POST['muscle-group'];
                        $description = $_POST['description'];
                        $client = $_POST['client'];
                        $trainer = $row_trainer['id'];

                        //Realizamos una query para introducir los valores dentro de la tabla rutinas
                        $sql_query = "INSERT INTO routines (name_rou,muscular_group,description_rou,id_client,id_trainer) VALUES ('$name','$muscle_group','$description',$client,$trainer)";
                        mysqli_query($connection,$sql_query);  
                    }
                ?>
            </form>
        </div>
        <div id="delete_table" style="display:none;" name="delete_table">
            <?php
                //Tabla encarga de borrar las rutinas
                //Recogemso todas las tablas que pertenezcan al id del entrenador que ha creado las rutinas.
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
                    //Vamos introdución fila segun las filas que hemos encontrado dentro de la consulta
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
            //Mostramos el formulario de rutina y el de borrar rutinas lo ocultamos
            function showCreateForm() 
            {
                document.getElementById("routine_form").style.display = "block";
                document.getElementById("delete_table").style.display = "none";
            }
            //Mostramos el formulario de borrar rutinas y el de crear rutinas lo ocultamos
            function showDeleteTable() 
            {
                document.getElementById("routine_form").style.display = "none";
                document.getElementById("delete_table").style.display = "block";
            }
        </script>
    </body>
</html>