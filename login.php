<?php
session_start(); //Inicio de sesión del usuario 
include 'db_connection.php';  //Conexión con la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') //Comprueba que el metodo de envio sea tipo POST
{
    //Comprueba que es un cliente 
    if ($_POST['type'] === 'client')
    {
        //Almacena las varibales username y contraseña
        $username_c = $_POST['username_c'];
        $password_c = $_POST['password'];
        //Realiza un consulta en la que busque el username que ha introducido el usuaurio y luego almacena la fila en row_client
        $sql_client = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $sql_client->bind_param("s", $username_c);
        $sql_client->execute();
        $result_client = $sql_client->get_result();
        $row_client = mysqli_fetch_array($result_client);
        //Almacena el hash de la tabla de users
        $hash_client = $row_client['password_hash'];
        //Almacena el hash que se ha creado mediante la contraseña que ha introducido el usuario concatenada a la cadena creada en el registro
        $hashed_password = hash('sha256', $password_c . $row_client['salt']);
    }
    else
    {
        //Mismo procedimiento que en el anterior cambiando a trainers.
        $username_t = $_POST['username_t'];
        $password_t = $_POST['password'];
        $sql_trainer = $connection->prepare("SELECT * FROM trainers WHERE username = ?");
        $sql_trainer->bind_param("s", $username_t);
        $sql_trainer->execute();
        $result_trainer = $sql_trainer->get_result();
        $row_trainer = mysqli_fetch_array($result_trainer);
        $hash_trainer = $row_trainer['password_hashed'];
        $hashed_password = hash('sha256', $password_t . $row_trainer['salt']);
    }      
    //Comprobamos que las variables row sean arrays.
    if (is_array($row_client) || is_array($row_trainer))
    {
        if ($_POST['type'] === 'client')
        {
            //Comprobamos que ambas contraseñas coincidan 
            if ($hashed_password === $hash_client)
            {
                $_SESSION["client_id"]=$row_client['id']; //Almacenamos el id del usaurio en la variable de de session global
                echo "<script>window.location.href='client_profile.php';</script>"; //Redirigimos al usuario a su página de perfil
            }
            else
            {
                //Comprobamos si Session login_attempts esta creado, este apartado lo creamos para que el usuario tenga un numero límite de intentos
                if (!isset($_SESSION["login_attempts"]))
                {
                    $_SESSION["login_attempts"] = 0; //Igualamos esta variable a 0
                }
                $_SESSION["login_attempts"]++; //Sumamos 1 al valor de Session
                
                //Si la variable SESSION es mayo que 5 o igual se alertará al usuario que ha superado el numero de intentos y se bloqueara la cuenta por 60 segundos
                if ($_SESSION["login_attempts"] >= 5)
                {
                    echo '<script>alert("Has superado el número de intentos tu cuanta se ha bloqueado por 60 segundos.");</script>';
                    sleep(60);
                    $_SESSION["login_attempts"] = 0;
                }
                
                echo "<script>
                window.location.href = 'index.php'; 
                alert('El usuario o la contraseña no son correctos.');
                </script>";
            }
        }
        else
        {
            //Se repite la misma operación que en anterior apartado pero para los entrenadores
            if ($hashed_password === $hash_trainer)
            {
                //session_start();
                $_SESSION["trainer_id"]=$row_trainer['id'];
                echo "<script>window.location.href='trainer_profile.php';</script>";
            }
            else
            {
                
                //session_start();
                if (!isset($_SESSION["login_attempts"]))
                {
                    $_SESSION["login_attempts"] = 0;
                }
                $_SESSION["login_attempts"]++;
                
                
                if ($_SESSION["login_attempts"] >= 5)
                {
                    echo '<script>alert("Has superado el número de intentos tu cuanta se ha bloqueado por 60 segundos.");</script>';
                    sleep(60); 
                    $_SESSION["login_attempts"] = 0;
                }
                
                echo "<script>
                window.location.href = 'index.php'; 
                alert('El usuario o la contraseña no son correctos.');
                </script>";
            }
        }
    }
    else
    {
        echo "<script>
        window.location.href = 'index.php'; 
        alert('El usuario o la contraseña no son correctos.');
        </script>";
    }
} 
?>
