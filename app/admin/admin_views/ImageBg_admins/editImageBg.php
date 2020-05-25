<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Edit Background Image</h2>
<?php flash('ImageBg_edit_success') ?>
<?php flash('ImageBg_edit_fail') ?> 

<form action="<?php echo URLROOT; ?>/ImageBg_admins/editImageBg/<?php echo $data['id'];?>" method="POST" enctype="multipart/form-data">
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
            <!-- gasasworebeli uploadshi rom chamndes is surati ris editsac  -->
            <!-- gasasworebeli rom select shi chandes is value rac aris minichebuli -->
            <label for="cars">Choose a page:</label>
            <select name="page" id="cars">
                <option value="welcome">welcome</option>
                <option value="home">home</option>
                <option value="news">news</option>
                <option value="singleNews">singleNews</option>    

            </select>

            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>