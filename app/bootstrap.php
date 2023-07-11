<?php
  // Load Config
  // require_once 'config/config.php';

  // // Autoload Core Libraries
  // spl_autoload_register(function($className){
  //   require_once 'libraries/' . $className . '.php';
  // });
  
//   spl_autoload_register(function ($className) {
//     $filePath = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
//     if (file_exists($filePath)) {
//         require_once $filePath;
//     }
// });
// Load Config
use App\Libraries\Core;

require_once 'config/config.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';
require_once 'config/config.php';

spl_autoload_register(function ($className) {
  $filePath = __DIR__ . '/' . str_replace('App\\', '', str_replace('\\', '/', $className)) . '.php';
  if (file_exists($filePath)) {
      require_once $filePath;
  }
});


