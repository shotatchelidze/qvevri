<?php 
class Product_admins extends Controller{
    public function __construct()
    {   
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }
        getAdminLanguage();
        getLanguage();

        $this->productAdminModel = $this->model('Product_admin');
    }

    public function index(){
        $pagination_result = pagination("products");
        $this_page_first_result = $pagination_result['this_page_first_result'];
        $results_per_page = $pagination_result['results_per_page'];
        $number_of_pages = $pagination_result['number_of_pages'];
        //ენა რადგან არის კონსტანტა ვწერ query ში
        $products = $this->productAdminModel->getProducts($this_page_first_result, $results_per_page);

        $data = [
            'products' => $products,
            'number_of_pages' => $number_of_pages,
            'result_per_page' => $results_per_page
        ];

        $this->view('Product_admins/index',$data);
    }

    public function addProduct()
    {
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array_map('trim', $_POST);
            $data['img_name'] = $_FILES['image']['name'];
            $image = true;
            
            if (!empty($data['img_name'])) {
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }

            // თუ add_image ფუნქცია დააბრუნებს შეცდომების მასივს, არ მოხდება პროდუქტის დამატება
            if ($image === true) {
                if ($this->productAdminModel->addProduct($data)) {
                    flash('product_added_success', 'Products Added Successfuly');
                    redirect_admin('Product_admins/addProduct');
                } else {
                    flash('product_added_fail', 'Fail Add Product', 'alert alert-danger');
                    redirect_admin('Product_admins/addProduct');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Product_admins/addProduct', $data);
            }
            // Get      
        } else {
            
            $this->view('Product_admins/addProduct');
        }
    }

    public function editProduct($item_id)
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
                    'img_name' => $_FILES['image']['name'],
                    'serial_number' => trim($_POST['serial_number']),
                    'quantity' => trim($_POST['quantity']),
                    "$lang" . '_product_name' => trim($_POST["$lang" . '_product_name']),
                    "$lang" . '_title' => trim($_POST["$lang" . '_title']),
                    "$lang" . '_text' => trim($_POST["$lang" . '_text']),
                    "$lang" . '_id' => $_POST["$lang" . '_id']
                ];

                $data[] = $post_data;
            }
            
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image = true;
            if (!empty($_FILES['image']['news_img_name'])) {
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $temp_name = $_FILES['image']['tmp_name'];
                $image = add_image($target_file, $temp_name, "1200");
            }
            // Make sure image_error are empty
            if ($image === true) {
                $image_name_obj = $this->productAdminModel->getImageName($item_id);
                // შემოწმდეს თუ არსებობდა სურათი და წაიშალოს fodler_იდან
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
                // Update product
                if ($this->productAdminModel->updateProduct($data)) {
                    flash('product_updated_success', 'Product Updated Successfuly');
                    redirect_admin('Product_admins/editProduct', $item_id);
                } else {
                    flash('product_updated_fail', 'Fail Update Product', 'alert alert-danger');
                    redirect_admin('Product_admins/editProduct', $item_id);
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('Product_admins/editProduct', $data);
            }
            // Get      
        } else {
            // item_id ის მიხედვით წამოვიღოთ ყველა ენა
            $product_arr = $this->productAdminModel->getProductById($item_id);
            // თუ მითითებულ item_id_ით, არ არსებობს ჩანაწერი ესეიგი item_id_ის გადაცემის დროს მოხდა შეცდომა და გადამისამართდეს index გვერძე
            if (empty($product_arr)) {
                flash('product_img_added_fail','product does not exist reload page','alert alert-danger'); 
                redirect_admin('Product_admins/index');
            }
            $i = 0;
            foreach (LANG_ARR as $lang => $language) {
                $set_data = [
                    "$lang" . '_id' => $product_arr[$i]->id,
                    'item_id' => $product_arr[$i]->item_id,
                    'img_name' => $product_arr[$i]->img_name,
                    'serial_number' => $product_arr[$i]->serial_number,
                    'quantity' => $product_arr[$i]->quantity,
                    "$lang" . '_product_name' => $product_arr[$i]->product_name,
                    "$lang" . '_title' => $product_arr[$i]->title,
                    "$lang" . '_text' => $product_arr[$i]->text
                ];
                $data[] = $set_data;

                $i++;
            }

            $this->view('Product_admins/editProduct', $data);
        }
    }

    public function deleteProduct($item_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // შემოწმდეს აქვს თუ არა სურათი პროდუქტს
            if(!empty($_POST['delete_image'])){
                $target_dir = dirname(__FILE__, 4) . "/public/img/";
                $image_path = $target_dir . $_POST['delete_image'];
                if (file_exists($image_path)) {
                    if (!unlink($image_path)) {
                        die('Something went wrong refresh page and try again');
                    }
                } else {
                    flash('product_delete_fail', 'Image does not exist', 'alert alert-danger');
                    redirect_admin('Product_admins');
                }    
            } 
                
            if ($this->productAdminModel->deleteProduct($item_id)) {
                flash('product_deleted', 'Product successfuly deleted');
                redirect_admin('Product_admins');
            } else {
                flash('product_delete_fail', 'Product did not deleted', 'alert alert-danger');
                redirect_admin('Product_admins');
            }    
              
        }
    }

    
}