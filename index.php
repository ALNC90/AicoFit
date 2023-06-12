<?php include 'db_connection.php';?>
<html lang="es">
    <head>
        <!-- Etiquetas "meta" donde aportamos información sobre la página -->
        <meta name="Author" content="Alin Ioan Chelemen">
        <meta name="Description" content="Página de gimnasio">
        <meta name="Keywords" content="PHP, Gym, HTML">
        <meta charset="UTF-8">

        <!-- Título de la página en el apartado de pestañas del navegador -->
        <title>Aico Fit</title>
    </head>
    <style>
        /* Clase container, contenedor de los distintos paneles de la web */
        .container {
            width: 100%; /* Asigno el 100% del ancho de la página. */
            height: 700px; /* Asigno 700 pixeles del alto de la página. */
            display: flex; /* Permite que cada uno de los bloques que creamos posteriormente se dividan en bloques. */
            position:absolute;
        }
        /* Clase leftpane, panel izquierdo del contenedor */
        .leftpane {
            width: 20%;
            height: 700px;
            background-color: #fefcfb; /* Asignación del color */
            text-align: center; /* Alineación del texto al centro */
        }
        /* Clase rightpane, panel derecho del contenedor */
        .rightpane {
            width: 1190px;
            height: 729px;
            background-image: url(./Images/Fondos/Gym_2.jpg); /* Añado una imagen como fondo. */
            background-size: cover; /* Propiedad que hace que la imagen cubra el panel */
        }
        /* Asignación del margen de la web a 0 */
        body {
            margin: 0;
        }
        /* Clase selector, clase que interaciona mediante el cursor, junto con una transición y asignación de filtros a objetos. */
        .selector {
            cursor: pointer; /* Cambiamos el puntero por una mano */
            transition: all 1.5s ease; /* Generamos una animación de transición sobre todos los elementos */
            filter: grayscale(0.8) opacity(.8); /* Añadimos filtro de escala de grises y opacidad */
        }
        /* Ejecución de la propiedad hover cuando el cuersor se encuentra encima de este asignando filtros a los objetos. */
        .selector:hover {
            filter: grayscale(0) opacity(1); /* Cambiamos los valores del filtro a diferencia de los anteriores */
        }
        /* Asignación de tamaño y fuente a textos h4 */
        h4 {
            font-family: "Clean Sports Stencil"; /* Añadimos una fuente al texto */
            font-size: 10px; /* Asignamos un tamaño de fuente correspondiente */
        }
        /* Asignación de borde de texto y fuente a textos h3 */
        h3 {
            font-family: "Clean Sports Stencil";
            -webkit-text-stroke: 0.001em black; /* Añadimos borde al texto */
        }
        /* Asignación de tamaño, fuente y color degradado a textos h1 */
        h1 {
            font-family: "Clean Sports Stencil";
            background: -webkit-linear-gradient(-85deg,  #0db9d3 20%  , #034458 60%); /* Degradado de color al texto*/
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -webkit-text-stroke: 0.0001px White;
            font-size: 60px;
        }
        /* Clase que asigna las propiedades del boton como el color, grosor del borde derecho y la altura de este */
        .button {
            background-color: white;
            color: black;
            border-right: solid #000 5px;
            height: 120px;
        }
        /* Clase que toma efecto cuando el puntero esta encima del boton aplicando el color y la transición de esta. */
        .button:hover {
            color: white;
            transition: color 0.5s ease;
        }
        /* Asignación de la posición en el eje Z a 0 para que el recorrido no se realice en 3 dimensiones. */
        .sweep-to-left {
            transform: translateZ(0);
        }
        /* Clase que se encarga de crear un rectangulo negro con animación posteriormente.  */
        .sweep-to-left:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #000000;
            transform: scaleX(0);
            transform-origin: 100% 0%;
            transition-duration: 0.5s;
        }
        /* Cambia la eslaca horinzontal del rectangulo a su longitud original.  */
        .sweep-to-left:hover:before{
            transform: scaleX(1);
        }
        /* Elimino a cada uno de los enlaces el subrayado que este proporciona de manera predeterminada.  */
        a:visited
        {
            text-decoration: none;
        }
        a:hover
        {
            text-decoration: none;
        }
        a:active
        {
            text-decoration: none;
        }
        a:link
        {
            text-decoration: none;
        }
        /* Añado a los botones el siguiente estilo.  */
        button {
            border-radius: 4px;
            border: 3px solid #0db8d2;
            color: white;
            text-align: center;
            font-size: 28px;
            padding: 15px;
            width: 300px;
            transition: all 0.5s;
            cursor: pointer; /* Cambia el cursor por una mano */
            margin: 5px;
            background-color: transparent;
            background-repeat: no-repeat;
        }
        /* Afecta sobre todas las etiquetas "span" que este dentro de las etiquetas "button" */
        button span {
            cursor: pointer;
            display: inline-block; /* La disposición de los elementos se mostrará en el mismo bloque de seguido. */
            position: relative;
            transition: 0.5s;
        }
        /* Parte encargada de hacer aparecer la flecha del botón de registro junto con una transición y posición a la derecha */
        button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }
        /* Cuando el cursor se encuentra encima del botón este añade un padding a la derecha */
        button:hover span {
            padding-right: 25px;
        }
        /* Aparición de la flecha en el lado derecho del texto */
        button:hover span:after {
            opacity: 1;
            right: 0;
        }
        label
        {
            font-family: 'News Gothic';
            font-size: 20px;
            text-align-last:center;
            color:white;
            font-weight: bold;
        }
        input
        {
            width: 350px;
            height: 50px;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box; 
            font-size: 14px;
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
        table
        {
            width: 1300px;
        }
        th
        {
            font-family: 'News Gothic';
            background: -webkit-linear-gradient(-85deg,  #0db9d3 20%  , #034458 60%); /* Degradado de color al texto*/
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -webkit-text-stroke: 0.0001px White;
            font-size: 34px;
            height: 100px;
        }
        tr,td
        {
            font-family: 'News Gothic';
            text-align:center;
            padding: 12px;
            font-weight: bold;
        }
        tbody tr:nth-child(odd) 
        {
            background-color: #e9ecef;
        }

        tbody tr:nth-child(even) 
        {
            background-color: #ced4da;
            
        }
    </style>
    <body>
        <script src="index.js"></script>
        <div class="container"> <!-- Añadimos el contenedor que engloba todo el menú de opciones -->
                <div class="leftpane">  <!-- Asignamos el panel izquierdo del contenedor -->
                    <img alt="Aico FIT" src="Images/Logo.png" style="height: 100px; width: 150px; padding-top: 10px;">  <!-- Añadimos la imagen del logo desde nuestra ruta "Imagenes" -->
                    <br>
                    <br>

                    <!-- Creamos el primer botón que contendra un enlace a la página principal junto con las animaciones creadas para el botón -->
                    <a href="index.php">
                        <div class="button sweep-to-left selector">
                            <img alt="Inicio" src="Images/Botones/Home.png" style=" height: 50px; width: 50px; transform: translate(-13px , 20px) scale(120%);">
                            <h4 style="transform: translate(-13px , 20px);">Inicio</h4>
                        </div>
                    </a>

                    <!-- Siguiente botón que nos dara acceso a la página de "Sobre nosotros" junto con sus animaciones -->
                    <a href="index.php#about_us">
                        <div class="button sweep-to-left selector">
                            <a href="index.php#about_us"><img alt="Sobre_nosotros" src="Images/Botones/About_us.png" style="height: 45px; width: 55px; transform: translate(-11px , 15px) "></a>
                            <h4 style="transform: translate(-10px , 20px);">Sobre Nosotros</h4>
                        </div>
                    </a>

                    <!-- Botón para el acceso con nuestro usuario a la página web -->
                    <a href="index.php#sign_in">
                        <div class="button sweep-to-left selector">
                            <a href="index.php#sign_in"><img alt="Acceso" src="Images/Botones/Sing_in.png" style="height: 55px; width: 55px; transform: translate(-14px , 10px); scale(110%);"></a>
                            <h4 style="transform: translate(-10px , 10px);">Accede</h4>
                        </div>
                    </a>

                    <!-- Botón para el acceso a las rutinas -->
                    <a href="index.php#routines">
                        <div class="button sweep-to-left selector">
                            <a href="index.php#routines"><img alt="Acceso" src="Images/Botones/Routines.png" style="height: 70px; width: 70px; transform: translate(-16px , 0px) scale(110%);"></a>
                            <h4 style="transform: translate(-14px , -10px);">Rutinas</h4>
                        </div>
                    </a>

                    <!-- Botón para el acceso al contacto -->
                    <a href="contacto.php">
                        <div class="button sweep-to-left selector">
                            <img alt="Acceso" src="Images/Botones/Contant_Us.png" style="height: 55px; width: 55px; transform: translate(-16px , 10px);">
                            <h4 style="transform: translate(-14px , 5px);">Contacto</h4>
                        </div>
                    </a>
                </div>
                <div class="rightpane"> <!-- Añadimos el panel derecho dentro de nuestro contenedor -->
                    <h3 style="transform: translate(20px , 400px); color: white ">Inscribete y entrena con... </h3> <!-- Texto que se encontrará dentro del panel -->
                    <h1 style="transform: translate(20px , 350px);">Nosotros</h1>
                    <a href="Registrar.php"><button style="transform: translate(160px, 320px); font-size: 30px; padding: 15px;"><span>Registrate aquí</span></button></a> <!-- Botón que redirige al usuario para el registro en página web -->
                </div>
        </div>
        <div style="height:700px; width:100%; background-image: url(./Images/Fondos/Gym_4.jpg); background-size: cover; position:relative; top:729px; display:block;" >
            <a name="about_us"></a>
            <span style="display: flex;">
                <h4 style="transform: translate(600px , 70px);color: white">Bienvenido a</h4>
                <h1 style="transform: translate(450px , 80px); font-size:50px;">AICOFIT</h1>
            </span>
            <p style="color:white; width:700px; position:relative; left:585px; top:50px; font-size:18px; font-family: 'News Gothic';">
            En nuestro gimnasio, nos dedicamos a ayudar a nuestros clientes a alcanzar sus objetivos fitness. 
            Ofrecemos una amplia variedad de rutinas de gimnasio personalizadas para satisfacer las necesidades y objetivos únicos de cada cliente. 
            Además, cada uno de nuestros clientes recibe un entrenador personal dedicado que trabaja con ellos para ayudarles a alcanzar sus objetivos. 
            Nuestro objetivo es proporcionar un ambiente acogedor y motivador para ayudar a nuestros clientes a alcanzar su mejor versión.
            <br>
            <br>
            Además, nuestro gimnasio cuenta con una amplia variedad de equipos de alta calidad para garantizar que nuestros clientes tengan todo lo que necesitan para alcanzar sus objetivos. 
            También ofrecemos clases grupales y entrenamiento en circuito para aquellos que buscan una experiencia más social y motivadora.</p>
        </div>
        <div style="height:700px; width:100%; background-image: url(./Images/Fondos/Gym_5.jpg); background-size: 100% 900px; position:relative; top:729px; display:block; text-align:center" >
            <a name="sign_in"></a>
            <span style="position: relative; display:flex; top:500px">
                <h3 style="transform: translate(600px, -450px); color: white; font-size:30px;">ACCEDE</h3>
                <div>
                    <h3 style="transform: translate(-10px, -350px); color: white; font-size:24px;">CLIENTE</h3>
                    <form name="client_si" id="client_si" method="post" style="transform: translate(-10px, -320px);">
                        <label style="font-size:24px;" for="username">USUARIO:</label>
                        <br>
                        <input type="text" name="username" name="username" maxlength="25">
                        <br><br>
                        <label style="font-size:24px;" for="pass">CONTRASEÑA:</label>
                        <br>
                        <input type="password" name="password" id="pass">
                        <br><input type="hidden" name="type" value="client"><br>
                        <input type="submit"  value="Incia Sesión" name="client_si" style="transform: translate( 0px, 10px);">
                    </form>
                </div>
                <div>
                    <h3 style="transform: translate(300px, -350px); color: white; font-size:24px;">ENTRENADOR</h3>
                    <form name="trainer_si" id="trainer_si" method="post" style="transform: translate(300px, -320px);">
                        <label style="font-size:24px;" for="username">USUARIO:</label>
                        <br>
                        <input type="text" name="username" name="username" maxlength="25">
                        <br><br>
                        <label style="font-size:24px;" for="pass">CONTRASEÑA:</label>
                        <br>
                        <input type="password" name="password" id="pass">
                        <br><input type="hidden" name="type" value="trainer"><br>
                        <input type="submit"  value="Incia Sesión" name="trainer_si" style="transform: translate(0px, 10px);">
                    </form>
                </div>
            </span> 
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    if ($_POST['type'] === 'client')
                    {
                        $sql = $connection->prepare('SELECT * FROM users WHERE username = ?');
                        $sql->execute([$_POST['username']]);
                        $user = $sql->fetch();
                    }
                    else
                    {
                        $sql = $connection->prepare('SELECT * FROM trainers WHERE username = ?');
                        $sql->execute([$_POST['username']]);
                        $user = $sql->fetch();
                    }

                    if ($user && password_verify($_POST['password'], $user['password']))
                    {
                        header('Location: client_profile.php');
                        exit;
                    }
                    else
                    {
                        echo '<script>alert("El usuario o la contraseña son incorrectas");</script>';
                    }
                } 
            ?>               
        </div>
        <div style="height:700px; width:100%; background-image: url(./Images/Fondos/Gym_6.jpg); background-size: 100% 900px; position:relative; top:729px; display:block;">
            <a name="routines"></a>
            <span style="position: relative; display:flex; top:100px">
                <h3 style="transform: translate(600px, -80px); color: white; font-size:30px;">RUTINAS</h3>
                <table style="transform: translate(-120px, 100px);">
                    <tr>
                        <th>Piernas</th>
                        <th>Empujes</th>
                        <th>Trancciones</th>
                        <th>Core y Cardio</th>
                    </tr>
                    <tr>
                        <td>Sentadilla con barra: 4 x 6-8 reps</td>
                        <td>Press de banca: 3 x 8-10 reps</td>
                        <td>Dominadas: 3 x 8-10 reps</td>
                        <td>Plancha: 3 x 30 sec</td>
                    </tr>
                    <tr>
                        <td>Prensa baja: 4 x 10-12 reps</td>
                        <td>Flexiones: 3 x 10-12 reps</td>
                        <td>Jalón al pecho: 3 x 8-10 reps</td>
                        <td>Contracciones de abdomen: 3 x 10-12 reps</td>
                    </tr>
                    <tr>
                        <td>Zancada con macuerna: 3 x 10 reps</td>
                        <td>Press militar: 3 x 8-10 reps</td>
                        <td>Remo con barra inclinado: 3 x 8-10 reps</td>
                        <td>Giros rusos: 3 x 10-12 reps</td>
                    </tr>
                    <tr>
                        <td>Peso muerto rumano: 3 x 8-10 reps</td>
                        <td>Elevaciones laterales: 3 x 10-12 reps</td>
                        <td>Remo en máquina: 3 x 10-12 reps</td>
                        <td>Crunch de bicicleta: 3 x 10-12 reps</td>
                    </tr>
                    <tr>
                        <td>Curl de pierna sentado: 3 x 10-12 reps</td>
                        <td>Extensión de tríceps: 3 x 10-12 reps</td>
                        <td>Curl de bíceps: 3 x 10-12 reps</td>
                        <td>Saltos de tijera: 3 x 30 sec</td>
                    </tr>
                    <tr>
                        <td>Elevación de gemelos: 3 x 12-15 reps</td>
                        <td>Fondos de tríceps: 3 x 8-10 reps</td>
                        <td>Bíceps de martillo: 3 x 10-12 reps</td>
                        <td>Burpees: 3 x 10-12 reps</td>
                    </tr>
                </table>
            </span>
        </div>
        <div style="height:700px; width:100%; background-image: url(./Images/Fondos/Gym_6.jpg); background-size: 100% 900px; position:relative; top:729px; display:block;">
            <span style="position: relative; display:flex; top:100px;">
                <h3 style="transform: translate(580px, -80px); color: white; font-size:30px;">CONTACTO</h3>
                <img alt="telephone" src="Images/Botones/Telephone.png" style="height: 55px; width: 55px; transform: translate(100px , 60px);">
                <p style="color:white; transform: translate(120px , 45px); font-size:18px; font-family:'News Gothic'; width:500px;">Telefono de contacto: +34 675 464 238<p>
                <img alt="location" src="Images/Botones/Location.png" style="height: 65px; width: 35px; transform: translate(400px , -30px);">
                <p style="color:white; transform: translate(360px , -120px); font-size:18px; font-family:'News Gothic';">Dirección: C. Agustín Calvo, 49, 28043 Madrid<p>
                <img alt="Acceso" src="Images/Fondos/Address.jpg" style=" width:800px; height:400px; transform: translate(-20px , 200px); border-radius:8px;">
            </span>
        </div>
    </body>
</html>