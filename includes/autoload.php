<?php

spl_autoload_register('myAutoLoad');

function myAutoLoad($className)
{
  $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

  $path = (strpos($url, 'includes') !== false) ? '../controllers/' : './controllers/';

  $extension = '.controller.php';

  require_once($path . $className . $extension);
}