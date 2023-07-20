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
      $newModel = 'App\\Models\\' . $model;
      return new $newModel();
      } else {
      // Model does not exist
      die('Model does not exist');
    }
  }
}
