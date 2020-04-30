<?php
function redirect($page){
    header('location: '.URLROOT.'/'.$page);
}

function redirect_admin($page){
    header('location: '.URLROOT.'/'.$page);
}