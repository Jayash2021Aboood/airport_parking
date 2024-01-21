<!DOCTYPE html>
<html lang="<?php echo(getCurrentLanguage()); ?>">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php getTitle() ?></title>
    <link href="<?php echo $PATH_SERVER ?>css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $PATH_SERVER ?>assets/font-awesome/6.1.1/css/all.min.css" />
    <!-- <link href="<?php //echo $PATH_SERVER ?>assets/fontawesome-6.3.0/css/fontawesome.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php //echo $PATH_SERVER ?>assets/fontawesome-6.3.0/css/all.min.css" rel="stylesheet" /> -->


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="<?php echo $PATH_SERVER ?>css/custom.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?php echo $PATH_SERVER ?>assets/img/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />

    <?php if(getCurrentLanguage() == "ar"){ ?>
    <!-- adding Arabic style if the current language is Arabic  -->
    <link href="<?php echo $PATH_SERVER ?>css/ar_custom.css" rel="stylesheet" />
    <?php } ?>

    <!-- <script data-search-pseudo-elements="" defer="" src="<?php //echo $PATH_SERVER ?>js/font-awesome-6.1.1/all.min.js" -->
    <!-- crossorigin="anonymous"></script> -->

    <!-- <script defer="" src="<?php //echo $PATH_SERVER; ?>js/fontawesome-6.3.0/all.min.js"></script> -->
    <script data-search-pseudo-elements="" defer="" src="<?php echo $PATH_SERVER ?>js/font-awesome-6.1.1/all.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo $PATH_SERVER ?>js/feather-icons/feather.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo $PATH_SERVER ?>js/jquery3.6.0.js"></script>
</head>

<!-- <body dir="rtl" class="nav-fixed bg-white"> -->
<?php if(isset($_SESSION['lang']) && !is_null($_SESSION['lang']) && $_SESSION['lang'] == "ar"){ ?>

<body dir="rtl" class="layout-rtl nav-fixed bg-white">
    <?php } else{ ?>

    <body dir="ltr" class="nav-fixed bg-white">
        <?php }  ?>