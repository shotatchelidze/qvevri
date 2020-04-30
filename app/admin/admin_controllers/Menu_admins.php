<?php 
class Menu_admins extends Controller {
    
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect_admin('admins');
        }
        
        $this->menuAdminModel = $this->model('Menu_admin');
        $this->logoAdminModel = $this->model('Logo_admin');
    }

    public function index(){
        $menu = $this->menuAdminModel->getMenu();
        $logo = $this->logoAdminModel->getLogo();
        
        $data = [
           'menu' => $menu,
           'logo' => $logo
        ];
            
        $this->view('menu_admins/index', $data);    
        
    }

    public function changeMenu(){
        // Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Array in array
            $data = [
                'id' => $_POST['id'],
                'en_title' => array_map('trim', $_POST['en_title']),
                'ge_title' => array_map('trim', $_POST['ge_title']),
                'ru_title' => array_map('trim', $_POST['ru_title'])
            ];
            // try update menu
            if($this->menuAdminModel->updateMenu($data)){
                flash('changed_success','changed successfully');
                redirect('menu_admins');
            }else{
                flash('changed_fail','Did not changed','alert alert-danger');
                redirect('menu_admins');
            }
        }  
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
                    redirect('Menu_admins');
                } else {
                    flash('logo_added_fail','Fail Add Logo', 'alert alert-danger');
                    redirect('Menu_admins');
                }
            // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Menu_admins/AddLogo', $data);
            }
        // Get      
        } else {
            $this->view('Menu_admins/addLogo');
        }
    }

    public function updateLogo(){
        
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

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image_name = $target_dir . $data['img_name'];
            if(file_exists($image_name)){
                if(unlink($image_name)){
                // if did not deleted logo from folder    
                } else {
                    die('Something went wrong, refresh page and try again');
                }
            } 

            $image = add_image("1200");

            if($image === true){
                if($this->logoAdminModel->addLogo($data)){
                    flash('logo_added_success','Logo Added Successfuly');
                    redirect('Menu_admins');
                } else {
                    flash('logo_added_fail','Fail Add Logo', 'alert alert-danger');
                    redirect('Menu_admins');
                }
            // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Menu_admins/AddLogo', $data);
            }
        // Get request    
        } else {

        }    
    }

    public function deleteLogo($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image_name = $target_dir.$_POST['delete_image'];
            if(file_exists($image_name)){
                if(unlink($image_name)){
                // If did not deletid    
                } else {
                    die('Something went wrong refresh page and try again');
                }
            } else {
                flash('image_delete_fail','logo does not exist','alert alert-danger');
                redirect_admin('Menu_admins');
            }

            if($this->logoAdminModel->deleteLogo($id)){
                flash('image_deleted','logo successfuly deleted');
                redirect('Menu_admins');
            } else {
                flash('image_delete_fail','logo did not deleted','alert alert-danger');
                redirect_admin('Menu_admins');
            }
        }
        
    }

    public function changePassword(){
        // Check for posts
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'current_pass' => trim($_POST['current_pass']),
                'new_pass' => trim($_POST['new_pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),
                'current_pass_err' => '',
                'new_pass_err' => '',
                'confirm_pass_err' => ''
            ];

            if(empty($data['current_pass'])){
                $data['current_pass_err'] = 'Please enter current password';
            }

            if(empty($data['new_pass'])){
                $data['new_pass_err'] = 'Please enter new password';
            }
            // validate confirm password
            if(empty($data['confirm_pass'])){
                $data['confirm_pass_err'] = 'Please enter confirm password';
            } elseif($data['new_pass'] != $data['confirm_pass']) {
                $data['confirm_pass_err'] = 'Passwords do not match';
            }
            // Make sure no errors
            if(empty($data['current_pass_err']) && empty($data['new_pass_err']) && empty($data['confirm_pass_err'])){
                // hash password
                $data['new_pass'] = password_hash($data['new_pass'], PASSWORD_DEFAULT);
                // Try update password
                if($this->adminMainModel->updateAdminPassword($data)){
                    flash('update_pass_success','password changed successfully');
                    redirect_admin('Menu_admins/changePassword');
                // If password did not updated    
                } else {
                    flash('update_pass_fail','Password did not changed', 'alert alert-danger');
                    redirect_admin('Menu_admins/changePassword');
                }
            // Load view with errors    
            } else {
                $this->view('Menu_admins/changePassword', $data);
            }
        // if get request
        } else {
            $data = [
                'current_pass' => '',
                'new_pass' => '',
                'confirm_pass' => '',
                'current_pass_err' => '',
                'new_pass_err' => '',
                'confirm_pass_err' => ''
            ];
            $this->view('Menu_admins/changePassword', $data);
        }
    }
}