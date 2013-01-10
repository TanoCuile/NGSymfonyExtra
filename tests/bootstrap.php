<?php

$vendorDir = __DIR__ . '/../../..';

if (file_exists($file = $vendorDir . '/autoload.php')) {
  require_once $file;
}
else if (file_exists($file = './vendor/autoload.php')) {
  require_once $file;
}
else {
  die(
    "Not found composer autoload\n"
  );
}