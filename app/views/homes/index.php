<?php require APPROOT . '/views/inc/header.php'; ?>
<header id="carousel" class="home-section carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
    <div class="carousel-inner">
      <div class="carousel-item item item-one"></div>
      <div class="carousel-item item active item-two"></div>
      <div class="carousel-item item item-three"></div>
      <div class="home-inner container">
        <div class="row justify-content-start">
          <div class="col-lg-7 col-md-8">
            <div class="card home-card text-light">
              <div class="card-body">
                <h1 class="card-title home-title text-uppercase">hello & welcome!</h1>
                <p class="card-text home-text">Please have a sit, our wine will be served!</p>
                <button class="homebtn btn btn-link">View more <span><img src="<?php echo URLROOT;?>/img/next.png"
                      alt=""></span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
<?php require APPROOT . '/views/inc/footer.php'; ?>
