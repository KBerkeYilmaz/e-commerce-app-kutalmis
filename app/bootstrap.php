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
use App\Libraries\Router;
require_once 'config/config.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Router.php';
require_once 'libraries/Database.php';
require_once 'config/config.php';

// spl_autoload_register(function ($className) {
//   $filePath = __DIR__ . '/' . str_replace('App\\', '', str_replace('\\', '/', $className)) . '.php';
//   if (file_exists($filePath)) {
//       require_once $filePath;
//   }
// });

define('ROOT_DIR', __DIR__);


// spl_autoload_register(function ($className) {
//   // Replace namespace separator with directory separator
//   $filePath = str_replace('\\', '/', $className);

//   // Append '.php' and prepend the base directory
//   $filePath = __DIR__ . '/' . $filePath . '.php';

//   if (file_exists($filePath)) {
//       require_once $filePath;
//   } else {
//       // If the file doesn't exist, print a debug message
//       echo "Autoloader error: File '$filePath' not found for class '$className'.";
//   }
// });

spl_autoload_register(function ($className) {
  $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
  // split the class name at the namespace separator to read the namespace and class separately
  $class = explode(DIRECTORY_SEPARATOR, $className);
  // change the case of each item in the array except last one which is the filename
  array_walk($class, function (&$item, $key) use ($class) {
    if ($key !== count($class) - 1) {
      $item = strtolower($item);
    }
  });
  // join them back together
  $filePath = implode(DIRECTORY_SEPARATOR, $class) . ".php";
  // prepend the base directory path, consider 'app' directory only once.
  $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $filePath;

  if (file_exists($filePath)) {
    require_once $filePath;
  } else {
    echo "Autoloader error: File '$filePath' not found for class '$className'.<br />";
  }
});

