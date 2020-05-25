<?php
class News_admins extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }
        // Get all languages from helpers/language_helper.php 
        getAdminLanguage();
        getLanguage();

        $this->newsAdminModel = $this->model('News_admin');
        $this->newsImgsAdminModel = $this->model('NewsImg_admin');
        
        // $this->paginationAdminModel = $this->model('Pagination_admin');
    }

    public function index()
    {
        
        $pagination_result = pagination("news");
        $this_page_first_result = $pagination_result['this_page_first_result'];
        $results_per_page = $pagination_result['results_per_page'];
        $number_of_pages = $pagination_result['number_of_pages'];
        

        // if(isset($_GET['language'])) $language = $_GET['language']; else $language='en';
        $news = $this->newsAdminModel->getNews($this_page_first_result, $results_per_page, LANG);

        $data = [
            'news' => $news,
            'number_of_pages' => $number_of_pages,
            'result_per_page' => $results_per_page
        ];

        $this->view('News_admins/index', $data);
    }

    public function addNews()
    {
        
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array_map('trim', $_POST);
            $data['news_img_name'] = $_FILES['image']['name'];
            $image = true;

            if (!empty($data['news_img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }

            // თუ add_image ფუნქცია დააბრუნებს შეცდომების მასივს, არ მოხდება სიახლის დამატება
            if ($image === true) {
                if ($this->newsAdminModel->addNews($data)) {
                    flash('news_added_success', 'News Added Successfuly');
                    redirect_admin('News_admins/addNews');
                } else {
                    flash('news_added_fail', 'Fail Add News', 'alert alert-danger');
                    redirect_admin('News_admins/addNews');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('News_admins/addNews', $data);
            }
            // Get      
        } else {
            
            $this->view('News_admins/addNews');
        }
    }

    public function editNews($item_id)
    {
        // Check id is actual number
        if (!is_numeric($item_id)) {
            redirect_admin('News_admins');
        }

        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            foreach (LANG_ARR as $lang => $language) {
                $post_data = [
                    'news_img_name' => $_FILES['image']['name'],
                    "$lang" . '_title' => trim($_POST["$lang" . '_title']),
                    "$lang" . '_subtitle' => trim($_POST["$lang" . '_subtitle']),
                    "$lang" . '_text' => trim($_POST["$lang" . '_text']),
                    "$lang" . '_id' => $_POST["$lang" . '_id']
                ];

                $data[] = $post_data;
            }
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // წაიშალოს ძველი სურათი ფოლდერიდან
            $image_name_obj = $this->newsAdminModel->getImageName($item_id);
            if($image_name_obj->news_img_name !== ''){
                $image_name = $target_dir . $image_name_obj->news_img_name;
                if (file_exists($image_name)) {
                    if (!(unlink($image_name))) {
                die('Something went wrong reload page');
                    }
                } else {
                    die('image does not exist');
                }
            }

            $image = true;
            if (!empty($_FILES['image']['news_img_name'])) {
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }
            // Make sure image_error are empty
            if ($image === true) {
                // Update news
                if ($this->newsAdminModel->updateNews($data)) {
                    flash('news_updated_success', 'News Updated Successfuly');
                    redirect_admin('News_admins/editNews', $item_id);
                } else {
                    flash('news_updated_fail', 'Fail Update News', 'alert alert-danger');
                    redirect_admin('News_admins/editNews', $item_id);
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('News_admins/editNews', $data);
            }
            // Get      
        } else {
            // item_id ის მიხედვით წამოვიღოთ ყველა ენა
            $news_arr = $this->newsAdminModel->getNewsById($item_id);
            // თუ მითითებულ item_id_ით, არ არსებობს ჩანაწერი ესეიგი item_id_ის გადაცემის დროს მოხდა შეცდომა და გადამისამართდეს index გვერძე
            if (empty($news_arr)) {
                flash('news_img_added_fail','news does not exist reload page','alert alert-danger'); 
                redirect_admin('News_admins/index');
            }
            $i = 0;
            foreach (LANG_ARR as $lang => $language) {
                $set_data = [
                    "$lang" . '_id' => $news_arr[$i]->id,
                    'item_id' => $news_arr[$i]->item_id,
                    'news_img_name' => $news_arr[$i]->news_img_name,
                    "$lang" . '_title' => $news_arr[$i]->title,
                    "$lang" . '_subtitle' => $news_arr[$i]->subtitle,
                    "$lang" . '_text' => $news_arr[$i]->text
                ];
                $data[] = $set_data;
                $i++;
            }

            $this->view('News_admins/editNews', $data);
        }
    }

    // Delete news
    public function deleteNews($item_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            // Check if exist image
            if (isset($_POST['delete_iamge'])) {
                // First Delete image from folder
                $news_table_img_path = $target_dir . $_POST['delete_image'];
                if (file_exists($news_table_img_path)) {
                    if (!unlink($news_table_img_path)) {
                        die('Something went wrong refresh page and try again');
                    }
                } else {
                    flash('image_delete_fail', 'image does not exist', 'alert alert-danger');
                    redirect_admin('News_admins');
                }
            }
            // იღებს სურათის სახელებს news_imgs ის თეიბლიდან 
            $newsImgs_objects = $this->newsImgsAdminModel->getNewsImgsByNewsId($item_id);
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
            if ($this->newsAdminModel->deleteNews($item_id)) {
                flash('news_deleted', 'News successfuly deleted');
                redirect_admin('News_admins');
            } else {
                flash('news_delete_fail', 'News did not deleted', 'alert alert-danger');
                redirect_admin('News_admins');
            }
        }
    }

    // add only images in news_imgs table
    public function add_news_imgs()
    {
        $image_error = [
            "img_fake_err" => array(),
            'img_exist_err' => array(),
            'img_ext_err' => array()
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['image']['name'][0])) {
            
            $count = count($_FILES['image']['name']);
            $news_id = filter_var($_GET['news_id'], FILTER_VALIDATE_INT);
            // შემოწმდეს გადმოცემული id_ით არსებობს თუ არა news_ი 
            if (!$news_id || !$this->newsAdminModel->findNewsById($news_id)) {
                flash('news_img_added_fail', 'Incorect request','alert alert-danger');
                redirect_admin('News_admins/index');
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $data = [
                        'img_name' => $_FILES['image']['name'][$i],
                        'news_id' => $news_id
                    ];
                    $target_dir = dirname(__FILE__, 4) . "/public/img/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
                    $temp_name = $_FILES['image']['tmp_name'][$i];
                    $image = add_image($target_file, $temp_name, "1200");

                    if ($image === true) {
                        if (!$this->newsImgsAdminModel->addNewsImg($data)) {
                            die('something went wrong reload page');
                        }
                        // რომელი სურათიც არ დაემატება, იმ სურათის კონკრეტული error ის გამოტანა მოხდეს view_ში სურათის სახელთან ერთად    
                    } else {
                        if ($image['img_fake_err'] !== '') {
                            $image_error['img_fake_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_fake_err'];
                        }
                        if ($image['img_exist_err'] !== '') {
                            $image_error['img_exist_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_exist_err'];
                        }
                        if ($image['img_fake_err'] !== '') {
                            $image_error['img_fake_err'][$i] = $_FILES["image"]["name"][$i] . ' ' . $image['img_fake_err'];
                        }
                    }
                }
            }
            // შემოწმდეს ყველა სურთი წარმატებით აიტვირთა თუ არა 
            if (!array_filter($image_error)) {
                flash('news_img_added_success', 'Uploaded Image Added Successfuly');
            } else {
                flash('news_img_added_fail', 'Fail Add Some News Image', 'alert alert-danger');
            }

            $this->view('News_admins/add_news_imgs', $image_error);
            
            // Get request
        } else {
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
                flash('image_delete_fail', 'image does not exist', 'alert alert-danger');
                redirect_admin('News_admins');
            }
            // delete single image from news_imgs table
            if ($this->newsImgsAdminModel->deleteNewsImgs($id)) {
                flash('image_delete_success', 'image successfuly deleted');
                redirect_admin('News_admins');
            } else {
                flash('image_delete_fail', 'image did not deleted', 'alert alert-danger');
                redirect_admin('News_admins');
            }
        }
    }
}
