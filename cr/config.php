<?php
// cloaker/config.php

return [
    // Tiempo en segundos para considerar una IP válida (cache).
    // 86400 = 24 horas.
    'ip_cache_ttl' => 86400, 

    // Nombre de la cookie que usaremos para el comportamiento.
    'lv' => 'real_user_verification',

    // Tiempo de vida de la cookie en segundos (30 días).
    'cookie_ttl' => 2592000,

    // Ruta a los ficheros de IP desde la raíz del proyecto.
    'ip_lists_path' => __DIR__ . '/ip-lists/',

    // Lista de User-Agents a bloquear o tratar como bot.
    // Añade aquí los bots publicitarios, de análisis, etc.
    'blocked_user_agents' => [
        'adsbot-google',
        'googlebot',
        'mediapartners-google',
        'bingbot',
        'slurp', // Yahoo
        'duckduckbot',
        'baiduspider',
        'yandexbot',
        'facebookexternalhit',
        'Facebot',
        'MetaInspector',
        'twitterbot',
        'rogerbot', // Moz
        'semrushbot',
    ],
];