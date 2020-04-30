<?php 
class Index_admins extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect_admin('admins');
        }

        $this->logoAdminModel = $this->model('Logo_admin');
    }

    public function index(){
        $logos = $this->logoAdminModel->getLogoForIndex();

        $data = [
            'logos' => $logos
        ];

        $this->view('index_admins/index',$data);
    }

    public function addLogo(){
         // check for posts
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'img_name' => $_FILES['image']['name'],
                'en_title' => trim($_POST['en_title']),
                'en_subtitle' => trim($_POST['en_subtitle']),
                'ge_title' => trim($_POST['ge_title']),
                'ge_subtitle' => trim($_POST['ge_subtitle']),
                'ru_title' => trim($_POST['ru_title']),
                'ru_subtitle' => trim($_POST['ru_subtitle']),
                'page' => $_POST['page']
            ];

            $image = add_image("1200");

            if($image === true){
                if($this->logoAdminModel->addLogo($data)){
                    flash('logo_added_success','Logo Added Successfuly');
                    redirect_admin('Index_admins');
                } else {
                    flash('logo_added_fail','Fail Add Logo', 'alert alert-danger');
                    redirect_admin('Index_admins');
                }
            // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Index_admins/AddLogo', $data);
            }
        // Get      
        } else {
            
            $this->view('Index_admins/addLogo');
        }
    }
}