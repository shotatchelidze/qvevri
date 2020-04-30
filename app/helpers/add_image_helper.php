<?php
function add_image($max_resolution)
{
    $uploadOk = false;

    $image = [
        'img_name' => $_FILES['image']['name'],
        'img_fake_err' => '',
        'img_exist_err' => '',
        'img_ext_err' => ''
    ];

    $target_dir = dirname(__FILE__, 3) . "/public/img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check_size = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check_size == false) {
        $image['img_fake_err'] = "File is not an image.";
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $image['img_exist_err'] = 'File is already exist change name';
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $image['img_ext_err'] = "Sorry, only JPG, JPEG & PNG files are allowed.";
    }
    //  Chech errors
    if (empty($image['img_fake_err']) && empty($image['img_exist_err']) && empty($image['img_ext_err'])) {
        // Upload image in folder
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
            // Check image size
            if ($check_size[0] > $max_resolution || $check_size[1] > $max_resolution) {
                if ($imageFileType == 'png') {
                    $original_image = imagecreatefrompng($target_file);
                } elseif ($imageFileType == 'jpeg' || $imageFileType == 'jpg') {
                    $original_image = imagecreatefromjpeg($target_file);
                }
                // Resolution
                $original_width = imagesx($original_image);
                $original_height = imagesy($original_image);
                // Try width first
                $ratio = $max_resolution / $original_width;
                $new_width = $max_resolution;
                $new_height = $original_height * $ratio;
                // Check height 
                if ($new_height > $max_resolution) {
                    $ratio = $max_resolution / $original_height;
                    $new_height = $max_resolution;
                    $new_width = $original_width * $ratio;
                }
                // Create new resized image
                if ($original_image) {
                    $new_image = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
                    if ($imageFileType == 'png') {
                        imagepng($new_image, $target_file);
                    } elseif ($imageFileType == 'jpeg' || $imageFileType == 'jpg') {
                        imagejpeg($new_image, $target_file);
                    }
                    // Everything is ok
                    $uploadOk = true;

                } else {
                    die('Something went wrong Please refresh Page and try again');
                }
            }
        // If did not uploaded         
        } else{
            die('Something went wrong Please refresh Page and try again');
        }
    }

    if($uploadOk){
        return true;
    } else {
        return $image;
    }
}
