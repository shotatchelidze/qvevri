<?php 
class Homes extends Controller{
    public function __construct()
    {
        // define language
        getLanguage();

        $this->menuModel = $this->model('Menu');
        $this->imageBgModel = $this->model('ImageBg');
        $this->logoModel = $this->model('Logo');
        $this->sectionModel = $this->model('Section');
        $this->newsModel = $this->model('News');
    }

    public function index(){
        $menu = $this->menuModel->getMenus();
        $imageBgs = $this->imageBgModel->getImageBg("home");
        $logos = $this->logoModel->getLogos('home');
        $sections = $this->sectionModel->getSections();
        $news = $this->newsModel->getNewsForHomes();
        
        $data = [
            'menu' => $menu,
            'imageBgs' => $imageBgs,
            'logos' => $logos,
            'sections' => $sections,
            'news' => $news
        ];


        // var_dump($data); die();
        $this->view('homes/index', $data);
    }
}