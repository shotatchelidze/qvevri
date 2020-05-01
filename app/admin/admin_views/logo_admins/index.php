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
                Logo English Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $logo->en_title;  ?></li>
                <li class="list-group-item"><?php echo $logo->en_subtitle; ?></li>
            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo Georgian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $logo->ge_title;?></li>
                <li class="list-group-item"><?php echo $logo->ge_title;?></li>
            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo Russian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $logo->ru_title; ?></li>
                <li class="list-group-item"><?php echo $logo->ru_title ;?></li>
            </ul>
        </div>
    </div>
    <a href="<?php echo URLROOT_ADMIN; ?>/Logo_admins/editLogo/<?php echo $logo->id; ?>" type="button" class="btn btn-secondary">Edit</a>

    <form action="<?php echo URLROOT; ?>/Logo_admins/deleteLogo/<?php echo $logo->id ; ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $logo->img_name ; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
<?php endforeach; ?>




<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>