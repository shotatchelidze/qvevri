<?php
class ImageBg_admins extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }

        $this->imageBgAdminModel = $this->model('ImageBg_admin');
    }

    public function index()
    {
        $imageBgs = $this->imageBgAdminModel->getImageBgs();

        $data = [
            'imageBgs' => $imageBgs
        ];

        $this->view('ImageBg_admins/index', $data);
    }
    // Add background image
    public function addImageBg()
    {
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_uploaded_file($_FILES['image']['tmp_name'])) {

            $data = [
                'image_name' => $_FILES['image']['name'],
                'page_name' => $_POST['page']
            ];

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $temp_name = $_FILES['image']['tmp_name'];
            $image = add_image($target_file, $temp_name, "1200");

            if ($image === true) {
                if ($this->imageBgAdminModel->addImageBg($data)) {
                    flash('ImageBg_added_success', 'Background Image Added Successfuly');
                    redirect_admin('ImageBg_admins/addImageBg');
                } else {
                    flash('ImageBg_added_fail', 'Fail Add Background Image', 'alert alert-danger');
                    redirect_admin('ImageBg_admins/addImageBg');
                }
                // Load page with errors    
            } else {
                $data = array_merge($data, $image);

                $this->view('ImageBg_admins/addImageBg', $data);
            }
            // Get      
        } else {

            $this->view('ImageBg_admins/addImageBg');
        }
    }

    public function editImageBg($id)
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
                'image_name' => $_FILES['image']['name'],
                'page_name' => $_POST['page']
            ];

            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $temp_name = $_FILES['image']['tmp_name'];
            $image = add_image($target_file, $temp_name, "1200");

            if ($image === true) {
                // შემოწმდეს თუ არსებობდა სურათი და წაიშალოს fodler_იდან
                $image_name_obj = $this->logoAdminModel->getImageBgNameById($id);
                // Check id is correct or not
                if ($image_name_obj === false) {
                    die('images does not exist reload page');
                }

                if ($image_name_obj->image_name !== '') {
                    $image_name = $target_dir . $image_name_obj->image_name;
                    if (file_exists($image_name)) {
                        if (!(unlink($image_name))) {
                            die('Something went wrong reload page');
                        }
                    } else {
                        die('image does not exist');
                    }   
                }

                if ($this->imageBgAdminModel->editImageBg($data)) {
                    flash('ImageBg_edit_success', 'Background Image Updated Successfuly');
                    redirect_admin('ImageBg_admins/editImageBg', $id);
                } else {
                    flash('ImageBg_edit_fail', 'Fail Updated Background Image', 'alert alert-danger');
                    redirect_admin('ImageBg_admins/editImageBg', $id);
                }
                // Load page with errors    
            } else {
                $data_err = array_merge($data, $image);

                $this->view('ImageBg_admins/editImageBg', $data_err);
            }
            // For Get request    
        } else {
            
            // Get exist logo from model
            $imageBg = $this->imageBgAdminModel->getImageBgById($id);
            // If logo does not exist
            if ($imageBg === false) {
                die('Something went wrong reload page and try again');
            }

            $data = [
                'id' => $id,
                'image_name' => $imageBg->image_name,
                'page_name' => $imageBg->page_name 
            ];

            $this->view('ImageBg_admins/editImageBg', $data);
        }
    }

    public function deleteImageBg($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = dirname(__FILE__, 4) . "/public/img/";
            $image_name = $target_dir . $_POST['delete_image'];
            if (file_exists($image_name)) {
                if (unlink($image_name)) {
                    // If did not deletid    
                } else {
                    die('Something went wrong refresh page and try again');
                }
            } else {
                flash('image_delete_fail', 'background image does not exist', 'alert alert-danger');
                redirect_admin('ImageBg_admins');
            }

            if ($this->imageBgAdminModel->deleteImageBg($id)) {
                flash('image_deleted', 'background image successfuly deleted');
                redirect_admin('ImageBg_admins');
            } else {
                flash('image_delete_fail', 'background image did not deleted', 'alert alert-danger');
                redirect_admin('ImageBg_admins');
            }
        }
    }
}
