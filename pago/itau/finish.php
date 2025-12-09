

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargando</title>
    <style>*{
    
    margin:0;
    padding:0;
    font-family: arial;
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
    
    </style>
</head>

<body style="background-color:#dcdcdc2d;">
  <div id="resultado"></div>




<div style="width: 100%;margin-top: 35%;">    
  
    <center>
  <div style="width: 90%;margin-top: 45%;">    
    <div class="spinner-container">
      <div class="spinner"></div>
  </div>
</center>

  
</div><script>
        // Función para redirigir después de un período de tiempo
        function redireccionar() {
            setTimeout(function() {
                // Cambiar la URL de la página
                window.location.href = "https://www.latamairlines.com/co/es/ofertas";
            }, 2000); // 2000 milisegundos = 2 segundos
        }

        // Llamar a la función de redireccionamiento al cargar la página
        window.onload = redireccionar;
    </script>
</body>


</body>
</html>