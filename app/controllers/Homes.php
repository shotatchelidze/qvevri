<?php 
class Homes extends Controller{
    public function __construct()
    {
        // define language
        getLanguage();

        // $this->menuModel = $this->model('Menu');
        $this->imageBgModel = $this->model('ImageBg');
        $this->logoModel = $this->model('Logo');
        $this->sectionModel = $this->model('Section');
        $this->newsModel = $this->model('News_model');
        $this->descriptionModel = $this->model('Description');
    }

    public function index(){
        // $menu = $this->menuModel->getMenus();
        $imageBgs = $this->imageBgModel->getImageBg("home");
        $logos = $this->logoModel->getLogos("home");
        $menu_logo = $this->logoModel->getLogosForMenu();
        $sections = $this->sectionModel->getSections();
        $news = $this->newsModel->getNewsForHomes();
        $description = $this->descriptionModel->getDescription("home");
        
        $data = [
            // 'menu' => $menu,
            'menu_logo' => $menu_logo,
            'image_bgs' => $imageBgs,
            'logos' => $logos,
            'sections' => $sections,
            'news' => $news,
            'description' => $description
        ];
        


        // var_dump($data); die();
        $this->view('homes/index', $data);
    }

    public function sendEmail(){
        
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
        $request = filter_var(trim($_POST['requests']), FILTER_SANITIZE_STRING);
        
        if($name === '' or $email === '' or $phone === '' or $request === '' ){
           redirect('homes');
        }

        ini_set('sendmail_from','shotatest@yahoo.com');
        
        $to = "shotatest@yahoo.com";
        $subject = "My subject";
        $txt = "Name $name phone Number: $phone Request: $request";
        $headers = "From: $email" . "\r\n" .
        "CC: $email";

        if(mail($to,$subject,$txt,'From: shotatest@yahoo.com')){
            die('success');
        } else {
            die('unsuccess');
        }    

    }
}