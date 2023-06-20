<?php include 'db_connection.php';?>
<html lang="es">
    <head>
        <!-- Etiquetas "meta" donde aportamos información sobre la página -->
        <meta name="Author" content="Alin Ioan Chelemen">
        <meta name="Description" content="Registrar usuario">
        <meta name="Keywords" content="PHP, Gym, HTML"/>
        <meta charset="UTF-8">

        <!-- Título de la página en el apartado de pestañas del navegador -->
        <title>Registrarse</title>
    </head>
    <style>
        body
        {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(./Images/Fondos/Gym_3.jpg);
            background-size: cover;
        }
        /* Se encarga de añadir un borde de color verde cuando el input realizado cumple las restricciones */
        input:valid
        {
            border: green 1px solid;
        }

        /* Se encarga de añadir un borde de color rojo cuando el input realizado incumple las restricciones */
        input:invalid
        {
            border: red 1px solid;
        }
        p
        {
            color: grey;
            font-size: 10px;
        }
        input[type="email"]{
            margin-bottom: 2em;
        }
        .container 
        {
            display: inline-block;
            margin: 0 auto;
            padding: 5px;
        }
        label
        {
            color: white;
        }
        select,option
        {
            font-family: 'News Gothic';
            font-size: 20px;
            text-align-last:center;
        }
        input
        {
            width: 200px;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box; 
        }
        h1
        {
            font-family: 'Clean Sports Stencil';
            font-size: 10px;
            color: white;
        }
        input[type="submit"]
        {
            transform: translate(140px, 15px);
            background-color: #0db9d3;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 3px;
            background-color: transparent;
            border: 2px solid #0db9d3;
        }
        input[type="submit"]:hover
        {
            background-color: #034458;
        }
    </style>
    <body>
        <script src="index.js"></script> <!-- Script encargado de abrir el formulario para cada un de los tipos de usuarios. -->
        <!-- Selector del tipo de cuenta entre cliente y entrenador -->
        <div class="container">
            <form>
                <label for="account_type" style="font-family: 'Clean Sports Stencil'; color: white;">Tipo de cuenta:</label>
                <select name="account_type" id="account_type" onchange="showForm()" style="height:50px; width: 300px">
                    <option value="" disabled selected>-- Selecciona el tipo de cuenta --</option>
                    <option value="client">Cliente</option>
                    <option value="trainer">Entrenador</option>
                </select>
            </form>
            <form name="form_client" id="form_client" style="display: none;" onsubmit="return validatePassClient()"  method="post">

                <h1>DATOS DE REGISTRO</h1>
                <label for="username">Usuario:</label>
                <br>
                <input type="text" name="username" name="username" required maxlength="25" pattern="(?!.*\s)[A-Za-z0-9]{3,}">
                <p>El nombre de usuario debe tener como mínimo 3 carácteres letras y/o números sin espacios.</p>
                <label for="mail">Correo eléctrico:</label>
                <br>
                <input type="email" name="mail" id="mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
                <br>
                <label for="pass1_c"><span style="display: inline-block; width: 253px;">Contraseña:</span></label><label for="pass2_c">Repite la contraseña:</label>
                <br>
                <span style="display: inline-block; width: 250px;"><input type="password" name="pass1_c" id="pass1_c" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}"></span>
                <input type="password" name="pass2_c" id="pass2_c" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}">
                <p>La contraseña debe contener un número, un caractér especial, una letra mayuscula y minuscula y mínimo 8 caracteres.</p>

                <h1>DATOS PERSONALES</h1>
                <label for="name"><span style="display: inline-block; width: 250px;">Nombre:</span></label> <label for="surname">Apellidos:</label>
                <br>
                <span style="display: inline-block; width: 250px;"><input type="text" maxlength="30" id="name" name="name" required></span>
                <input type="text" name="surname" id="surname" maxlength="30"required>
                <br>
                <label for="age">Edad:</label>
                <br>
                <input type="text" name="age" id="age" pattern="[1-9][0-9]"required>
                <br>
                <label for="weight"><span style="display: inline-block; width: 253px;">Peso:</span></label><label for="height">Estatura:</label>
                <br>
                <span style="display: inline-block; width: 250px;"><input type="text" name="weight" pattern="[1-9][0-9]\.[0-9]" id="weight" required></span>
                <input type="text" name="height" id="height" pattern="[1-9]\.[0-9][0-9]" required>
                <br><input type="hidden" name="type" value="client">
                <input type="submit"  value="Siguiente" name="create">
                <br>

            </form>
            <form name="form_trainer" id="form_trainer" style="display: none;" onsubmit="return validatePassTrainer()"  method="post">

                <h1>DATOS DE REGISTRO</h1>
                <label for="username">Usuario:</label>
                <br>
                <input type="text" name="username" name="username" required maxlength="25" pattern="(?!.*\s)[A-Za-z0-9]{3,}">
                <p>El nombre de usuario debe tener como mínimo 3 carácteres letras y/o números sin espacios.</p>
                <label for="mail">Correo eléctrico:</label>
                <br>
                <input type="email" name="mail" id="mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
                <br>
                <label for="pass1_t"><span style="display: inline-block; width: 253px;">Contraseña:</span></label><label for="pass2_t">Repite la contraseña:</label>
                <br>
                <span style="display: inline-block; width: 250px;"><input type="password" name="pass1_t" id="pass1_t" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}"></span>
                <input type="password" name="pass2_t" id="pass2_t" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}">
                <p>La contraseña debe contener un número, un caractér especial, una letra mayuscula y minuscula y mínimo 8 caracteres.</p>
                <br><input type="hidden" name="type" value="trainer">
                <input type="submit"  value="Siguiente" name="create">

            </form>
            <?php
            if(isset($_POST['create']))
            {
                $username = $_POST["username"];
                $mail = $_POST["mail"];
                if ($_POST['type'] === 'client')
                {
                    $sql_user = "SELECT * FROM users WHERE username='$username'";
                    $sql_mail = "SELECT * FROM users WHERE email='$mail'";
                    $result_user = $connection->query($sql_user);
                    $result_mail = $connection->query($sql_mail);

                    if($result_user->num_rows > 0)
                    {
                        echo '<script>alert("El nombre de usuario ya existe. Elija otro usuario diferente.");</script>';
                    }
                    elseif ($result_mail->num_rows > 0)
                    {
                        echo '<script>alert("El correo el electrónico ya se encuentra registrado en esta plataforma.");</script>';
                    }
                    else
                    {
                        $password = $_POST["pass1_c"];
                        $firstname = $_POST["name"];
                        $surname = $_POST["surname"];
                        $age = $_POST["age"];
                        $u_height = $_POST["height"];
                        $u_weight = $_POST["weight"];
                        $salt = bin2hex(random_bytes(32));
                        $hashed_password = hash('sha256', $password . $salt);
                        $sql_client = "INSERT INTO users (username,email,firstname,surename,age,u_weight,u_height,password_hash,salt) 
                        VALUES ('$username','$mail','$firstname','$surname',$age,$u_weight,$u_height,'$hashed_password','$salt')";

                        if(mysqli_query($connection, $sql_client))
                        {
                            echo '<script>alert("La cuenta se ha creado correctamente.");</script>';
                            echo "<script>window.location.href='index.php';</script>";
                        }
                        else
                        {
                        echo "Error: ". $sql_client . "<br>". mysqli_error($connection);
                        }

                    }
                    mysqli_close($connection);
                }
                else if ($_POST['type'] === 'trainer')
                {
                    $sql_user = "SELECT * FROM trainers WHERE username='$username'";
                    $sql_mail = "SELECT * FROM trainers WHERE email='$mail'";
                    $result_user = $connection->query($sql_user);
                    $result_mail = $connection->query($sql_mail);

                    if($result_user->num_rows > 0)
                    {
                        echo '<script>alert("El nombre de usuario ya existe. Elija otro usuario diferente.");</script>';
                    }
                    elseif ($result_mail->num_rows > 0)
                    {
                        echo '<script>alert("El correo el electrónico ya se encuentra registrado en esta plataforma.");</script>';
                    }
                    else
                    {
                        $password = $_POST["pass1_t"];
                        $salt = bin2hex(random_bytes(32));
                        $hashed_password = hash('sha256', $password . $salt);
                        $sql_trainer = "INSERT INTO trainers (username,email,password_hashed,salt) 
                        VALUES ('$username','$mail','$hashed_password','$salt')";

                        if(mysqli_query($connection, $sql_trainer))
                        {
                            echo '<script>alert("La cuenta se ha creado correctamente.");</script>';
                            echo "<script>window.location.href='index.php';</script>";
                        }
                        else
                        {
                        echo "Error: ". $sql_trainer . "<br>". mysqli_error($connection);
                        }

                    }
                    mysqli_close($connection);
                }
            }
            ?>
        </div>
    </body>
</html>


