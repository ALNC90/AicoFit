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
            height: 730px;
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
    </style>
    <body>
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
                    <a href="index.php">
                        <div class="button sweep-to-left selector">
                            <a href="nosotros.php"><img alt="Sobre_nosotros" src="Images/Botones/About_us.png" style="height: 45px; width: 55px; transform: translate(-11px , 15px) "></a>
                            <h4 style="transform: translate(-10px , 20px);">Sobre Nosotros</h4>
                        </div>
                    </a>

                    <!-- Botón para el acceso con nuestro usuario a la página web -->
                    <a href="acceder.php">
                        <div class="button sweep-to-left selector">
                            <img alt="Acceso" src="Images/Botones/Sing_in.png" style="height: 55px; width: 55px; transform: translate(-14px , 10px); scale(110%);">
                            <h4 style="transform: translate(-10px , 10px);">Accede</h4>
                        </div>
                    </a>

                    <!-- Botón para el acceso a las rutinas -->
                    <a href="rutinas.php">
                        <div class="button sweep-to-left selector">
                            <img alt="Acceso" src="Images/Botones/Routines.png" style="height: 70px; width: 70px; transform: translate(-16px , 0px) scale(110%);">
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
    </body>
</html>