<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Products</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/Product_admins/addProduct" type="button" class="btn btn-primary">Add Product</a>

<?php flash('product_deleted'); ?>
<?php flash('product_delete_fail'); ?>


<!-- pagination -->
<?php for ($page = 1; $page <= $data['number_of_pages']; $page++) : ?>
    <a href="<?php echo URLROOT_ADMIN; ?>/Product_admins?page=<?php echo $page; ?>"><?php echo $page; ?></a>
<?php endfor; ?>
<label for="page">pages:</label>

<form action="<?php echo URLROOT_ADMIN; ?>/Product_admins/index" method="POST">
    <select name="result_per_page">
        <option value="<?php echo $data['result_per_page']; ?>"><?php echo $data['result_per_page']; ?></option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
    </select>
    <button type="submit" class="btn btn-success">Save</button>
</form>
<!-- start for -->
<?php foreach ($data['products'] as $product) : ?>

<div class="card-group">
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <p>Created : <?php echo multilanguage_date($product->created_at); ?></p>
            Product English Description
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $product->serial_number;?></li>
            <li class="list-group-item"><?php echo $product->quantity;?></li>
            <li class="list-group-item"><?php echo $product->product_name;?></li>
            <li class="list-group-item"><?php echo $product->title;?></li>
            <li class="list-group-item"><?php echo $product->text; ?></li>
        </ul>
    </div>
</div>

<!-- edit news -->
<a href="<?php echo URLROOT_ADMIN; ?>/Product_admins/editProduct/<?php echo $product->item_id; ?>" type="button" class="btn btn-secondary">Edit</a>


<!-- Delete news  -->
<form action="<?php echo URLROOT; ?>/Product_admins/deleteProduct/<?php echo $product->item_id; ?>" method="POST">
    <input type="hidden" name="delete_image" value="<?php echo $product->img_name; ?>">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
<?php endforeach;?>



<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>