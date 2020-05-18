<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Logos</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/Logo_admins/addLogo" type="button" class="btn btn-primary">Add</a>

<?php flash('image_deleted') ?>
<?php flash('image_delete_fail') ?>

<?php foreach ($data['logos'] as $logo) : ?>
    <!-- logo -->
    <h3><?php echo $logo->page; ?> Logo</h3>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $logo->img_name;  ?>" alt="Logo">
        <div class="card-body">
            <h5 class="card-title"><?php echo $logo->page; ?> Logo</h5>
        </div>
    </div>

    <div class="card-group">
        
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo <?php echo LANG_ARR[LANG]?> Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $logo->title;  ?></li>
                <li class="list-group-item"><?php echo $logo->subtitle; ?></li>
            </ul>
        </div>
        
    </div>
<!-- edit  -->
    <a href="<?php echo URLROOT_ADMIN; ?>/Logo_admins/editLogo/<?php echo $logo->item_id; ?>" type="button" class="btn btn-secondary">Edit</a>
<!-- delete -->
    <form action="<?php echo URLROOT; ?>/Logo_admins/deleteLogo/<?php echo $logo->item_id ; ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $logo->img_name; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
<?php endforeach; ?>




<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>