<?php require APPROOT . '/views/inc/header.php'; ?>

<header class="header-news">
    <div class="header-news-dark-bg">
        <div class="container">
            <img class="header-news-logo" src="<?php echo URLROOT; ?>/img/<?php echo $data['logo'][0]->img_name; ?>" alt="logo">
            <p class="header-news-text text-capitalize"><?php echo $data['logo'][0]->title; ?></p>
        </div>
    </div>
</header>

<section class="news-newssection">
    <div class="container">
        <div class="news-newssection-main">
            <p class="news-newssection-main-text"><span class="news-newssection-main-textmain">main
                </span><img class="news-newssection-main-next" src="../qvevri/img/next.png" alt=""><span class="news-newssection-main-textsub"> blogs / news</span></p>
        </div>
    </div>
    <div class="news-newssection-news">
        <div class="container">
            <div class="row">
                <?php foreach ($data['news'] as $news) : ?>
                    <div class="col-md-4">
                        <div class="card news-card">
                            <img class="card-img-top rounded-0" src="<?php echo URLROOT; ?>/img/<?php echo $news->news_img_name; ?>" alt="photo">
                            <div class="card-body">
                                <p class="news-date-text"><?php echo multilanguage_date($news->created_at); ?></p>
                                <h1 class="card-title news-card-title"><?php echo $news->title; ?></h1>
                                <p class="card-text news-card-text"><?php echo substr($news->text, 0, 100) . '...' ?></p>
                                <a class="newsbtn btn btn-link" href="<?php echo URLROOT;?>/news/singleNews/<?php echo $news->item_id;?>">read more ></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="news-newssection-pagination">
            <ul class="news-pagination">
                    
                <?php for ($page = 1; $page <= $data['number_of_pages']; $page++) : ?>
                    <a href="<?php echo URLROOT_ADMIN; ?>/News?page=<?php echo $page; ?>"><?php echo $page; ?></a>  
                <?php endfor; ?>

                <li class="news-pagination-item news-pagination-item-active">
                    <a class="news-pagination-link news-pagination-link-active" href="#">1</a>
                </li>
                <li class="news-pagination-item">
                    <a class="news-pagination-link" href="#">2</a>
                </li>
                <li class="news-pagination-item">
                    <a class="news-pagination-link" href="#">3</a>
                </li>
                <li class="news-pagination-item">
                    <a class="news-pagination-link" href="#">4</a>
                </li>
                <li class="news-pagination-item">
                    <a class="news-pagination-link" href="#">5</a>
                </li>
                <li class="news-pagination-item">
                    <a class="news-pagination-link" href="#">6</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>