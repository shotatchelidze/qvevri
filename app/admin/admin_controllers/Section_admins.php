<?php
class Section_admins extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }
        // ენის განსაზღვრა
        getAdminLanguage();
        getLanguage();

        $this->sectionAdminModel = $this->model('Section_admin');
    }

    public function index()
    {
        // ენა რადგან არის კონსტანტა გადაცემის მაგივრად პირდაპირ query ში ვწერ
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
            $data = array_map('trim', $_POST);
            $data['img_name'] = $_FILES['image']['name'];
            $data['bg_img_name'] = $_FILES['bg_image']['name'];
            $data['icon_img_name'] =  $_FILES['icon']['name'];
            
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
            $this->view('Section_admins/addSection');
        }
    }

    // Edit
    public function editSection($item_id)
    {
        
        // Check id is actual number
        if (!is_numeric($item_id)) {
            redirect_admin('Section_admins');
        }

        // Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            foreach(LANG_ARR as $lang => $language){
                $post_data = [
                    'img_name' => $_FILES['image']['name'],
                    'bg_img_name' => $_FILES['bg_image']['name'],
                    'icon_img_name' => $_FILES['icon']['name'],
                    "$lang".'_title' => trim($_POST["$lang".'_title']),
                    "$lang".'_text' => trim($_POST["$lang".'_text']),
                    "$lang".'_id' => $_POST["$lang".'_id'],
                    'item_id' => $item_id
                ];
                // ახალ მასივში შეინახოს მონაცემები რადგან, შეცდომის დაბრუნების დროს გადაეცეს ზუსტად ის data რასაც get request_ის დროს გადაეცემა views
                $data[] = $post_data;    
            }

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

            
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image_name_obj = $this->sectionAdminModel->getSectionImageNamesById($item_id);
            
            // Check if set image
            if (!empty($data[0]['img_name'])) {
                // Image
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
                
                // If image error exist
                if ($image !== true) {
                    $data_err['img_fake_err'] = $image['img_fake_err'];
                    $data_err['img_exist_err'] = $image['img_exist_err'];
                    $data_err['img_ext_err'] = $image['img_ext_err'];
                    // თუ ახალი სურთი წარმატებით აიტვირთა folder ში წაიშალოს ძველი
                } else {
                    if($image_name_obj->img_name !== ''){
                        $image_name = $target_dir . $image_name_obj->img_name;
                        if (file_exists($image_name)) {
                            if (!(unlink($image_name))) {
                                die('Something went wrong reload page');
                            }
                        }else {die('image does not exist');}
                    }
                }
            }
            // Check if set icon
            if (!empty($data[0]['icon_img_name'])) {
                // Icon
                $target_file = $target_dir . basename($_FILES["icon"]["name"]);
                $temp_name = $_FILES['icon']['tmp_name'];
                $icon = add_image($target_file, $temp_name, "1200");
                // If icon error exist
                if ($icon !== true) {
                    $data_err['icon_fake_err'] = $icon['img_fake_err'];
                    $data_err['icon_exist_err'] = $icon['img_exist_err'];
                    $data_err['icon_ext_err'] = $icon['img_ext_err'];
                    // თუ ახალი სურთი წარმატებით აიტვირთა folder ში წაიშალოს ძველი
                } else {
                    if ($image_name_obj->icon_img_name !== '') {
                        $icon_img_name = $target_dir . $image_name_obj->icon_img_name;
                        if (file_exists($icon_img_name)) {
                            if (!(unlink($icon_img_name))) {
                                die('Something went wrong reload page');
                            }
                        }else {die('image does not exist');}
                    }        
                }
            }
            // Check if set background image 
            if (!empty($data[0]['bg_img_name'])) {
                // Background image
                $target_file = $target_dir . basename($_FILES["bg_image"]["name"]);
                $temp_name = $_FILES['bg_image']['tmp_name'];
                $bg_image = add_image($target_file, $temp_name, "1200");
                // if background image error exist
                if ($bg_image !== true) {
                    $data_err['bg_image_fake_err'] = $bg_image['img_fake_err'];
                    $data_err['bg_image_exist_err'] = $bg_image['img_exist_err'];
                    $data_err['bg_image_ext_err'] = $bg_image['img_ext_err'];
                    // თუ ახალი სურთი წარმატებით აიტვირთა folder ში წაიშალოს ძველი
                } else {
                    if ($image_name_obj->bg_img_name !== '') {
                        $bg_img_name = $target_dir . $image_name_obj->bg_img_name;
                        if (file_exists($bg_img_name)) {
                            if (!(unlink($bg_img_name))) {
                                die('Something went wrong reload page');
                            }
                        }else {die('image does not exist');}
                    }
                }
            }
            // Chech errors 
            if (!array_filter($data_err)) {
                // Try add
                if ($this->sectionAdminModel->updateSection($data)) {
                    flash('Section_updated_success', 'Section Updated Successfuly');
                    redirect_admin('Section_admins/editSection', $item_id);
                } else {
                    flash('Section_updated_fail', 'Fail update Section', 'alert alert-danger');
                    redirect_admin('Section_admins/editSection', $item_id);
                }
                // ჩაიტვირთოს გვერდი შეყვანილი ინფორმაციით და შეცდომებით
            } else {
                $data = array_merge($data, $data_err);
                $this->view('Section_admins/editSection', $data);
            }
            // Get Request     
        } else {
            // item_id ის მიხედვით წამოვიღოთ ყველა ენა
            $section_arr = $this->sectionAdminModel->getSectionById($item_id);
            // თუ მითითებულ item_id_ით, არ არსებობს ჩანაწერი ესეიგი item_id_ის გადაცემის დროს მოხდა შეცდომა და გადამისამართდეს index გვერძე
            if (empty($section_arr)) {
                flash('section_get_fail','section does not exist reload page','alert alert-danger'); 
                redirect_admin('Section_admins/index');
            }
            $i=0;
            foreach(LANG_ARR as $lang => $language){
                $set_data = [
                    "$lang" . '_id' => $section_arr[$i]->id,
                    "item_id" => $section_arr[$i]->item_id,
                    'img_name' => $section_arr[$i]->img_name,
                    'bg_img_name' => $section_arr[$i]->bg_img_name,
                    'icon_img_name' => $section_arr[$i]->icon_img_name,
                    "$lang".'_title' => $section_arr[$i]->title,
                    "$lang".'_text' => $section_arr[$i]->text
                ];
                $data[] = $set_data;
                $i++;
            }
            $this->view('Section_admins/editSection', $data);
        }
    }
    // Delete
    public function deleteSection($item_id){
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

            if($this->sectionAdminModel->deleteSection($item_id)){
                flash('section_deleted','section successfuly deleted');
                redirect_admin('Section_admins');
            } else {
                flash('section_delete_fail','section did not deleted','alert alert-danger');
                redirect_admin('Section_admins');
            }
        }
    }
    
}
