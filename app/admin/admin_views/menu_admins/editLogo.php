<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h2>Edit Logo</h2>
<form action="<?php echo URLROOT; ?>/Menu_admins/editLogo/<?php echo $data['id'];?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="col-md-6">
            <div class="form-group">
                <label>Upload Logo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input type="file" name="image" id="imgInp">
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                </div>
                <!-- gasaswrorebeli suratis ar shecvlis shemtxvevashi image name aris carieli -->
                <img src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data['img_name'] ?? ''?>" id='img-upload' />
            </div>

            <div class="form-group">
                <label for="title">Image English Title:</label>
                <textarea class="form-control" rows="1" name="en_title" ><?php echo $data['en_title'];?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image English Subtitle:</label>
                <textarea class="form-control" rows="1" name="en_subtitle"><?php echo $data['en_subtitle'];?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image Georgian Title:</label>
                <textarea class="form-control" rows="1" name="ge_title" ><?php echo $data['ge_title'];?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image Georgian Subtitle:</label>
                <textarea class="form-control" rows="1" name="ge_subtitle" ><?php echo $data['ge_subtitle'];?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image Russian Title:</label>
                <textarea class="form-control" rows="1" name="ru_title" ><?php echo $data['ru_title'];?></textarea>
            </div>
            <div class="form-group">
                <label for="title">Image Russian Subtitle:</label>
                <textarea class="form-control" rows="1" name="ru_subtitle" ><?php echo $data['ru_subtitle'];?></textarea>
            </div>
            <input type="hidden" name="page" value="menu">

            <button type="submit" class="btn btn-success">Submit</button>
</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>