<?php
class Products extends Controller
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

    $products = $this->productModel->getProducts();
    $menu = $this->menuModel->getMenus();
    
    $data = [
      'products' => $products,
      'menu' => $menu
    ];
    // var_dump($data);die();
    
    $this->view('products/index', $data);
  }
}
