<?php
include 'db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($_POST['type'] === 'client')
    {
        $username_c = $_POST['username_c'];
        $password_c = $_POST['password'];
        $sql_client = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $sql_client->bind_param("s", $username_c);
        $sql_client->execute();
        $result_client = $sql_client->get_result();
        $row_client = mysqli_fetch_array($result_client);
        $hash_client = $row_client['password_hash'];
        $hashed_password = hash('sha256', $password_c . $row_client['salt']);
        $row_trainer ="";
    }
    else
    {
        $username_t = $_POST['username_t'];
        $password_t = $_POST['password'];
        $sql_trainer = $connection->prepare("SELECT * FROM trainers WHERE username = ?");
        $sql_trainer->bind_param("s", $username_t);
        $sql_trainer->execute();
        $result_trainer = $sql_trainer->get_result();
        $row_trainer = mysqli_fetch_array($result_trainer);
        $hash_trainer = $row_trainer['password_hashed'];
        $hashed_password = hash('sha256', $password_t . $row_trainer['salt']);
        $row_client ="";
    }      
    if (is_array($row_client) || is_array($row_trainer))
    {
        if ($_POST['type'] === 'client')
        {
            if ($hashed_password === $hash_client)
            {
                session_start();
                $_SESSION["client_id"]=$row_client['id'];
                echo "<script>window.location.href='client_profile.php';</script>";
                session_write_close();
            }
            else
            {
                
                session_start();
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
        else
        {
            echo "<script>console.log('$hashed_password');</script>";
            echo "<script>console.log('$hash_trainer');</script>";
            echo "<script>console.log(".$row_trainer['id'].");</script>";
            if ($hashed_password === $hash_trainer)
            {
                session_start();
                $_SESSION["trainer_id"]=$row_trainer['id'];
                echo "<script>window.location.href='trainer_profile.php';</script>";
                session_write_close();
            }
            else
            {
                
                session_start();
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
