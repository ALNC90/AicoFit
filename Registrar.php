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
            display: inline-block;
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
    </style>
    <body>
        <script src="index.js"></script> <!-- Script encargado de abrir el formulario para cada un de los tipos de usuarios. -->
        <!-- Selector del tipo de cuenta entre cliente y entrenador -->
        <form>
            <label for="account_type">Tipo de cuenta:</label>
            <select name="account_type" id="account_type" onchange="showForm()">
                <option value="" disabled selected>-- Selecciona el tipo de cuenta --</option>
                <option value="client">Cliente</option>
                <option value="trainer">Entrenador</option>
            </select>
        </form>
        <form id="form_client" style="display: none;" onsubmit="validatePass()" action="index.php" method="post">

            <h1>DATOS DE REGISTRO</h1>
            <label for="username">Usuario:</label>
            <br>
            <input type="text" name="username" name="username" required maxlength="25" pattern="(?!.*\s)[A-Za-z0-9]{3,}">
            <p>El nombre de usuario debe tener como mínimo 3 carácteres letras y/o números sin espacios.</p>
            <label for="mail">Correo eléctrico:</label>
            <br>
            <input type="email" name="mail" id="mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
            <br>
            <label for="pass1"><span style="display: inline-block; width: 188px;">Contraseña:</span></label><label for="pass2">Repite la contraseña:</label>
            <br>
            <span style="display: inline-block; width: 183px;"><input type="password" name="password" id="pass1" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}"></span>
            <input type="password" name="repeat_password" id="pass2" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}">
            <p>La contraseña debe contener un número, un caractér especial, una letra mayuscula y minuscula y mínimo 8 caracteres.</p>

            <h1>DATOS PERSONALES</h1>
            <span style="display: inline-block; width: 180px;">Nombre:</span> Apellidos:
            <br>
            <span style="display: inline-block; width: 178px;"><input type="text" name="name" placeholder="Nombre..."></span>
            <input type="text" name="surname" placeholder="Apellidos...">
            <br>
            Edad:
            <br>
            <input type="text" name="age" pattern="[1-9][0-9]">
            <br>
            <span style="display: inline-block; width: 180px;">Peso:</span>Estatura:
            <br>
            <span style="display: inline-block; width: 177px;"><input type="text" name="heigth" pattern="[1-9]\.[0-9][0-9]"></span>
            <input type="text" name="weight" pattern="[1-9][0-9]">
            <br>
            <a href="index.php"><input type="submit"  value="Siguiente"></a>
            <br>

        </form>
        <form id="form_trainer" style="display: none;">

            <h1>DATOS DE REGISTRO</h1>
            <label for="username">Usuario:</label>
            <br>
            <input type="text" name="username" name="username" required maxlength="25" pattern="(?!.*\s)[A-Za-z0-9]{3,}">
            <p>El nombre de usuario debe tener como mínimo 3 carácteres letras y/o números sin espacios.</p>
            <label for="mail">Correo eléctrico:</label>
            <br>
            <input type="email" name="mail" id="mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
            <br>
            <label for="pass1"><span style="display: inline-block; width: 188px;">Contraseña:</span></label><label for="pass2">Repite la contraseña:</label>
            <br>
            <span style="display: inline-block; width: 183px;"><input type="password" name="password" id="pass1" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}"></span>
            <input type="password" name="repeat_password" id="pass2" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=`{}[:;<>?,.@#\]-])(?!.*\s).{8,}">
            <p>La contraseña debe contener un número, un caractér especial, una letra mayuscula y minuscula y mínimo 8 caracteres.</p>

            <h1>DATOS PERSONALES</h1>
            <span style="display: inline-block; width: 180px;">Nombre:</span> Apellidos:
            <br>
            <span style="display: inline-block; width: 178px;"><input type="text" name="name" placeholder="Nombre..."></span>
            <input type="text" name="surname" placeholder="Apellidos...">
            <br>
            Edad:
            <br>
            <input type="text" name="age" pattern="[1-9][0-9]">
            <br>
            <span style="display: inline-block; width: 180px;">Peso:</span>Estatura:
            <br>
            <span style="display: inline-block; width: 177px;"><input type="text" name="heigth" pattern="[1-9]\.[0-9][0-9]"></span>
            <input type="text" name="weight" pattern="[1-9][0-9]">
            <br>
            <a href="index.php"><input type="submit"  value="Siguiente"></a>
            <br>

        </form>
    </body>
    <?php
    try {
        $connection = new mysqli("localhost","root",'',"gimnasio");
    }
    catch (mysqli_sql_exception $e)
    {
        echo "Hay un problema en la conexión con al base de datos.";
    }

    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $sql_user = "SELECT * FROM users WHERE usuario='$username'";
    $sql_mail = "SELECT * FROM users WHERE email='$mail'";
    $result_user = $connection->query($sql_user);
    $result_mail = $connection->query($sql_mail);

    if($result_user->num_rows > 0)
    {
        echo "El nombre de usuario ya existe. Elija otro usuario diferente.";
    }
    elseif ($result_mail->num_rows > 0)
    {
        echo "El correo el electrónico ya se encuentra registrado en esta plataforma.";
    }
    else
    {
        $password = $_POST["pass1"];
        $sql = "INSERT INTO users (usuario,contraseña) VALUES ('$username','$password')";

        if($connection->query($sql) === TRUE)
        {
            echo "La cuenta se ha creado correctamente";
        }
        else
        {
            echo "Error: ". $sql . "<br>". $connection->error;
        }
    }

    $connection->close();
    ?>
</html>


