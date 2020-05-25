<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h2>Edit Logo</h2>

<?php flash('logo_added_success'); ?>
<?php flash('logo_added_fail');?>
<?php flash('logo_updated_success'); ?>
<?php flash('logo_updated_fail'); ?>


<form action="<?php echo URLROOT; ?>/Logo_admins/editLogo/<?php echo $data[0]['item_id']; ?>" method="POST" enctype="multipart/form-data">
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
                <img src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data[0]['img_name'] ?>" id='img-upload' />
            </div>
            <?php $i = 0; foreach(LANG_ARR as $lang => $language) : ?>
            <div class="form-group">
                <label for="title">Image <?php echo $language;?> Title:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_title"><?php echo $data[$i]["$lang".'_title']?></textarea>
            </div>
            <div class="form-group">
                <label for="subtitle">Image <?php echo $language;?> Subtitle:</label>
                <textarea class="form-control" rows="1" name="<?php echo $lang;?>_subtitle"><?php echo $data[$i]["$lang".'_subtitle'];?></textarea>
            </div>
            
            <input type="hidden" name="<?php echo $lang;?>_id" value="<?php echo $data[$i]["$lang".'_id'];?>">    
            <?php $i++; endforeach;?>
            
            <!-- gasasworebelia editis dros selectshi shi unda gamochndes ra page ic iyo archeuli -->
            <label for="cars">Choose a page:</label>
            <select name="page" id="page">
                <option value="menu">menu</option>
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