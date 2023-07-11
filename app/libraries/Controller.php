<?php

namespace App\Libraries;
/*
   * Base Controller
   * Loads the models and views
   */

class Controller
{
  // Load model
  public function model($model)
  {
    // Require model file
    if (file_exists('../app/models/' . $model . '.php')) {
      require_once '../app/models/' . $model . '.php';
      // Instatiate model
      $modelWithNamespace = 'App\\Models\\' . $model;
      return new $modelWithNamespace();
      } else {
      // Model does not exist
      die('Model does not exist');
    }
  }

  // Load view
  public function view($view, $data = [])
  {
    // Check for view file
    $filePath='../app/views/' . $view . '.php';
    if (file_exists($filePath)) {
      require_once '../app/views/' . $view . '.php';
    } else {
      echo 'Failed to load view: ' . $filePath; // Debug output

      // View does not exist
      die('View does not exist');
    }
  }  
}
