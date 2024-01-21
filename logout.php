<?php
    session_start();
    session_destroy();
    unset($_SESSION["userID"]);
    unset($_SESSION["user"]);
    unset($_SESSION["userType"]);
    $_SESSION["message"] = "You are Logged Out!";
    header('location: login.php');
?>