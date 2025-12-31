<?php

class Cloaker
{
    private array $config;
    private string $ipListCacheFile;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->ipListCacheFile = sys_get_temp_dir() . '/cloaker_ip_cache.json';
    }

    /**
     * Comprueba si el visitante debe ver el contenido para bots (Contenido B).
     * Devuelve true si es un bot, false si es un usuario real.
     */
    public function isBot(): bool
    {
        // 1. Comprobación de User-Agent (rápida y descartatoria)
        if ($this->isBlockedByUserAgent()) {
            return true;
        }

        // 2. Comprobación de IP (la más fiable para motores de búsqueda)
        if ($this->isKnownBotByIp()) {
            return true;
        }

        // 3. Comprobación de Comportamiento (la más potente)
        // Si no es un bot conocido, pero tampoco ha pasado la prueba de JS, lo tratamos como bot.
        if (!$this->hasBehavioralProof()) {
            return true;
        }

        // Si pasa todas las comprobaciones, es un usuario real.
        return false;
    }

    private function hasBehavioralProof(): bool
    {
        // Si la cookie de verificación existe, es un usuario real que ha pasado la prueba JS.
        if (isset($_COOKIE[$this->config['lv']])) {
            return true;
        }
        return false;
    }

    /**
     * Muestra el contenido adecuado y detiene la ejecución.
     */
    public function serve(): void
    {
        if ($this->isBot()) {
            // Mostrar contenido para Bots
            require_once __DIR__ . '/default.php';
            exit;
        }
           
        $this->setBehavioralCookie();
    }

    // Nuevo método para establecer la cookie
private function setBehavioralCookie(): void
{
    if (!isset($_COOKIE[$this->config['lv']])) {
        // Establecer la cookie para la próxima vez que visite.
        // La cookie se establecerá cuando el usuario vea la página real (content_a.php o about.php)
        setcookie(
            $this->config['lv'], 
            'verified', 
            time() + $this->config['cookie_ttl'], 
            '/' // Disponible en todo el dominio
        );
    }
}

    // --- MÉTODOS PRIVADOS DE DETECCIÓN ---

    private function isBlockedByUserAgent(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        foreach ($this->config['blocked_user_agents'] as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }
        return false;
    }

    private function isKnownBotByIp(): bool
    {
        $ip = $this->getVisitorIp();
        if (!$ip) {
            return false;
        }

        $ipLists = $this->getIpLists();

        // Comprobar si la IP está en alguno de los rangos de las listas
        foreach ($ipLists as $botName => $ipData) {
            if ($this->ipInRange($ip, $ipData['ranges'])) {
                return true;
            }
        }

        return false;
    }


    // --- MÉTODOS AUXILIARES Y DE CACHÉ ---

    private function getVisitorIp(): ?string
    {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'];
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ips = explode(',', $_SERVER[$key]);
                $ip = trim($ips[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        return null;
    }

    /**
     * Obtiene las listas de IPs desde un fichero de caché o las regenera desde los ficheros de texto.
     */
    private function getIpLists(): array
    {
        // Comprobar caché
        if (file_exists($this->ipListCacheFile) && (time() - filemtime($this->ipListCacheFile)) < $this->config['ip_cache_ttl']) {
            return json_decode(file_get_contents($this->ipListCacheFile), true);
        }

        // Si no hay caché válida, regenerar las listas
        $ipLists = [];
        $listFiles = glob($this->config['ip_lists_path'] . '*.txt');

        foreach ($listFiles as $file) {
            $botName = basename($file, '.txt');
            $ipData = file_get_contents($file);
            // Filtrar líneas que no son IPs (comentarios, vacías)
            $ipRanges = array_filter(explode("\n", $ipData), function($line) {
                $line = trim($line);
                return !empty($line) && strpos($line, '#') !== 0;
            });

            if (!empty($ipRanges)) {
                $ipLists[$botName] = [
                    'name' => ucfirst($botName),
                    'ranges' => array_values($ipRanges) // Re-indexar array
                ];
            }
        }

        // Guardar en caché para futuras peticiones
        file_put_contents($this->ipListCacheFile, json_encode($ipLists));
        return $ipLists;
    }

    /**
     * Comprueba si una IP dada está dentro de un array de rangos de IP (CIDR).
     */
    private function ipInRange(string $ip, array $ranges): bool
    {
        foreach ($ranges as $range) {
            if (strpos($range, '/') === false) {
                // Es una IP única
                if ($ip === trim($range)) {
                    return true;
                }
            } else {
                // Es un rango CIDR (ej. 192.168.1.0/24)
                list($subnet, $mask) = explode('/', trim($range));
                if ((ip2long($ip) & ~((1 << (32 - $mask)) - 1)) == ip2long($subnet)) {
                    return true;
                }
            }
        }
        return false;
    }
}