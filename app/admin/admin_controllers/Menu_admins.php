<?php 
class Menu_admins extends Controller {
    
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect_admin('admins');
        }
        getAdminLanguage();
        getLanguage();

        $this->menuAdminModel = $this->model('Menu_admin');
    }

    public function index(){
        // ენა რადგან არის კონსტანტა გადაცემის მაგივრად პირდაპირ query ში ვწერ
        $menu = $this->menuAdminModel->getMenu();

        $data = [
           'menu' => $menu
        ];
            
        $this->view('menu_admins/index', $data);    
        
    }

    public function changeMenu(){
        
        // Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $_POST['id'],
                'title' => array_map('trim',$_POST['title'])
            ];
                    
            // try update menu
            if($this->menuAdminModel->updateMenu($data)){
                flash('changed_success','changed successfully');
                redirect_admin('menu_admins');
            }else{
                flash('changed_fail','Did not changed','alert alert-danger');
                redirect_admin('menu_admins');
            }
        }  
    }
    // Admin Password
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