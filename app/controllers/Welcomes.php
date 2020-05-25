<?php
class Welcomes extends Controller
{
  public function __construct()
  {
    // define language
    getLanguage();

    $this->logoModel = $this->model('Logo');
    $this->imageBgModel = $this->model('ImageBg');
  }

  public function index()
  {
    $logos = $this->logoModel->getLogos("welcome");
    $image_bg = $this->imageBgModel->getImageBg("welcome");
    
    $data = [
      'logos' => $logos,
      'image_bgs' => $image_bg
    ];

    $this->view('Welcomes/index', $data);
  }
}
