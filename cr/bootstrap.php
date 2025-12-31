<?php
// cloaker/bootstrap.php
// Este fichero se ejecutará al principio de CADA petición a una página PHP.

// Cargar la configuración y la clase del cloaker
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/cr.php';

// Inicializar el cloaker
$config = require __DIR__ . '/config.php';
$cloaker = new Cloaker($config);

// Ejecutar la lógica del cloaker
// Si es un bot, mostrará content_b.php y detendrá la ejecución.
// Si es un usuario real, no hará nada y permitirá que se cargue la página solicitada (about.php, etc.).
$cloaker->serve();