<?php
include 'db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($_POST['type'] === 'client')
    {
        $username = $_POST['username_c'];
        $password = $_POST['password'];
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);
        //$hash = password_hash($row['pass'], PASSWORD_DEFAULT);
        $hash = $row['password_hash'];
        $hashed_password = hash('sha256', $password . $row['salt']);
        echo "<script>console.log('Debug Objects: " . $row['username'] . "' );</script>";
        echo "<script>console.log('Debug Objects: " . $username . "' );</script>";
        echo "<script>console.log('Debug Objects: " . $password . "' );</script>";
        echo "<script>console.log('Debug Objects: " . $hash . "' );</script>";
        echo "<script>console.log('Debug Objects: " . $hashed_password . "' );</script>";
    }
    else
    {
        $username = $_POST['username_t'];
        $password = $_POST['password'];
        $stmt = $connection->prepare("SELECT * FROM trainers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);
        $hash = $row['password_hashed'];
        $hashed_password = hash('sha256', $password . $row['salt']);
    }      
    if (is_array($row))
    {
        if ($_POST['type'] === 'client')
        {
            if ($hashed_password === $hash)
            {
                session_start();
                $_SESSION["user_id"]=$row['id'];
                //header("Location:client_profile.php");
                header("Location:https://aicofit.azurewebsites.net/client_profile.php");
            }
            else
            {
                // Increment failed login attempts
                session_start();
                if (!isset($_SESSION["login_attempts"]))
                {
                    $_SESSION["login_attempts"] = 0;
                }
                $_SESSION["login_attempts"]++;
                
                // Lock out user after 5 failed login attempts
                if ($_SESSION["login_attempts"] >= 5)
                {
                    //sleep(60); // Delay for 60 seconds
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
            if ($hashed_password === $hash)
            {
                session_start();
                $_SESSION["user_id"]=$row['id'];
                //header("Location:trainer_profile.php");  
                header("Location:https://aicofit.azurewebsites.net/trainer_profile.php");
            }
            else
            {
                // Increment failed login attempts
                session_start();
                if (!isset($_SESSION["login_attempts"]))
                {
                    $_SESSION["login_attempts"] = 0;
                }
                $_SESSION["login_attempts"]++;
                
                // Lock out user after 5 failed login attempts
                if ($_SESSION["login_attempts"] >= 5)
                {
                    sleep(60); // Delay for 60 seconds
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
