<?php
function redirect($page){
    header('location: '.URLROOT.'/'.$page);
}

function redirect_admin($page, $id = null){
    header('location: '.URLROOT_ADMIN.'/'.$page ."/$id");
}