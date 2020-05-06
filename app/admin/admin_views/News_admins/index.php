<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<h1>Blogs/News</h1>
<a href="<?php echo URLROOT_ADMIN; ?>/News_admins/addNews" type="button" class="btn btn-primary">Add News</a>

<?php flash('news_deleted') ?>
<?php flash('news_delete_fail') ?>

<?php flash('news_img_added_success'); ?>
<?php flash('news_img_added_fail'); ?>

<?php flash('image_delete_success'); ?>
<?php flash('image_delete_fail'); ?>

<?php for ($page = 1; $page <= $data['number_of_pages']; $page++) : ?>
    <a href="<?php echo URLROOT_ADMIN; ?>/News_admins?page=<?php echo $page; ?>"><?php echo $page; ?></a>
<?php endfor; ?>
<label for="cars">Choose a result for per pages:</label>

<form action="<?php echo URLROOT_ADMIN; ?>/News_admins/index" method="POST">
    <select name="result_per_page">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
    </select>
    <button type="submit" class="btn btn-success">Save</button>
</form>

<!-- start for -->
<?php for ($i = 0; $i < $data['news_count']; $i++) : ?>


    <a class="button btn btn-secondary" href="<?php echo URLROOT_ADMIN; ?>/News_admins/add_news_imgs?news_id=<?php echo $data['news'][$i]->news_id; ?>">Add Image</a>


    <!-- add news imgs -->
    <form action="<?php echo URLROOT_ADMIN; ?>/News_admins/addNewsImage" method="POST" enctype="multipart/form-data">
        <div class="col-md-2">
            <div class="form-group">
                <label>Choose Image</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input type="file" name="image" id="imgInp">
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                </div>
                <img id='img-upload' />
            </div>
            <button type="submit" class="btn btn-success">Upload Image</button>
        </div>
        <input type="hidden" name="news_id" value="<?php echo $data['news'][$i]->news_id; ?>" />
    </form>


    


    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo URLROOT_ADMIN ?>/public/img/<?php echo $data['news'][$i]->news_img_name; ?>" alt="News">
    </div>


    <div class="card-group">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <p>Created : <?php echo multilanguage_date($data['news'][$i]->created_at); ?></p>
                Blogs/News English Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['news'][$i]->en_title;  ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->en_subtitle; ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->en_text; ?></li>

            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Blogs/News Georgian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['news'][$i]->ge_title; ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->ge_subtitle; ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->ge_text; ?></li>
            </ul>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Blogs/News Russian Description
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $data['news'][$i]->ru_title; ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->ru_subtitle; ?></li>
                <li class="list-group-item"><?php echo $data['news'][$i]->ru_text; ?></li>
            </ul>
        </div>
    </div>
    <!-- shesascorebeli -->
    <a href="<?php echo URLROOT_ADMIN; ?>/News_admins/editNews/<?php echo $data['news'][$i]->news_id; ?>" type="button" class="btn btn-secondary">Edit</a>
    <!-- shesascorebeli -->

    <!-- Delete news  -->
    <form action="<?php echo URLROOT; ?>/News_admins/deleteNews/<?php echo $data['news'][$i]->news_id; ?>" method="POST">
        <input type="hidden" name="delete_image" value="<?php echo $data['news'][$i]->news_img_name; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <!-- სხვანაირად როგორ შეიძლება ბაზიდან წამოღების დროს reference table(მშობელ table)_ში ჩაიწეროს indexed table(შვილი table) _ ის მონაცემები დაკავშირებული id ებით -->
    <!-- მაგალითად წამოვიღო ბაზიდან news table_ის ერთი ჩანაწერი და news_imgs table იდან მიებას ის ჩანაწერები რომლის user_id იქნება ტოლი id_ის -->
    <!-- news_imgs images -->
    <?php foreach ($data['news'] as $news) : ?>
        <?php if ($news->news_imgs_news_id == $data['news'][$i]->news_id) : ?>
            <div class="card-group col-md-2">
                <div class="card " style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo URLROOT_ADMIN; ?>/public/img/<?php echo $news->news_imgs_img_name; ?>" alt="Card image cap">
                    <div class="card-body">
                        <form action="<?php echo URLROOT_ADMIN; ?>/news_admins/deleteNewsImgs/<?php echo $news->news_imgs_id; ?>" method="POST">
                            <input type="hidden" name="delete_image" value="<?php echo $news->news_imgs_img_name; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>



    <!-- end for -->
<?php endfor; ?>



<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>