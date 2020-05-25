<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h2>Update Description</h2>
<?php flash('Description_updated_success') ?>
<?php flash('Description_updated_fail') ?>
<form action="<?php echo URLROOT_ADMIN; ?>/Section_admins/editDescription/<?php echo $data[0]['item_id']?>" method="POST">
    <?php $i = 0;
    foreach (LANG_ARR as $lang => $language) : ?>
        <div class="form-group">
            <label for="title">Description <?php echo $language; ?> Title:</label>
            <textarea class="form-control" rows="1" name="<?php echo $lang; ?>_title"><?php echo $data[$i]["$lang" . '_title']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="title">Description <?php echo $language; ?> Subtitle:</label>
            <textarea class="form-control" rows="1" name="<?php echo $lang; ?>_subtitle"><?php echo $data[$i]["$lang" . '_subtitle']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="title">Description <?php echo $language; ?> Text:</label>
            <textarea class="form-control" rows="1" name="<?php echo $lang; ?>_text"><?php echo $data[$i]["$lang" . '_text']; ?></textarea>
        </div>
        <input type="hidden" name="<?php echo $lang;?>_id" value="<?php echo $data[$i]["$lang".'_id'];?>">
    <?php $i++;
    endforeach; ?>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>