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
        $sections = $this->sectionAdminModel->getSections();

        $data = [
            'sections' => $sections
        ];

        $this->view('Section_admins/index', $data);
    }
    // Add
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

    // Edit
    public function editSection($id)
    {
        // Check id is actual number
        if (!is_numeric($id)) {
            redirect_admin('Section_admins');
        }

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
            // First, delete existing image from folder
            // Get existing images name from DB
            $image_name_obj = $this->sectionAdminModel->getSectionImageNamesById($id);
            // Check id is correct or not
            if ($image_name_obj === false) {
                die('images does not exist reload page delete section');
            }
            // Check images empty or not
            if ($image_name_obj->img_name !== '') {
                $image_name = $target_dir . $image_name_obj->img_name;
                if (file_exists($image_name)) {
                    if (!(unlink($image_name))) {
                        die('Something went wrong reload page');
                    }
                }else {die('image does not exist');}
            }
            if ($image_name_obj->bg_img_name !== '') {
                $bg_img_name = $target_dir . $image_name_obj->bg_img_name;
                if (file_exists($bg_img_name)) {
                    if (!(unlink($bg_img_name))) {
                        die('Something went wrong reload page');
                    }
                }else {die('image does not exist');}
            }
            if ($image_name_obj->icon_img_name !== '') {
                $icon_img_name = $target_dir . $image_name_obj->icon_img_name;
                if (file_exists($icon_img_name)) {
                    if (!(unlink($icon_img_name))) {
                        die('Something went wrong reload page');
                    }
                }else {die('image does not exist');}
            }
            // Check if set image
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
            // Check if set icon
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
            // Check if set background image 
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
            // Chech errors 
            if (!array_filter($data_err)) {
                // Try add
                if ($this->sectionAdminModel->editSection($data)) {
                    flash('Section_updated_success', 'Section  Updated Successfuly');
                    redirect_admin('Section_admins/editSection', $id);
                } else {
                    flash('Section_updated_fail', 'Fail update Section', 'alert alert-danger');
                    redirect_admin('Section_admins/editSection', $id);
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $data_err);

                $this->view('Section_admins/editSection', $data);
            }
            // Get Request     
        } else {
            
            // Get section from db
            $section = $this->sectionAdminModel->getSectionById($id);

            if ($section === false) {
                redirect_admin('Section_admins');
            }

            $data = [
                'id' => $id,
                'img_name' => $section->img_name ?? '',
                'bg_img_name' => $section->bg_img_name ?? '',
                'icon_img_name' => $section->icon_img_name ?? '',
                'en_title' => $section->en_title ?? '',
                'en_text' => $section->en_text ?? '',
                'ge_title' => $section->ge_title ?? '',
                'ge_text' => $section->ge_text ?? '',
                'ru_title' => $section->ru_title ?? '',
                'ru_text' => $section->ru_text ?? ''
            ];

            $this->view('Section_admins/editSection', $data);
        }
    }
    // Delete
    public function deleteSection($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            
            foreach($_POST as $img_name){
                if($img_name !== ''){
                    $image_path = $target_dir.$img_name;
                    if(file_exists($image_path)){
                        if(!unlink($image_path)){
                            die('Something went wrong refresh page and try again');
                        }
                    } else {
                        flash('image_delete_fail','image does not exist','alert alert-danger');
                        redirect_admin('Logo_admins');
                    }        
                }
            }

            if($this->sectionAdminModel->deleteSection($id)){
                flash('section_deleted','section successfuly deleted');
                redirect_admin('Section_admins');
            } else {
                flash('section_delete_fail','section did not deleted','alert alert-danger');
                redirect_admin('Section_admins');
            }
        }
    }
    
}
