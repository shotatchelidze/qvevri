<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Add News/Blogs</h2>
<?php flash('news_added_success') ?>
<?php flash('news_added_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/News_admins/addNews" method="POST" enctype="multipart/form-data">
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

            <div class="form-group">
                <label for="title">English Title:</label>
                <textarea class="form-control" rows="1" name="en_title"><?php echo $data['en_title']?></textarea>
            </div>
            <div class="form-group">
                <label for="title">English Subtitle:</label>
                <textarea class="form-control" rows="1" name="en_subtitle"><?php echo $data['en_subtitle']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> English Text:</label>
                <textarea class="form-control" rows="1" name="en_text"><?php echo $data['en_text']?></textarea>
            </div>
            
            <div class="form-group">
                <label for="title">Georgian Title:</label>
                <textarea class="form-control" rows="1" name="ge_title"><?php echo $data['ge_title']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> Georgian Subtitle:</label>
                <textarea class="form-control" rows="1" name="ge_subtitle"><?php echo $data['ge_subtitle']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> Georgian Text:</label>
                <textarea class="form-control" rows="1" name="ge_text"><?php echo $data['ge_text']?></textarea>
            </div>

            <div class="form-group">
                <label for="title">Russian Title:</label>
                <textarea class="form-control" rows="1" name="ru_title"><?php echo $data['ru_title']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> Russian Subtitle:</label>
                <textarea class="form-control" rows="1" name="ru_subtitle"><?php echo $data['ru_subtitle']?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> Russian Text:</label>
                <textarea class="form-control" rows="1" name="ru_text"><?php echo $data['ru_text']?></textarea>
            </div>
            

            <!-- <label for="cars">Choose a page:</label>
            <select name="page" id="cars">
                <option value="menu">menu</option>
                <option value="index">index</option>
            </select> -->

            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>