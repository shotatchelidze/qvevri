<?php
class Homes extends Controller
{
  public function __construct()
  {
    // define language
    getLanguage();

    $this->logoModel = $this->model('Logo');
    $this->menuModel = $this->model('Menu');
    
  }

  public function index()
  {

    $logos = $this->logoModel->getLogos("home");
    

    $data = [
      'logos' => $logos
    ];


    $this->view('homes/index', $data);
  }
}
