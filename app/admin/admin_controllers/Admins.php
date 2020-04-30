<?php 
class Admins extends Controller{
    public function __construct(){
        $this->adminModel = $this->model('admin');
    }

    // Login page
    public function index(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password'=> trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
                    // Check for admin/email
            } elseif(!$this->adminModel->findAdminByEmail($data['email'])){
                $data['email_err'] = 'Email is incorrect';
            }
            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }
            
            // Make sure errors empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                $loggedInAdmin = $this->adminModel->login($data['email'], $data['password']);
                // Validated
                // Check and set logged in user
                if($loggedInAdmin){
                    // Create session
                    $this->createAdminSession($loggedInAdmin);
                    // if incoreect password
                } else {
                    $data['password_err'] = 'Password Incorrect';
                    // Load view with errors
                    $this->view('admins/index',$data);
                }
            } else {
                // Load view with errors
                $this->view('admins/index', $data);
            }


        } else {
            // Init data
            $data = [
                'email' => '',
                'password'=> '',
                'email_err' => '',
                'password_err' => ''
            ];
            // Load view
            $this->view('admins/index', $data);
        }
    }



    public function createAdminSession($admin){
        $_SESSION['admin_email'] = $admin->email;
        redirect_admin('menu_admins');
    }

    public function logout(){
        unset($_SESSION['admin_email']);
        session_destroy();
        redirect_admin('admins');
    }


}