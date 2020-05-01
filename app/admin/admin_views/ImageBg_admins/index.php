<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Background Images</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/ImageBg_admins/addImageBg" type="button" class="btn btn-primary">Add</a>

<?php flash('image_deleted') ?>
<?php flash('image_delete_fail') ?>

<?php foreach ($data['imageBgs'] as $imageBg) : ?>
    <!-- backround images -->
    <div class="card" style="width: 40rem; height: 30rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $imageBg->page_name;?> Page Image</h5>
  </div>
  <img src="<?php echo URLROOT_ADMIN;?>/public/img/<?php echo $imageBg->image_name;?>" class="card-img-top" alt="...">
</div>
    <a href="<?php echo URLROOT_ADMIN; ?>/ImageBg_admins/editImageBg/<?php echo $imageBg->id ; ?>" type="button" class="btn btn-secondary">Edit</a>

    <form action="<?php echo URLROOT; ?>/ImageBg_admins/deleteImageBg/<?php echo $imageBg->id ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $imageBg->image_name ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
<?php endforeach; ?>




<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>