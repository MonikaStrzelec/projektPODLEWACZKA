<?php
    session_start();
    if(file_exists('config/connect.php')){
        require_once('config/connect.php');
    } else {
        require_once('installer/step1.php');
    }

    if(!isset($_SESSION['logged'])){
        if(file_exists('templates/header.php')) include('templates/header.php');
    } else {
        if($_SESSION['userRank'] == 1){
            if(file_exists('templates/headerForAdmin.php')) include('templates/headerForAdmin.php');
        } else{
            if(file_exists('templates/headerForUsers.php')) include('templates/headerForUsers.php');
        }
    }
    if(file_exists('templates/optionalHeader.php')) include('templates/optionalHeader.php');
    if(file_exists('main.php')) include('main.php');
    if(file_exists('templates/footer.php')) include('templates/footer.php'); 
?>