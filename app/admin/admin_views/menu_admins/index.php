<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h3>Menu</h3>
<?php flash('changed_success')?>
<?php flash('changed_fail')?>
<?php //var_dump($data); die();?>
<!-- menu -->
<form action="<?php echo URLROOT_ADMIN; ?>/Menu_admins/changeMenu" method="POST" enctype="multipart/form-data">

  <div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-bordered table-striped mb-0">
      <thead>
        <tr>
        <?php echo LANG_ARR[LANG] ?> 
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['menu'] as $menu) : ?>
          <tr>
            <td><input type="text" name="title[]" value="<?php echo $menu->title; ?>"></td>
          </tr>
          <input type="hidden" name="id[]" value="<?php echo $menu->id; ?>">
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success">Save</button>
  </div>
</form>

<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>
