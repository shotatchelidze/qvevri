<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>

<h2>Add Product</h2>
<?php flash('product_added_success') ?>
<?php flash('product_added_fail') ?>

<form action="<?php echo URLROOT_ADMIN; ?>/Product_admins/addProduct" method="POST" enctype="multipart/form-data">
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
                <label for="serial_number">Serial Number:</label>
                <textarea class="form-control" rows="1" name="serial_number"><?php echo $data['serial_number'] ?? ''?></textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <textarea class="form-control" rows="1" name="quantity"><?php echo $data['quantity'] ?? ''?></textarea>
            </div>
            <?php $i = 0; foreach(LANG_ARR as $lang => $language):?>
            <div class="form-group">
                <label for="<?php echo $lang;?>_product_name"><?php echo $language;?> Product Name:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_product_name"><?php echo $data[$i]["$lang".'_product_name'] ?? ''?></textarea>
            </div>
            <div class="form-group">
                <label for="title"><?php echo $language;?> Title:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_title"><?php echo $data[$i]["$lang".'_title'] ?? ''?></textarea>
            </div>
            <div class="form-group">
                <label for="title"> <?php echo $language;?> Text:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_text"><?php echo $data[$i]["$lang".'_text'] ?? ''?></textarea>
            </div>
            <?php $i++; endforeach;?> 
            
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</form>

<span class="text-danger"><?php echo $data['img_fake_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_exist_err'] ?? '' ?></span><br>
<span class="text-danger"><?php echo $data['img_ext_err'] ?? '' ?></span><br>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>