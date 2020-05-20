<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Home Page Section</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/Section_admins/addSection" type="button" class="btn btn-primary">Add</a>

<?php flash('section_get_fail');?>
<?php flash('section_deleted'); ?>
<?php flash('section_delete_fail'); ?>

<?php foreach ($data['sections'] as $section) : ?>
    <!-- Section -->
    <div class="card-group">
        <div class="card" style="width: 18rem; height:30rem;">
            <img class="card-img-top" src="<?php echo URLROOT_ADMIN;?>/public/img/<?php echo $section->img_name;?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Image</h5>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="<?php echo URLROOT_ADMIN;?>/public/img/<?php echo $section->bg_img_name;?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Background image</h5>
            </div>
        </div>
        <div class="card" style="width: 18rem;height:30rem;">
            <img class="card-img-top" src="<?php echo URLROOT_ADMIN;?>/public/img/<?php echo $section->icon_img_name;?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Icon</h5>
            </div>
        </div>
    </div>
    <!-- text -->
    <div class="card-group">
        
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Section <?php echo LANG_ARR[LANG];?> Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $section->title;  ?></li>
                <li class="list-group-item"><?php echo $section->text; ?></li>
            </ul>
        </div>
        
    </div>

    <a href="<?php echo URLROOT_ADMIN; ?>/Section_admins/editSection/<?php echo $section->item_id;?>" type="button" class="btn btn-secondary">Edit</a>

    <form action="<?php echo URLROOT; ?>/Section_admins/deleteSection/<?php echo $section->item_id;?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $section->img_name;?>">
        <input type="hidden" name="delete_bg_image" value="<?php echo $section->bg_img_name;?>">
        <input type="hidden" name="delete_icon_image" value="<?php echo $section->icon_img_name;?>">

        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
<?php endforeach; ?>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>