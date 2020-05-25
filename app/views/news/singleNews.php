<?php require APPROOT . '/views/inc/header.php'; ?>
<header class="header-single-news">
        <div class="header-news-dark-bg">
            <div class="container">
                <img class="header-news-logo" src="<?php echo URLROOT;?>/img/<?php echo $data['logo']->img_name;?>" alt="logo">
                <p class="header-news-text text-capitalize"><?php echo $data['logo']->title;?></p>
            </div>
        </div>
        <style>
        .header-single-news{
          background-image: url("<?php echo URLROOT; ?>/img/<?php echo $data['imageBgs']->image_name; ?>");
        }
        </style>    
    </header>
    

    <section class="single-news-newssection">
        <div class="container">
            <div class="single-news-newssection-main">
                <p class="single-news-newssection-main-text"><span
                        class="single-news-newssection-main-textmain">main
                    </span><img class="single-news-newssection-main-next" src="../qvevri/img/next.png" alt=""><span
                        class="single-news-newssection-main-textsub"> blog/news </span><img
                        class="single-news-newssection-main-next" src="../qvevri/img/next.png" alt=""><span
                        class="single-news-newssection-main-textsub-sub"> news</span>
                </p>
            </div>
        </div>
        <div class="single-news-newssection-news">
            <div class="container">
                <div class="card flex-row single-news-card rounded-0 border-0">
                    <div class="card-header col-lg-7 border-0 single-news-card-header">
                        <img src="<?php echo URLROOT;?>/img/<?php echo $data['single_news']->news_img_name;?>" alt="">
                    </div>
                    <div class="card-body col-lg-5 single-news-card-body">
                        <h4 class="card-title single-news-card-title"><?php echo multilanguage_date($data['single_news']->created_at);?></h4>
                        <p class="card-text single-news-card-text"><?php echo $data['single_news']->subtitle;?></p>
                    </div>
                </div>
                <div class="single-news-article">
                    <p class="single-news-article-text"><span><?php echo $data['single_news']->text;?></span><span>Brothers Gia and Gela
                            Gamtkitsulashvili The world's unique "Qvevri and Qvevri Wine Museum" was founded in 2014.
                            The brothers Gia and Gela Gamtkitsulashvili in the world unique "Qvevri and Qvevri Wine
                            Museum" in 2014 Founded by the brothers Gia and Gela Gamtkitsulashvili in the world unique
                            "pitcher and pitcher Wine Museum "was founded in 2014. Brothers Gia and Gela
                            Gamtkitsulashvili in the world The unique "Pitcher and Pitcher Wine Museum" was founded in
                            2014.</span></p>
                </div>
                <div class="row">
                    <?php foreach($data['single_news']->images as $image):?>
                    <div class="col-lg-3 col-md-6 col-sm-6 news-picture-col">
                        <img src="<?php echo URLROOT;?>/img/<?php echo $image->img_name;?>" alt="photo">
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="single-news-newssection-sub">
                <p class="single-news-newssection-sub-text"><span>other news/blogs </span><img
                        src="../qvevri/img/next.png" alt=""></p>
            </div>
        </div>
    </section>
<?php require APPROOT . '/views/inc/footer.php'; ?>
