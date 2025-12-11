<?php

/**
 * Cloaker para detectar bots de Google y Facebook.
 * @return bool True si es un bot, False si es un usuario humano.
 */
function is_bot() {

    // --- 1. Comprobación por User-Agent ---
    // Lista de User-Agents conocidos de bots importantes.
    $bot_user_agents = [
        'googlebot',         // Googlebot
        'adsbot-google',     // Google Ads Bot
        'googlebot-image',   // Google Image Bot
        'facebookexternalhit', // Facebook Bot
        'facebot',           // Facebook Bot
        'bingbot',           // Bing Bot
        'slurp',             // Yahoo Bot
        'duckduckbot',       // DuckDuckGo Bot
        'twitterbot',        // Twitter Bot
    ];

    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
    foreach ($bot_user_agents as $bot) {
        if (strpos($user_agent, $bot) !== false) {
            // Opcional: Añadir una comprobación de IP para mayor seguridad.
            // return verify_bot_ip();
            return true; // Si solo confías en el User-Agent, devuelve true aquí.
        }
    }

    // --- 2. Comprobación por Dirección IP (Método más seguro) ---
    // Esta función es más compleja y requiere listas de IP actualizadas.
    // La implementamos a continuación.
    if (verify_bot_ip()) {
        return true;
    }

    // Si no coincide con nada, asumimos que es un humano.
    return false;
}

/**
 * Verifica si la IP del visitante pertenece a un rango de IP de Google o Facebook.
 * @return bool True si la IP es de un bot verificado.
 */
function verify_bot_ip() {
    $visitor_ip = $_SERVER['REMOTE_ADDR'];

    // --- Verificación de Googlebot ---
    // Hacemos una búsqueda DNS inversa para obtener el hostname.
    $hostname = gethostbyaddr($visitor_ip);
    // Comprobamos si el hostname termina en el dominio oficial de Google.
    if (preg_match('/\.googlebot\.com$/i', $hostname)) {
        // Ahora, hacemos una búsqueda DNS directa para verificar que el hostname
        // resuelve de vuelta a la IP original. Esto evita falsificaciones.
        $resolved_ip = gethostbyname($hostname);
        if ($resolved_ip === $visitor_ip) {
            return true; // Es un Googlebot verificado.
        }
    }

    // --- Verificación de Facebook Bot ---
    // Facebook no tiene un método de verificación DNS tan claro como Google.
    // La forma más fiable es comprobar si la IP está en sus rangos públicos.
    // NOTA: Esta lista de IPs puede cambiar. Deberías mantenerla actualizada.
    $facebook_ip_ranges = [
        '31.13.0.0/16',
        '45.64.40.0/22',
        '66.220.144.0/20',
        '69.63.176.0/20',
        '69.171.224.0/19',
        '74.119.76.0/22',
        '103.4.96.0/22',
        '157.240.0.0/16',
        '173.252.64.0/18',
        '179.60.192.0/22',
        '185.60.216.0/22',
        '204.15.20.0/22',
        '31.13.24.0/21',
        '31.13.64.0/18',
        '31.13.66.0/24',
        '31.13.70.0/24',
        '31.13.72.0/24',
        '31.13.76.0/24',
        '31.13.78.0/24',
        '31.13.80.0/24',
        '31.13.82.0/24',
        '31.13.84.0/24',
        '31.13.86.0/24',
        '31.13.88.0/24',
        '31.13.90.0/24',
        '31.13.92.0/24',
        '31.13.94.0/24',
        '31.13.96.0/24',
        '45.64.40.0/22',
        '66.220.144.0/20',
        '69.63.176.0/20',
        '69.171.224.0/19',
        '69.171.239.0/24',
        '69.171.240.0/20',
        '69.171.255.0/24',
        '74.119.76.0/22',
        '75.126.164.0/24',
        '103.4.96.0/22',
        '157.240.0.0/16',
        '173.252.64.0/18',
        '173.252.96.0/19',
        '173.252.120.0/24',
        '179.60.192.0/22',
        '179.60.192.0/24',
        '179.60.193.0/24',
        '179.60.194.0/24',
        '179.60.195.0/24',
        '185.60.216.0/22',
        '185.60.216.0/24',
        '185.60.217.0/24',
        '185.60.218.0/24',
        '185.60.219.0/24',
        '204.15.20.0/22',
        '2401:db00::/32',
        '2620:0:1c00::/48',
        '2a03:2880::/32',
        '2a03:2880:ff01::/48',
        '2a03:2880:ff02::/48',
        '2a03:2880:ff03::/48',
    ];

    // Función para verificar si una IP está en un rango CIDR
    function ip_in_range($ip, $range) {
        if (strpos($range, '/') == false) {
            $range .= '/32';
        }
        list($range, $netmask) = explode('/', $range, 2);
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~ $wildcard_decimal;
        return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
    }

    foreach ($facebook_ip_ranges as $range) {
        if (ip_in_range($visitor_ip, $range)) {
            return true; // Es un bot de Facebook.
        }
    }

    return false; // No se pudo verificar como bot oficial.
}

?>