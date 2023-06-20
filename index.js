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

function validatePassClient() {
    var cpass1 = document.getElementById("pass1_c").value;
    var cpass2 = document.getElementById("pass2_c").value;

    if (cpass1 !== cpass2)
    {
        alert("¡Las contraseñas no coinciden!");
        return false;
    }

    return true;
}

function validatePassTrainer() {
    var tpass1 = document.getElementById("pass1_t").value;
    var tpass2 = document.getElementById("pass2_t").value;

    if (tpass1 !== tpass2)
    {
        alert("¡Las contraseñas no coinciden!");
        return false;
    }

    return true;
}