<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  

  <?php switch(true){
    case LANG == 'en' :?>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/home.css">
    <?php break;
    case LANG == 'ge' :?>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/home-ge.css">
    <?php break;
    case LANG == 'ru' :?>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/home-ge.css">
    <?php break;
    default :?>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/home.css">
  <?php }?>  
  
  <link rel="stylesheet" href="<?php echo URLROOT;?>/css/fonts.css">
  

  <title>Home Wine</title>
</head>

<body>

<?php require APPROOT . '/views/inc/navbar.php';?>