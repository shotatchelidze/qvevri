<?php
class Logo_admins extends Controller
{

    public function __construct()
    {

        if (!isLoggedIn()) {
            redirect_admin('admins');
        }
        getAdminLanguage();
        getLanguage();

        $this->logoAdminModel = $this->model('Logo_admin');
    }

    public function index()
    {
        // ენა რადგან არის კონსტანტა გადაცემის მაგივრად პირდაპირ query ში ვწერ
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
            $data = array_map('trim',$_POST);
            $data['img_name'] = $_FILES["image"]["name"]; 
            $image = true;
            if (!empty($data['img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }
            // თუ add_image ფუნქცია დააბრუნებს შეცდომების მასივს, არ მოხდება ლოგოს დამატება
            if ($image === true) {
                if ($this->logoAdminModel->addLogo($data)) {
                    flash('logo_added_success', 'Logo Added Successfuly');
                    redirect_admin('Logo_admins/addLogo');
                } else {
                    flash('logo_added_fail', 'Fail Add Logo', 'alert alert-danger');
                    redirect_admin('Logo_admins/addLogo');
                }
                // ჩაიტვირთოს გვერდი შეცდომებით    
            } else {
                
                $data = array_merge($data, $image);
                
                $this->view('Logo_admins/AddLogo', $data);
            }
            // Get      
        } else {
            $this->view('Logo_admins/addLogo');
        }
    }

    public function editLogo($item_id)
    {
        // Check id is actual number
        if (!is_numeric($item_id)) {
            redirect_admin('Logo_admins/index');
        }

        // check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            foreach (LANG_ARR as $lang => $language) {
                $post_data = [
                    'img_name' => $_FILES['image']['name'],
                    'item_id' => $item_id,
                    "$lang" . '_title' => trim($_POST["$lang" . '_title']),
                    "$lang" . '_subtitle' => trim($_POST["$lang" . '_subtitle']),
                    "$lang" . '_id' => $_POST["$lang" . '_id'],
                    'page' =>$_POST['page']
                ];

                $data[] = $post_data;
            }
            
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // წაიშალოს ძველი სურათი folder_დან, თუ არსებობს
            $image_name_obj = $this->logoAdminModel->getLogoImageNameById($item_id);
            if($image_name_obj->img_name !== ''){
                $image_name = $target_dir . $image_name_obj->img_name;
                if (file_exists($image_name)) {
                    if (!(unlink($image_name))) {
                        die('Something went wrong reload page');
                    }
                } else {
                    die('Something went wrong reload page');
                }
            }
            // სურათის ატვირთვა folder_ში
            $image = true;
            if (!empty($_FILES['image']['name'])) {
                $target_file = $target_dir . basename($_FILES['image']['name']);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }

            // შემოწდეს აიტვირთა თუ არა სურათი folder_ში
            if ($image === true) { 
                // განახლდეს ლოგოს მონაცემები ბაზაში
                if ($this->logoAdminModel->updateLogo($data)) {
                    flash('logo_updated_success', 'Logo Updated Successfuly');
                    redirect_admin('Logo_admins/editLogo', $item_id);
                } else {
                    flash('logo_updated_fail', 'Fail Update Logo', 'alert alert-danger');
                    redirect_admin('Logo_admins/editLogo', $item_id);
                }
                // ჩაიტვირთოს გვერდი error_ებთან ერთად
            } else {
                $data = array_merge($data,$image);
                $this->view('Logo_admins/editLogo', $data);
            }
            // Get request    
        } else {
            // item_id ის მიხედვით წამოვიღოთ ყველა ენა
            $logo_arr = $this->logoAdminModel->getLogoById($item_id);
            // თუ მითითებულ item_id_ით, არ არსებობს ჩანაწერი ესეიგი item_id_ის გადაცემის დროს მოხდა შეცდომა და გადამისამართდეს index გვერძე
            if (empty($logo_arr)) {
                die(var_dump($logo_arr));
                flash('logo_updated_fail','logo does not exist reload page','alert alert-danger'); 
                redirect_admin('Logo_admins/index');
            }
            $i = 0;
            foreach (LANG_ARR as $lang => $language) {
                $set_data = [
                    "$lang" . '_id' => $logo_arr[$i]->id,
                    'item_id' => $logo_arr[$i]->item_id,
                    'img_name' => $logo_arr[$i]->img_name,
                    "$lang" . '_title' => $logo_arr[$i]->title,
                    "$lang" . '_subtitle' => $logo_arr[$i]->subtitle,
                    'page' => $logo_arr[$i]->page
                ];
                $data[] = $set_data;
                $i++;
            }
            
            $this->view('Logo_admins/editLogo', $data);
        }
    }

    public function deleteLogo($item_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // შემოწმდეს აქვს თუ არა სურათი ლოგოს
            if(!empty($_POST['delete_image'])){
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
            } 
                
            if ($this->logoAdminModel->deleteLogo($item_id)) {
                flash('image_deleted', 'logo successfuly deleted');
                redirect_admin('Logo_admins');
            } else {
                flash('image_delete_fail', 'logo did not deleted', 'alert alert-danger');
                redirect_admin('Logo_admins');
            }    
              
        }
    }
}
