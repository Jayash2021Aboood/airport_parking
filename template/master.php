<?php
    if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
    {
        die("<h2>Access Denied!</h2> This file is protected and not available to public."); 
    } 
    include_once('C:/xampp/htdocs/BaidaLibrary/admin/includes/lib.php');
    if (!(isset($_SESSION['adminID'])) || !(isset($_SESSION['adminName']))) 
    {
        header('Location:'. $PATH_ADMIN .'login.php');
    }
    // if(isset($loginRequire))
    // {
    //     if($loginRequire == true)
    //     {
    //         if (!(isset($_SESSION['adminID'])) || !(isset($_SESSION['adminName']))) 
    //         {
    //             header('Location:'. $PATH_ADMIN .'login.php');
    //             //echo $_SESSION['adminID'];
    //             //echo '<script> window.location.replace("login.php"); </script>';
    //         }
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(DIR_ADMIN_TEMPLATE . 'header.php'); ?>
</head>

<body class="nav-fixed bg-white">

    <?php include_once(DIR_ADMIN_TEMPLATE . 'navbar.php'); ?>



    <?php include_once(DIR_ADMIN_TEMPLATE . 'afterLoad.php'); ?>

</body>

</html>