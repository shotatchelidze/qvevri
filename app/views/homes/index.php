<?php require APPROOT . '/views/inc/header.php'; ?>

<header id="carousel" class="home-section carousel slide carousel-fade" data-ride="carousel" data-interval="4000">

  <div class="carousel-inner">
    <?php $i = 0;
    foreach ($data['image_bgs'] as $image) : ?>
      <style>
        .item-<?php echo $i; ?> {
          background-image: url("<?php echo URLROOT; ?>/img/<?php echo $image->image_name; ?>");
        }
      </style>
      <div class="carousel-item item item-<?php echo $i + 1; ?>"></div>
    <?php $i++;
    endforeach; ?>
    <div class="carousel-item item active item-0"></div>

    <div class="home-inner container">
      <div class="row justify-content-start">
        <div class="col-lg-7 col-md-8">
          <div class="card home-card text-light">
            <div class="card-body">
              <h1 class="card-title home-title text-uppercase"><?php echo $data['description']->title;?></h1>
              <p class="card-text home-text"><?php echo $data['description']->subtitle;?></p>
              <?php if(LANG == 'en'){?>
              <button class="homebtn btn btn-link">View more<span><img src="../img/next.png" alt=""></span></button>
              <?php } elseif(LANG == 'ge') {?>
              <button class="homebtn btn btn-link">გაიგეთ მეტი<span><img src="../img/next.png" alt=""></span></button>
              <?php } else {?>
              <button class="homebtn btn btn-link">смотреть больше<span><img src="../img/next.png" alt=""></span></button>
              <?php }?>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="first-section">
  <div class="container">
    <div class="twinshotel">
      <div class="row justify-content-end">
        <div class="col-lg-7 col-md-8">
          <div class="media media-shadow twinshotel-media">
            <style>
              .twinshotel {
                background-image: url("<?php echo URLROOT; ?>/img/<?php echo $data['sections'][0]->img_name; ?>");
              }
            </style>
            <span class="icon-bg"><img src="<?php echo $data['sections'][0]->icon_img_name; ?>" alt="icon"></span>
            <div class="media-body">
              <h1 class="text-capitalize"><?php echo $data['sections'][0]->title; ?></h1>
              <p><?php echo $data['sections'][0]->text; ?></p>
              <?php if(LANG == 'en'){?> 
              <button class="mediabtn btn btn-link">View more <span><img src="../img/next.png" alt=""></span></button>
              <?php } elseif(LANG == 'ge') {?>
                <button class="mediabtn btn btn-link">View more <span><img src="../img/next.png" alt=""></span></button>
                <?php } else {?>
              <button class="homebtn btn btn-link">смотреть больше<span><img src="../img/next.png" alt=""></span></button>
              <?php }?>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="museum">
      <div class="row justify-content-start">
        <div class="col-lg-7 col-md-8">
          <div class="media media-shadow museum-media">
            <style>
              .twinshotel-media {
                background-image: url("<?php echo URLROOT; ?>/img/<?php echo $data['sections'][1]->img_name; ?>");
              }
            </style>
            <span class="icon-bg"><img src="<?php echo $data['sections'][1]->icon_img_name; ?>" alt="icon"></span>
            <div class="media-body">
              <h1 class="text-capitalize"><?php echo $data['sections'][1]->title; ?></h1>
              <p><?php echo $data['sections'][1]->text; ?></p>
              <button class="mediabtn btn btn-link">View more <span><img src="../img/next.png" alt=""></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="restaurant">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-lg-7 col-md-8">
        <div class="media restaurant-media">
          <style>
            .restaurant {
              background-image: url("<?php echo URLROOT; ?>/img/<?php echo $data['sections'][1]->img_name; ?>");
            }
          </style>
          <style>
            .restaurant-media {
              background-image: url("<?php echo URLROOT; ?>/img/<?php echo $data['sections'][1]->bg_image_name; ?>");
            }
          </style>
          
          <div class="media-body restaurant-media-body text-center">
            <h1 class="text-capitalize text-center"><?php echo $data['sections'][1]->title; ?></h1>
            <p class="text-center"><?php echo $data['sections'][1]->text; ?></p>
            <button class="restaurantbtn btn btn-outline-light"><?php if(LANG == 'en'){?>read more ><?php } elseif(LANG == 'ge'){?> გაიგეთ მეტი > <?php } else {?> смотреть больше<?php }?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="second-section">
  <div class="container">
    <div class="activity">
      <div class="row justify-content-start">
        <div class="col-lg-7 col-md-8">
          <div class="media media-shadow activity-media">
            <span class="icon-bg"><img src="../qvevri/img/ico2.png" alt="icon"></span>
            <div class="media-body">
              <h1 class="text-capitalize">activity</h1>
              <ul class="activity-lists">
                <li>
                  <p>Tours</p>
                </li>
                <li>
                  <p>Visiting Museum</p>
                </li>
                <li>
                  <p>Grape Harvest</p>
                </li>
              </ul>
              <ul class="activity-lists">
                <li>
                  <p>Wine Degustation</p>
                </li>
                <li>
                  <p>Activities</p>
                </li>
                <li>
                  <p>Masterclasses</p>
                </li>
              </ul>
              <button class="mediabtn btn btn-link">View more <span><img src="../qvevri/img/next.png" alt=""></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="wineshop">
      <div class="row justify-content-end">
        <div class="col-lg-7 col-md-8">
          <div class="media media-shadow wineshop-media">
            <span class="icon-bg"><img src="../qvevri/img/shopp.png" alt="icon"></span>
            <div class="media-body">
              <h1 class="text-capitalize">Wine Shop</h1>
              <p>Wine producing of ''Twins Wine Cellar in Napareuli'' is based on the oldest Kakhetian method, such as
                producing wine in Qvevri (large earthenware vessel used for the fermentation, storage and ageing of
                traditional Georgian wine)
                In 2013, UNESCO added the traditional Georgian method of making wine in kvevris to it’s list of
                intangible cultural heritage</p>
              <button class="mediabtn btn btn-link">View more <span><img src="../qvevri/img/next.png" alt=""></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="napareuli">
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-lg-7 col-md-8">
        <div class="media napareuli-media">
          <div class="media-body napareuli-media-body text-center">
            <h1 class="text-capitalize">napareuli & twin's lake</h1>
            <p>Twins Wine Cellar invites you to the restaurant Qvevris Mze where you can experience cozy and family
              environment. Here you can taste delicious and tastiest dishes cooked by local chefs and of course Qvevri
              wine Qvevris Mze produced according to the oldest twin’s wine-making traditions that offers you wide
              range of biologically clean wines. Our restaurant is ideal place for hosting your family gatherings,
              having nice time with your friends in a cozy environment, holding various events. Qvevris Mze accepts
              privet as well as corporate orders.</p>
            <button class="napareulibtn btn btn-outline-light">View more</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="news">
  <div class="container">
    <img class="newslogo" src="<?php echo URLROOT;?>/img/<?php echo $data['logos'][0]->img_name;?>" alt="logo">
    <p class="news-text text-capitalize"><?php echo $data['logos'][0]->title;?></p>
    <div class="row">
      <?php foreach($data['news'] as $news):?>
      <div class="col-md-4">
        <div class="card news-card">
          <img class="card-img-top rounded-0" src="<?php echo URLROOT;?>/img/<?php echo $news->news_img_name;?>" alt="photo">
          <div class="card-body">
            <p class="news-date-text"><?php echo multilanguage_date($news->created_at);?></p>
            <h1 class="card-title news-card-title"><?php echo $news->subtitle;?></h1>
            <p class="card-text news-card-text"><?php echo substr($news->text,0,100).'...';?></p>
      <a class="newsbtn btn btn-link" href="#"><?php if(LANG == 'en'){?>read more ><?php } elseif(LANG == 'ge'){?> გაიგეთ მეტი > <?php } else {?> смотреть больше<?php }?></a>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</section>

<section class="map">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="media map-media">
          <div class="media-body media-shadow map-media-body">
            <div class="map-icon-holder">
              <img class="map-icon-1" src="../qvevri/img/grape.png" alt="icon">
              <img class="map-icon-2" src="../qvevri/img/LOGO_ge.png" alt="icon">
              <img class="map-icon-3" src="../qvevri/img/grape.png" alt="icon">
            </div>
            <p class="text-uppercase map-text">twins old cellar</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>