<?php
class Section_admins extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }

        $this->sectionAdminModel = $this->model('Section_admin');
    }

    public function index()
    {
        // $sections = $this->sectionAdminModel->getSections();

        $this->view('Section_admins/index');
    }

    public function addSection()
    {
        // Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'img_name' => $_FILES['image']['name'],
                'bg_img_name' => $_FILES['bg_image']['name'],
                'icon_img_name' => $_FILES['icon']['name'],
                'en_title' => trim($_POST['en_title']),
                'en_text' => trim($_POST['en_text']),
                'ge_title' => trim($_POST['ge_title']),
                'ge_text' => trim($_POST['ge_text']),
                'ru_title' => trim($_POST['ru_title']),
                'ru_text' => trim($_POST['ru_text'])
            ];

            $data_err = [
                'img_fake_err' => '',
                'img_exist_err' => '',
                'img_ext_err' => '',

                'icon_fake_err' => '',
                'icon_exist_err' => '',
                'icon_ext_err' => '',

                'bg_image_fake_err' => '',
                'bg_image_exist_err' => '',
                'bg_image_ext_err' => ''
            ];
            
            // Image Folder path
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // Check if image is not empty
            if (!empty($data['img_name'])) {
                // Image
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
                // If image error exist
                if ($image !== true) {

                    $data_err['img_fake_err'] = $image['img_fake_err'];
                    $data_err['img_exist_err'] = $image['img_exist_err'];
                    $data_err['img_ext_err'] = $image['img_ext_err'];
                }
            }
            // Check if icon is not empty
            if (!empty($data['icon_img_name'])) {
                // Icon
                $target_file = $target_dir . basename($_FILES["icon"]["name"]);
                $temp_name = $_FILES['icon']['tmp_name'];
                $icon = add_image($target_file, $temp_name, "1200");
                // If icon error exist
                if ($icon !== true) {
                    $data_err['icon_fake_err'] = $icon['img_fake_err'];
                    $data_err['icon_exist_err'] = $icon['img_exist_err'];
                    $data_err['icon_ext_err'] = $icon['img_ext_err'];
                }
            }
            // Check if background image is not empty
            if (!empty($data['bg_img_name'])) {
                // Background image
                $target_file = $target_dir . basename($_FILES["bg_image"]["name"]);
                $temp_name = $_FILES['bg_image']['tmp_name'];
                $bg_image = add_image($target_file, $temp_name, "1200");
                // if background image error exist
                if ($bg_image !== true) {
                    $data_err['bg_image_fake_err'] = $bg_image['img_fake_err'];
                    $data_err['bg_image_exist_err'] = $bg_image['img_exist_err'];
                    $data_err['bg_image_ext_err'] = $bg_image['img_ext_err'];
                }
            }

            // if no error 
            if (!array_filter($data_err)) {
                // Try add
                if ($this->sectionAdminModel->addSection($data)) {
                    flash('Section_added_success', 'Section  Added Successfuly');
                    redirect_admin('Section_admins/addSection');
                } else {
                    flash('Section_added_fail', 'Fail Add Section', 'alert alert-danger');
                    redirect_admin('Section_admins/addSection');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $data_err);

                $this->view('Section_admins/addSection', $data);
            }
            // Get Request     
        } else {
            $data = [
                'img_name' => '',
                'bg_img_name' => '',
                'icon_img_name' => '',
                'en_title' => '',
                'en_text' => '',
                'ge_title' => '',
                'ge_text' => '',
                'ru_title' => '',
                'ru_text' => ''
            ];

            $this->view('Section_admins/addSection', $data);
        }
    }
}
