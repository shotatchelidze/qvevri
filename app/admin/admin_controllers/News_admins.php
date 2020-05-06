<?php
class News_admins extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }

        $this->newsAdminModel = $this->model('News_admin');
        $this->newsImgsAdminModel = $this->model('NewsImg_admin');
    }

    public function index()
    {
        
        $number_of_results = $this->newsAdminModel->newsCount();
        // define how many results you want per page
        if (!isset($_POST['result_per_page'])) {
            $results_per_page = 5;
        } else {
            $results_per_page = $_POST['result_per_page'];
        }

        // determine number of total pages available
        $number_of_pages = ceil($number_of_results / $results_per_page);
        // determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = filter_var($_GET['page'], FILTER_VALIDATE_INT);
            if ($page === false) {
                $page = 1;
            }
        }

        // determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;

        $news = $this->newsAdminModel->getNews($this_page_first_result, $results_per_page);
        $news_count = count($news);

        $data = [
            'news' => $news,
            'number_of_pages' => $number_of_pages,
            'news_count' => $news_count
        ];
        

        $this->view('News_admins/index', $data);
    }

    public function addNews()
    {
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'news_img_name' => $_FILES['image']['name'],
                'en_title' => trim($_POST['en_title']),
                'en_subtitle' => trim($_POST['en_subtitle']),
                'en_text' => trim($_POST['en_text']),
                'ge_title' => trim($_POST['ge_title']),
                'ge_subtitle' => trim($_POST['ge_subtitle']),
                'ge_text' => trim($_POST['ge_text']),
                'ru_title' => trim($_POST['ru_title']),
                'ru_subtitle' => trim($_POST['ru_subtitle']),
                'ru_text' => trim($_POST['ru_text']),
            ];
            $image_error = [
                'img_fake_err' => '',
                'img_exist_err' => '',
                'img_ext_err' => ''
            ];

            if (!empty($_FILES['image']['news_img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");

                if (!$image === true) {
                    $image_error['img_fake_err'] = $image['img_fake_err'];
                    $image_error['img_exist_err'] = $image['img_exist_err'];
                    $image_error['img_ext_err'] = $image['img_ext_err'];
                }
            }

            if (!array_filter($image_error)) {
                if ($this->newsAdminModel->addNews($data)) {
                    flash('news_added_success', 'News Added Successfuly');
                    redirect_admin('News_admins/addNews');
                } else {
                    flash('news_added_fail', 'Fail Add News', 'alert alert-danger');
                    redirect_admin('News_admins/addNews');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image_error);

                $this->view('News_admins/addNews', $data);
            }
            // Get      
        } else {

            $data = [
                'news_img_name' => '',
                'en_title' => '',
                'en_subtitle' => '',
                'en_text' => '',
                'ge_title' => '',
                'ge_subtitle' => '',
                'ge_text' => '',
                'ru_title' => '',
                'ru_subtitle' => '',
                'ru_text' => ''
            ];

            $this->view('News_admins/addNews', $data);
        }
    }

    public function editNews($id)
    {
        // Check id is actual number
        if (!is_numeric($id)) {
            redirect_admin('News_admins');
        }

        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'news_img_name' => $_FILES['image']['name'],
                'en_title' => trim($_POST['en_title']),
                'en_subtitle' => trim($_POST['en_subtitle']),
                'en_text' => trim($_POST['en_text']),
                'ge_title' => trim($_POST['ge_title']),
                'ge_subtitle' => trim($_POST['ge_subtitle']),
                'ge_text' => trim($_POST['ge_text']),
                'ru_title' => trim($_POST['ru_title']),
                'ru_subtitle' => trim($_POST['ru_subtitle']),
                'ru_text' => trim($_POST['ru_text']),
            ];

            $image_error = [
                'img_fake_err' => '',
                'img_exist_err' => '',
                'img_ext_err' => ''
            ];

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // First, delete existing image from folder
            // Get existing image name from DB
            $image_name_obj = $this->newsAdminModel->getNewsById($id);
            // Check id is correct or not
            if ($image_name_obj === false) {
                die('images does not exist reload page');
            }
            // Check image empty or not
            if ($image_name_obj->news_img_name !== '') {
                $image_name = $target_dir . $image_name_obj->news_img_name;
                if (file_exists($image_name)) {
                    if (!(unlink($image_name))) {
                        die('Something went wrong reload page');
                    }
                } else {
                    die('image does not exist');
                }
            }

            if (!empty($_FILES['image']['news_img_name'])) {
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");

                if (!$image === true) {
                    $image_error['img_fake_err'] = $image['img_fake_err'];
                    $image_error['img_exist_err'] = $image['img_exist_err'];
                    $image_error['img_ext_err'] = $image['img_ext_err'];
                }
            }

            if (!array_filter($image_error)) {
                if ($this->newsAdminModel->editNews($data)) {
                    flash('news_updated_success', 'News Updated Successfuly');
                    redirect_admin('News_admins/editNews', $id);
                } else {
                    flash('news_updated_fail', 'Fail Update News', 'alert alert-danger');
                    redirect_admin('News_admins/editNews', $id);
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image_error);

                $this->view('News_admins/editNews', $data);
            }
            // Get      
        } else {
            // Get exist News from model
            $news = $this->newsAdminModel->getNewsById($id);
            // If logo does not exist
            if ($news === false) {
                die('Something went wrong reload page and try again');
            }

            $data = [
                'id' => $id,
                'news_img_name' => $news->news_img_name,
                'en_title' => $news->en_title,
                'en_subtitle' => $news->en_subtitle,
                'en_text' => $news->en_text,
                'ge_title' => $news->ge_title,
                'ge_subtitle' => $news->ge_subtitle,
                'ge_text' => $news->ge_text,
                'ru_title' => $news->ru_title,
                'ru_subtitle' => $news->ru_subtitle,
                'ru_text' => $news->ru_text
            ];

            $this->view('News_admins/editNews', $data);
        }
    }

    // Delete news
    public function deleteNews($news_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // First Delete image from folder
            $target_dir = dirname(__FILE__, 4) . "/public/img/";

            $news_table_img_path = $target_dir . $_POST['delete_image'];
            if (file_exists($news_table_img_path)) {
                if (!unlink($news_table_img_path)) {
                    die('Something went wrong refresh page and try again');
                }
            } else {
                flash('image_delete_fail', 'image does not exist', 'alert alert-danger');
                redirect_admin('News_admins');
            }
            // იღებს სურათის სახელებს news_imgs ის თეიბლიდან 
            $newsImgs_objects = $this->newsImgsAdminModel->getNewsImgsByNewsId($news_id);
            // წაიშალოს news_imgs_ის თითოეული სურათი img-ების folder იდან, რადგან ON DELETE CASCADE წაშლის news_imgs_ში დაკავშირებულ columns_ებს
            foreach ($newsImgs_objects as $img_name_obj) {
                if ($img_name_obj->img_name !== '') {
                    $image_path = $target_dir . $img_name_obj->img_name;
                    if (file_exists($image_path)) {
                        if (!unlink($image_path)) {
                            die('Something went wrong refresh page and try again');
                        }
                    } else {
                        flash('image_delete_fail', 'image does not exist', 'alert alert-danger');
                        redirect_admin('News_admins');
                    }
                }
            }
            if ($this->newsAdminModel->deleteNews($news_id)) {
                flash('news_deleted', 'News successfuly deleted');
                redirect_admin('News_admins');
            } else {
                flash('news_delete_fail', 'News did not deleted', 'alert alert-danger');
                redirect_admin('News_admins');
            }
        }
    }

    // add only news in news_imgs table
    public function add_news_imgs()
    {
        $image_error = [
            "img_fake_err" => array(),
            'img_exist_err' => array(),
            'img_ext_err' => array()
        ];
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $count = count($_FILES['image']['name']);
            
            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'img_name' => $_FILES['image']['name'][$i],
                    // 'news_id' => $_POST['news_id']
                    'news_id' => $_GET['news_id']
                ];
                
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
                $temp_name = $_FILES['image']['tmp_name'][$i];
                $image = add_image($target_file, $temp_name, "1200");

                if ($image === true) {
                    if (!$this->newsImgsAdminModel->addNewsImg($data)) {
                        die('something went wrong reload page');
                    }
                    // if add_image function will return error    
                } else {
                    if($image['img_fake_err'] !== ''){
                        $image_error['img_fake_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_fake_err'];
                    }
                    if($image['img_exist_err'] !== ''){
                        $image_error['img_exist_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_exist_err'];
                    }
                    if($image['img_fake_err'] !== ''){
                        $image_error['img_fake_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_fake_err'];
                    }
                }
            }
            if (!array_filter($image_error)) {
                flash('news_img_added_success', 'Uploaded Image Added Successfuly');
            } else {
                flash('news_img_added_fail', 'Fail Add Some News Image', 'alert alert-danger');
            }
            
            $data = array_merge($image_error,   $data);
            $this->view('News_admins/add_news_imgs', $data);
            // Get request
        } else {
            // $externalId = [
            //     'news_id' => $_GET['news_id']
            // ];    
            // $data = array_merge($image_error);

            $this->view('News_admins/add_news_imgs', $image_error);
        }
    }

    // delete image from news_imgs table
    public function deleteNewsImgs($id)
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
                redirect_admin('News_admins');
            }
            // delete single image from news_imgs table
            if ($this->newsImgsAdminModel->deleteNewsImgs($id)) {
                flash('image_delete_success', 'logo successfuly deleted');
                redirect_admin('News_admins');
            } else {
                flash('image_delete_fail', 'logo did not deleted', 'alert alert-danger');
                redirect_admin('News_admins');
            }
        }
    }
}
