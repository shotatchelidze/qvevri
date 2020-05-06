<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Add News Images</h2>
<?php flash('news_img_added_success') ?>
<?php flash('news_img_added_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/News_admins/add_news_imgs?news_id=<?php echo $_GET['news_id']?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="col-md-6">
            <div class="form-group">
                <label>Upload Image</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input type="file" name="image[]" id="imgInp" multiple>
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                </div>
                <img id='img-upload' />
            </div>
            <!-- <input type="hidden" name="news_id" value="<?php //echo $data['news_id'] ?>"> -->
            <button type="submit" class="btn btn-success">submit</button>
        </div>
    </div>
</form>

<?php foreach ($data['img_fake_err'] as $key => $img_fake_err) : ?>
    <span class="text-danger"><?php echo $img_fake_err ?? '' ?></span><br>
<?php endforeach; ?>

<?php foreach ($data['img_exist_err'] as $img_exist_err) : ?>
    
    <span class="text-danger"><?php echo $img_exist_err ?? '' ?></span><br>
    
<?php endforeach; ?>

<?php foreach ($data['img_ext_err'] as $img_ext_err) : ?>
    <span class="text-danger"><?php echo $img_ext_err ?? '' ?></span><br>
<?php endforeach; ?>


<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>