<?php
class News extends Controller
{
  public function __construct()
  {
    // define language
    getLanguage();

    $this->productModel = $this->model('Product');
    $this->menuModel = $this->model('Menu');
    
  }

  public function index()
  {
    
    $data = [
      
    ];
    
    $this->view('products/index', $data);
  }
}
