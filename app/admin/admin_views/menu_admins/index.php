<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h3>Menu</h3>
<?php flash('changed_success')?>
<?php flash('changed_fail')?>
<?php flash('logo_added_success')?>
<?php flash('logo_added_fail')?>
<?php flash('image_deleted')?>
<?php flash('image_delete_fail')?>

<!-- menu -->
<form action="<?php echo URLROOT_ADMIN; ?>/Menu_admins/changeMenu" method="POST" enctype="multipart/form-data">

  <div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-bordered table-striped mb-0">
      <thead>
        <tr>
          <th scope="col">English</th>
          <th scope="col">Georgian</th>
          <th scope="col">Russian</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['menu'] as $menu) : ?>
          <tr>
            <td><input type="text" name="en_title[]" value="<?php echo $menu->en_title ?? '' ?>"></td>
            <td><input type="text" name="ge_title[]" value="<?php echo $menu->ge_title ?? '' ?>"></td>
            <td><input type="text" name="ru_title[]" value="<?php echo $menu->ru_title ?? '' ?>"></td>
          </tr>

          <input type="hidden" name="id[]" value="<?php echo $menu->id; ?>">
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success">Save</button>
  </div>
</form>

<br />
<!-- logo -->
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data['logo']->img_name ?? ''?>" alt="Logo">
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
<a href="<?php echo URLROOT_ADMIN; ?>/Menu_admins/editLogo/<?php echo $data['logo']->id ?? '';?>" type="button" class="btn btn-secondary">Change</a>

<form action="<?php echo URLROOT;?>/Menu_admins/deleteLogo/<?php echo $data['logo']->id ?? ''?>" method="POST">        
  <input type="hidden" name="delete_image" value="<?php echo $data['logo']->img_name ?? ''?>">
  <button type="submit" class="btn btn-danger">Delete</button>
</form>



<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>

