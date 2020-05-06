<?php
class Logo_admins extends Controller
{

    public function __construct()
    {

        if (!isLoggedIn()) {
            redirect_admin('admins');
        }

        $this->logoAdminModel = $this->model('Logo_admin');
    }

    public function index()
    {
        $logos = $this->logoAdminModel->getLogos();

        $data = [
            'logos' => $logos
        ];

        $this->view('logo_admins/index', $data);
    }

    public function addLogo()
    {

        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
            $image_error = [
                'img_fake_err' => '',
                'img_exist_err' => '',
                'img_ext_err' => ''
            ];

            if (!empty($_POST['image']['img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");

                if(!$image === true){
                    $image_error['img_fake_err'] = $image['img_fake_err'];
                    $image_error['img_exist_err'] = $image['img_exist_err'];
                    $image_error['img_ext_err'] = $image['img_ext_err'];
                }
            }
            // if emty image_ error
            if (!array_filter($image_error)) {
                if ($this->logoAdminModel->addLogo($data)) {
                    flash('logo_added_success', 'Logo Added Successfuly');
                    redirect_admin('Logo_admins/addLogo');
                } else {
                    flash('logo_added_fail', 'Fail Add Logo', 'alert alert-danger');
                    redirect_admin('Logo_admins/addLogo');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Logo_admins/AddLogo', $data);
            }
            // Get      
        } else {

            $data = [
                'img_name' => '',
                'en_title' => '',
                'en_subtitle' => '',
                'ge_title' => '',
                'ge_subtitle' => '',
                'ru_title' => '',
                'ru_subtitle' => '',
                'page' => ''
            ];

            $this->view('Logo_admins/addLogo', $data);
        }
    }

    public function editLogo($id)
    {
        // Check id is actual number
        if (!is_numeric($id)) {
            redirect_admin('Section_admins');
        }

        // check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'img_name' => $_FILES['image']['name'],
                'en_title' => trim($_POST['en_title']),
                'en_subtitle' => trim($_POST['en_subtitle']),
                'ge_title' => trim($_POST['ge_title']),
                'ge_subtitle' => trim($_POST['ge_subtitle']),
                'ru_title' => trim($_POST['ru_title']),
                'ru_subtitle' => trim($_POST['ru_subtitle']),
                'page' => $_POST['page']
            ];
            $image_error = [
                'img_fake_err' => '',
                'img_exist_err' => '',
                'img_ext_err' => ''
            ];

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // First, delete existing image from folder
            // Get existing image name from DB
            $image_name_obj = $this->logoAdminModel->getLogoImageNameById($id);
            // Check id is correct or not
            if ($image_name_obj === false) {
                die('images does not exist reload page');
            }
            // Check image empty or not
            if ($image_name_obj->img_name !== '') {
                $image_name = $target_dir . $image_name_obj->img_name;
                if (file_exists($image_name)) {
                    if (!(unlink($image_name))) {
                        die('Something went wrong reload page');
                    }
                } else {
                    die('image does not exist');
                }
            }
            
            if (!empty($_POST['image']['img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");

                if(!$image === true){
                    $image_error['img_fake_err'] = $image['img_fake_err'];
                    $image_error['img_exist_err'] = $image['img_exist_err'];
                    $image_error['img_ext_err'] = $image['img_ext_err'];
                }
            }
            // if empty image_error
            if (!array_filter($image_error)) {
                if ($this->logoAdminModel->editLogo($data)) {
                    flash('logo_added_success', 'Logo Updated Successfuly');
                    redirect_admin('Logo_admins/editLogo', $id);
                } else {
                    flash('logo_added_fail', 'Fail Update Logo', 'alert alert-danger');
                    redirect_admin('Logo_admins/editLogo', $id);
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Logo_admins/editLogo', $data);
            }
            // Get request    
        } else {
            // Get exist logo from model
            $logo = $this->logoAdminModel->getLogoById($id);
            // If logo does not exist
            if ($logo === false) {
                die('Something went wrong reload page and try again');
            }

            $data = [
                'id' => $id,
                'img_name' => $logo->img_name ?? '',
                'en_title' => $logo->en_title ?? '',
                'en_subtitle' => $logo->en_subtitle ?? '',
                'ge_title' => $logo->ge_title ?? '',
                'ge_subtitle' => $logo->ge_subtitle ?? '',
                'ru_title' => $logo->ru_title ?? '',
                'ru_subtitle' => $logo->ru_subtitle ?? '',
                'page' => $logo->page ?? ''
            ];

            $this->view('Logo_admins/editLogo', $data);
        }
    }

    public function deleteLogo($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image_path = $target_dir . $_POST['delete_image'];
            if (file_exists($image_path)) {
                if (!unlink($image_path)) {
                    die('Something went wrong refresh page and try again');
                }
            } else {
                flash('image_delete_fail', 'logo does not exist', 'alert alert-danger');
                redirect_admin('Logo_admins');
            }

            if ($this->logoAdminModel->deleteLogo($id)) {
                flash('image_deleted', 'logo successfuly deleted');
                redirect_admin('Logo_admins');
            } else {
                flash('image_delete_fail', 'logo did not deleted', 'alert alert-danger');
                redirect_admin('Logo_admins');
            }
        }
    }
}
