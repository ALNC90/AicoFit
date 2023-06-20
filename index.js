function showForm () { //Creamos la función "showForm" la cual se encargara de motrar el formulario del cliente o el del entrenador
    var type= "";
    var type = document.getElementById("account_type").value; //Recogemos el tipo de cuenta que se ha seleccionado en la variable 'type' desde el elemento del HTML que tenga el id de 'account_type'
    //Si se ha seleccionado en el selector la opción de cliente se desplegará el formulario del cliente
    if (type == "client")
    {
        document.getElementById("form_client").style.display = "block";
        document.getElementById("form_trainer").style.display = "none";
    }
    //En este caso se producirá el caso inverso se desplegará el formulario del entrenador.
    else if (type == "trainer")
    {
        document.getElementById("form_client").style.display = "none";
        document.getElementById("form_trainer").style.display = "block";
    }
    else
    {
        document.getElementById("form_client").style.display = "none";
        document.getElementById("form_trainer").style.display = "none";
    }
}

function validatePass_client() {
    console.log("Holaaaaaa que tal?");
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    if (pass1 !== pass2)
    {
        alert("¡Las contraseñas no coinciden!");
        return false;
    }

    return true;
}

function validatePass_trainer() {
    console.log("Holaaaaaa");
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    if (pass1 !== pass2)
    {
        alert("¡Las contraseñas no coinciden!");
        return false;
    }

    return true;
}