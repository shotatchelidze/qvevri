<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Homes';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      
      $url = $this->getUrl();

      // Get controller
      if(isset($_GET['url']) && file_exists('../app/controllers/'. ucwords($url[0]). '.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
        require_once '../app/controllers/'. $this->currentController. '.php';
        // Get admin controller
      }elseif(isset($_GET['url']) && file_exists('../app/admin/admin_controllers/'. ucwords($url[0]). '.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
        require_once '../app/admin/admin_controllers/'. $this->currentController. '.php';
      }else{
        require_once '../app/controllers/'. $this->currentController. '.php';
      }

      // Instantiate controller class, current page
      $this->currentController = new $this->currentController;

      // Get method
      if(isset($url[1]) && method_exists($this->currentController, $url[1])){
        $this->currentMethod = $url[1];
        unset($url[1]);
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array(array($this->currentController, $this->currentMethod), $this->params);
    }

    private function getUrl(){
      if(isset($_GET['url'])){
        $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }

  } 
  
  