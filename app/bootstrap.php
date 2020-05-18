<?php
  // Load Config
  require_once 'config/config.php';

  // Load helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/language_helper.php';
  require_once 'helpers/add_image_helper.php';
  require_once 'helpers/date_helper.php';
  require_once 'helpers/pagination_helper.php';

 

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
