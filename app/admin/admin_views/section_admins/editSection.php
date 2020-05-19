<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Update Section</h2>
<?php flash('Section_updated_success') ?>
<?php flash('Section_updated_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/Section_admins/editSection/<?php echo $data[0]['item_id'];?>" method="POST" enctype="multipart/form-data">
    <div class="container">

        <div class="col-md-6">

            <label>Upload Image</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse… <input type="file" name="image" id="imgInp">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload' />
            <!-- gasaswrorebeli suratis ar shecvlis shemtxvevashi image name aris carieli -->
            <img src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data[0]['img_name'] ?>" id='img-upload' />
            <!-- errors -->
            <span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span>


            <label>Upload Icon</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse… <input type="file" name="icon" id="imgInp">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload' />
            <!-- gasaswrorebeli suratis ar shecvlis shemtxvevashi image name aris carieli -->
            <img src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data[0]['bg_img_name'] ?>" id='img-upload' />
            <!-- errors -->
            <span class="text-danger"><?php echo $data['icon_fake_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['icon_exist_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['icon_ext_err'] ?? '' ?></span>

            <label>Upload Image Background Form</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse… <input type="file" name="bg_image" id="imgInp">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload' />
            <!-- gasaswrorebeli suratis ar shecvlis shemtxvevashi image name aris carieli -->
            <img src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data[0]['icon_img_name'] ?>" id='img-upload' />
            <!-- errors -->
            <span class="text-danger"><?php echo $data['bg_image_fake_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['bg_image_exist_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['bg_image_ext_err'] ?? '' ?></span>

            <?php $i = 0; foreach(LANG_ARR as $lang => $language):?>
            <div class="form-group">
                <label for="title">Section <?php echo $language;?> Title:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_title"><?php echo $data[$i]["$lang".'_title']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="text">Section <?php echo $language;?> Text:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_text"><?php echo $data[$i]["$lang".'_text']; ?></textarea>
            </div>
            <!-- hidden id -->
            <input type="hidden" name="<?php echo $lang;?>_id" value="<?php echo $data[$i]["$lang".'_id'];?>">        
            <?php $i++; endforeach;?>


            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>