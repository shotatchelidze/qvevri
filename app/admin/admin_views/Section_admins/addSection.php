<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Add Section</h2>
<?php flash('Section_added_success') ?>
<?php flash('Section_added_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/Section_admins/addSection" method="POST" enctype="multipart/form-data">
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
            <!-- errors -->
            <span class="text-danger"><?php echo $data['bg_image_fake_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['bg_image_exist_err'] ?? '' ?></span>
            <span class="text-danger"><?php echo $data['bg_image_ext_err'] ?? '' ?></span>


            <div class="form-group">
                <label for="title">Section English Title:</label>
                <textarea class="form-control" rows="1" name="en_title"><?php echo $data['en_title']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Section English Text:</label>
                <textarea class="form-control" rows="1" name="en_text"><?php echo $data['en_text']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Section Georgian Title:</label>
                <textarea class="form-control" rows="1" name="ge_title"><?php echo $data['ge_title']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Section Georgian Text:</label>
                <textarea class="form-control" rows="1" name="ge_text"><?php echo $data['ge_text']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Section Russian Title:</label>
                <textarea class="form-control" rows="1" name="ru_title"><?php echo $data['ru_title']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Section Russian Text:</label>
                <textarea class="form-control" rows="1" name="ru_text"><?php echo $data['ru_text']; ?></textarea>
            </div>


            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>







<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>