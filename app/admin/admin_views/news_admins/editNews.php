<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Edit News/Blogs</h2>
<?php flash('news_updated_success') ?>
<?php flash('news_updated_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/News_admins/editNews/<?php echo $data[0]['item_id'];?>" method="POST" enctype="multipart/form-data">
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

            <?php $i = 0; foreach (LANG_ARR as $lang => $language) : ?>
            <div class="form-group">
                <label for="title"><?php echo $language;?> Title:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_title"><?php echo $data[$i]["$lang".'_title']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"><?php echo $language;?> Subtitle:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_subtitle"><?php echo $data[$i]["$lang".'_subtitle']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"><?php echo $language;?> Text:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_text"><?php echo $data[$i]["$lang".'_text']?></textarea>
            </div>
            
            <input type="hidden" name="<?php echo $lang;?>_id" value="<?php echo $data[$i]["$lang".'_id'];?>">
            <?php $i++; endforeach;?>
            

            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>