<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Add Logo</h2>
<?php flash('logo_added_success') ?>
<?php flash('logo_added_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/Logo_admins/addLogo" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="col-md-6">
            <div class="form-group">
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
            </div>

            <?php foreach(LANG_ARR as $lang => $language) :?>
            <div class="form-group">
                <label for="title">Image <?php echo $language?> Title:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_title"><?php echo $data["$lang".'_title'] ?? '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image <?php echo $language;?> Subtitle:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_subtitle"><?php echo $data["$lang".'_subtitle'] ?? '' ?></textarea>
            </div>
            <?php endforeach;?>
                
            <label for="cars">Choose a page:</label>
            <select name="page" id="cars">
                <option value="menu">menu</option>
                <option value="welcome">welcome</option>
            </select>

            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>