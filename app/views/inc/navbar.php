
<nav id="topNav"
    class="navbar topnavbar navbar-expand-lg bg-dark fixed-top navbar-toggleable-sm navbar-inverse bg-inverse">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right text-light" data-toggle="collapse"
        data-target=".navbarcollapse">☰</button>
      <div class="navbar-collapse collapse navbarcollapse">
        <ul class="nav navbar-nav left-nav">
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][0]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][1]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][2]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][3]->menuTitle;?></a>
          </li>
        </ul>
      </div>
      <a class="navbar-brand mx-auto text-uppercase text-center" href="#"><img class="logo-top"
          src="<?php echo URLROOT?>/img/LOGO_ge.png" alt="logo"><span class="logo-text-top">twins old cellar</span></a>
      <div class="navbar-collapse collapse navbarcollapse">
        <ul class="nav navbar-nav right-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][4]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][5]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][6]->menuTitle;?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase nav-items" href="#"><?php echo $data['menu'][7]->menuTitle;?></a>
          </li>
        </ul>
      </div>
      <div class="searchlan">
        <ul class="searchlan-list">
          <li class="searchlan-list-item search left">
            <input type="text" class="search-hover border-0 rounded-0" name="" placeholder="search...">
          </li>
          <li class="searchlan-list-item dropdown right">
          

            <button class="btn lanbtn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              
              <?php switch(true){
                case LANG == 'en' : ?>
                  EN
                <?php break;
                case LANG  == 'ge' : ?>
                  ქარ
                <?php break; 
                case LANG  == 'ru' : ?>
                 RU
                <?php break;
                 default : ?>
                  EN
              <?php }?>
              
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <a class="dropdown-item en" type="button" href="<?php echo URLROOT.'/en/'.isset($_GET['url']);?>">EN</a>
              <a class="dropdown-item ge" type="button" href="<?php echo URLROOT.'/ge/'.isset($_GET['url']);?>">ქარ</a>
              <a class="dropdown-item ru" type="button" href="<?php echo URLROOT.'/ru/'.isset($_GET['url']);?>">RU</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  

 