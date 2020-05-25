<!-- homes page -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
  <title>Qvevri Wine</title>
</head>

<body>

  <div id="carousel" class="carousel slide bg carousel-fade" data-ride="carousel" data-interval="4000">
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
    </div>
    
    <div class="dark-bg">
      <div class="container">
        <div class="row text-center logorow">
          <?php foreach ($data['logos'] as $logo) : ?>
            <div class="col-lg-3 col-sm-6 mobile block1">
              <img class="logo logo1 logoblock1" src="<?php echo URLROOT; ?>/img/<?php echo $logo->img_name; ?>" alt="logo">
              <h1 class="text-light header1 text-capitalize"><?php echo $logo->title; ?></h1>
              <!-- gasasworebeli span ebi -->
              <p class="text-capitalize"><span><?php echo $logo->subtitle; ?></span><span></span></p>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
      <ul class="nav nav-pills nav-language fixed-bottom justify-content-center text-center">
        <li class="nav-item">
          <a href="<?php echo URLROOT . '/ge/'; ?>" class="nav-link">GE</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URLROOT . '/en/'; ?>" class="nav-link">EN</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URLROOT . '/ru/'; ?>" class="nav-link">RU</a>
        </li>
      </ul>
      <ul class="nav nav-media fixed-bottom justify-content-center icon-list">
        <li class="nav-item">
          <a href="#" class="nav-link icon-center"><span class="logo-bg fab fa-facebook-f iconcircle"></span></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link icon-center"><span class="logo-bg2 fab fa-twitter iconcircle2"></span></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link icon-center"><span class="logo-bg fab fa-linkedin-in iconcircle"></span></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link icon-center"><span class="logo-bg fab fa-instagram iconcircle"></span></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link icon-center"><span class="logo-bg fab fa-youtube iconcircle"></span></a>
        </li>
      </ul>
    </div>
  </div>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script src="<?php echo URLROOT; ?>/public/js/carousel.js"></script>

</body>

</html>