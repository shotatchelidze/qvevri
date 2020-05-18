<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Blogs/News</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/News_admins/addNews" type="button" class="btn btn-primary">Add News</a>

<?php flash('news_deleted') ?>
<?php flash('news_delete_fail') ?>

<?php flash('news_img_added_success'); ?>
<?php flash('news_img_added_fail'); ?>

<?php flash('image_delete_success'); ?>
<?php flash('image_delete_fail'); ?>
<!-- pagination -->
<?php for ($page = 1; $page <= $data['number_of_pages']; $page++) : ?>
    <a href="<?php echo URLROOT_ADMIN; ?>/News_admins?page=<?php echo $page; ?>"><?php echo $page; ?></a>
<?php endfor; ?>
<label for="page">pages:</label>

<form action="<?php echo URLROOT_ADMIN; ?>/News_admins/index" method="POST">
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
<?php foreach ($data['news'] as $news) : ?>

    <!-- add news imgs -->
    <a class="button btn btn-secondary" href="<?php echo URLROOT_ADMIN; ?>/News_admins/add_news_imgs?news_id=<?php echo $news->item_id; ?>">Add Image</a>

    <div class="card" style="width: 18rem;">
        <?php if ($news->news_img_name != '') : ?>
            <img class="card-img-top" src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $news->news_img_name; ?>" alt="News">
        <?php endif; ?>
    </div>


    <div class="card-group">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <p>Created : <?php echo multilanguage_date($news->created_at); ?></p>
                Blogs/News English Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $news->title;  ?></li>
                <li class="list-group-item"><?php echo $news->subtitle; ?></li>
                <li class="list-group-item"><?php echo $news->text; ?></li>
            </ul>
        </div>
    </div>

    <!-- edit news -->
    <a href="<?php echo URLROOT_ADMIN; ?>/News_admins/editNews/<?php echo $news->item_id; ?>" type="button" class="btn btn-secondary">Edit</a>


    <!-- Delete news  -->
    <form action="<?php echo URLROOT; ?>/News_admins/deleteNews/<?php echo $news->item_id; ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $news->news_img_name; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <!-- news_imgs images -->
    <?php foreach ($news->images as $image) : ?>
        <div class="card-group col-md-2">
            <div class="card " style="width: 18rem;">
                <img class="card-img-top" src="<?php echo URLROOT_ADMIN; ?>/public/img/<?php echo $image->img_name; ?>" alt="Card image cap">
                <div class="card-body">
                    <form action="<?php echo URLROOT_ADMIN; ?>/news_admins/deleteNewsImgs/<?php echo $image->id; ?>" method="POST">
                        <input type="hidden" name="delete_image" value="<?php echo $image->img_name; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>



    <!-- end for -->
<?php endforeach; ?>



<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>