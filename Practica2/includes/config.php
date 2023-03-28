<?php

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
define('BD_NAME', 'zeus_airsoft');
define('BD_USER', 'root');
define('BD_PASS', '');

/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

spl_autoload_register(function ($class) {

  $prefix = 'es\\ucm\\fdi\\aw\\';
  $base_dir = __DIR__ . '/';
  $len = strlen($prefix);

  if (strncmp($prefix, $class, $len) !== 0)
  {
    return;
  }
  
  // get the relative class name
  $relative_class = substr($class, $len);
  
  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
  // if the file exists, require it
  if (file_exists($file)) {
      require $file;
  }
});

// Inicializa la aplicación
$app = es\ucm\fdi\aw\Application::getSingleton();
$app->init(array('host'=>BD_HOST, 'name'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

/**
 * @see http://php.net/manual/en/function.register-shutdown-function.php
 * @see http://php.net/manual/en/language.types.callable.php
 */
register_shutdown_function(array($app, 'shutdown'));
?>