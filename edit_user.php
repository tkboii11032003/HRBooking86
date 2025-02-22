<?php
    //  include 'header.php';
    // //  include 'navbar.php';
    //   include 'sidebar_menu.php';

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    
    if ($act == 'edit' && !empty($id)) {
        include 'edit.php';
    } else {
        include 'edit_list.php';
    }
    
?>