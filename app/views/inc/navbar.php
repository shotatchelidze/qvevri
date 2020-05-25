<nav id="topNav" class="navbar topnavbar navbar-expand-lg bg-dark fixed-top navbar-toggleable-sm navbar-inverse bg-inverse">
  <div class="container">
    <button class="navbar-toggler navbar-toggler-right text-light" data-toggle="collapse" data-target=".navbarcollapse">☰</button>
    <div class="navbar-collapse collapse navbarcollapse">
      <ul class="nav navbar-nav left-nav">
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                HOME
              <?php break;
              case LANG  == 'ge': ?>
                მთავარი
              <?php break;
              case LANG  == 'ru': ?>
                дом
              <?php break;
              default: ?>
                HOME
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                HOTEL
              <?php break;
              case LANG  == 'ge': ?>
                სასტუმრო
              <?php break;
              case LANG  == 'ru': ?>
                Гостиница
              <?php break;
              default: ?>
                HOTEL
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                MUSEUM
              <?php break;
              case LANG  == 'ge': ?>
                მუზეუმი
              <?php break;
              case LANG  == 'ru': ?>
                Гостиница
              <?php break;
              default: ?>
                MUSEUM
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                RESTAURANT
              <?php break;
              case LANG  == 'ge': ?>
                რესტორანი
              <?php break;
              case LANG  == 'ru': ?>
                Гостиница
              <?php break;
              default: ?>
                RESTAURANT
            <?php } ?>
          </a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand mx-auto text-uppercase text-center" href="#"><img class="logo-top" src="<?php echo URLROOT;?>/img/<?php echo $data['menu_logo']->img_name;?>" 
    alt="logo"><span class="logo-text-top"><?php echo $data['menu_logo']->title;?></span></a>
    <div class="navbar-collapse collapse navbarcollapse">
      <ul class="nav navbar-nav right-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                ACTIVITY
              <?php break;
              case LANG  == 'ge': ?>
                ღონისძიებები
              <?php break;
              case LANG  == 'ru': ?>
                ДЕЯТЕЛЬНОСТЬ
              <?php break;
              default: ?>
                ACTIVITY
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                WINE SHOP
              <?php break;
              case LANG  == 'ge': ?>
                ღვინის მაღაზია
              <?php break;
              case LANG  == 'ru': ?>
                ВИННЫЙ МАГАЗИН
              <?php break;
              default: ?>
                WINE SHOP
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                LAKE
              <?php break;
              case LANG  == 'ge': ?>
                ტბა
              <?php break;
              case LANG  == 'ru': ?>
                ОЗЕРО
              <?php break;
              default: ?>
                LAKE
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-items" href="#">
            <?php switch (true) {
              case LANG == 'en': ?>
                CONTACT
              <?php break;
              case LANG  == 'ge': ?>
                კონტაკტი
              <?php break;
              case LANG  == 'ru': ?>
                CONTACT
              <?php break;
              default: ?>
                CONTACT
            <?php } ?>
          </a>
        </li>
      </ul>
    </div>
    <div class="searchlan">
      <ul class="searchlan-list">
        <li class="searchlan-list-item search left">
          <input type="text" class="search-hover border-0 rounded-0" name="" placeholder="search...">
        </li>
        <li class="searchlan-list-item dropdown right">


          <button class="btn lanbtn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <?php switch (true) {
              case LANG == 'en': ?>
                EN
              <?php break;
              case LANG  == 'ge': ?>
                ქარ
              <?php break;
              case LANG  == 'ru': ?>
                RU
              <?php break;
              default: ?>
                EN
            <?php } ?>

          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a class="dropdown-item en" type="button" href="<?php echo URLROOT . '/en/' . $_GET['url']; ?>">EN</a>
            <a class="dropdown-item ge" type="button" href="<?php echo URLROOT . '/ge/' . $_GET['url']; ?>">ქარ</a>
            <a class="dropdown-item ru" type="button" href="<?php echo URLROOT . '/ru/' . $_GET['url']; ?>">RU</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>