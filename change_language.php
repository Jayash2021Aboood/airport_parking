<?php
  session_start();
  include('includes/lib.php');
  
//   var_dump($_SESSION);
// //   var_dump($_SERVER);
// //   print_r($_SERVER);
//   print_r($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
//   exit();
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
        $_SESSION['lang'] = $lang;

        changeLanguage($lang);

    } else {
        if( !isset($_SESSION['lang']) || empty($_SESSION['lang'])) {
            changeLanguage();
        }
    }
    


    // print($_SERVER['HTTP_REFERER'] .'</br>');
    // print($_SERVER['REQUEST_URI']);
    // //  print_r($_SERVER);
    // // print($_SERVER['HTTP_HOST']);
    // print($_SERVER['PHP_SELF']);
    // print('<a href="http://localhost/airport_parking/change_language.php"> click </a>');
    // exit();
    // =======================================================================
    // ======================== Customer Adding Booking ======================
    // =======================================================================

  }
    if(!isset($_SERVER['HTTP_REFERER']) || 
    (isset($_SERVER['HTTP_REFERER']) && $_SERVER['REQUEST_URI'] !=  $_SERVER['PHP_SELF'])) {
        header("Location: index.php");
    }
    else{
        redirectToReferer();
    }
//   redirectToReferer();
?>