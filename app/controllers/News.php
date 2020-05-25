<?php
class News extends Controller
{
  public function __construct()
      {
    // define language
    getLanguage();
    getAdminLanguage();
    
    $this->newsModel = $this->model('News_model');
    $this->logoModel = $this->model('Logo');
    $this->imageBgModel = $this->model('ImageBg');
    // $this->menuModel = $this->model('Menu');
    
  }

  public function index()
  {
    $pagination_result = pagination("news");
    $this_page_first_result = $pagination_result['this_page_first_result'];
    $results_per_page = $pagination_result['results_per_page'];
    $number_of_pages = $pagination_result['number_of_pages'];

    $menu_logo = $this->logoModel->getLogosForMenu();
    $news = $this->newsModel->getNews($this_page_first_result, $results_per_page);
    $logo = $this->logoModel->getLogos("news");
    
    $data = [
      'menu_logo' => $menu_logo,
      'news' => $news,
      'number_of_pages' => $number_of_pages,
      'logo' => $logo
    ];

    $this->view('news/index', $data);
  }

  public function singleNews($item_id){
    
    $item_id = filter_var($item_id,FILTER_SANITIZE_NUMBER_INT);
    if($item_id === ''){
      redirect('news');
    }

    $single_news = $this->newsModel->getSingleNews($item_id);
    // თუ გადაცემული აიდით არ არსებობს ჩანაწერი დაბრუნდეს news_ის გვერძე
    if($single_news === false){
      redirect('news');
    }

    $imageBgs = $this->imageBgModel->getImageBg("singleNews");
    $logo = $this->logoModel->getSingleLogo("news");
    $menu_logo = $this->logoModel->getLogosForMenu();


    $data = [
      'menu_logo' => $menu_logo,
      'single_news' => $single_news,
      'imageBgs' => $imageBgs,
      'logo' => $logo
    ];
    
    $this->view('news/singleNews', $data);

  }
}
