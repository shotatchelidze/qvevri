<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h3>Index Page</h3>

<!-- logos -->
<?php foreach ($data['logos'] as $logo) : ?>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data['logo']->img_name ?? '' ?>" alt="Logo">
        <div class="card-body">
            <h5 class="card-title">Menu Logo</h5>
        </div>
    </div>

    <div class="card-group">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo English Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['logo']->en_title ?? '' ?></li>
                <li class="list-group-item"><?php echo $data['logo']->en_subtitle ?? '' ?></li>
            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo Georgian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['logo']->ge_title ?? '' ?></li>
                <li class="list-group-item"><?php echo $data['logo']->ge_title ?? '' ?></li>
            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Logo Russian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['logo']->ru_title ?? '' ?></li>
                <li class="list-group-item"><?php echo $data['logo']->ru_title ?? '' ?></li>
            </ul>
        </div>
    </div>
    <a href="<?php echo URLROOT_ADMIN; ?>/Menu_admins/addLogo" type="button" class="btn btn-primary">Add</a>
    <a href="<?php echo URLROOT_ADMIN; ?>/Menu_admins/editLogo/<?php echo $data['logo']->id ?? ''; ?>" type="button" class="btn btn-secondary">Change</a>

    <form action="<?php echo URLROOT; ?>/Menu_admins/deleteLogo/<?php echo $data['logo']->id ?? '' ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $data['logo']->img_name ?? '' ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

<?php endforeach; ?>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>