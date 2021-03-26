<?php
    if(!isset($_SESSION['login_admin'])){
        #unset($_SESSION['login']);
        header('location: login_admin.html');
    }
?>