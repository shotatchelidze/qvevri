<?php

  class Homes extends Controller {
    public function __construct(){
      // define language
      getLanguage();
      $this->sectionModel = $this->model('Section');
      $this->mainModel = $this->model('Main');
    }
    
    public function index(){
      $menu = $this->mainModel->getMenu();

      $data = [
        'menu' => $menu
      ];  
      
      $this->view('homes/index', $data);
    }

    
    
  }