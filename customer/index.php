<?php
  session_start();
  include('../includes/lib.php');
  $pageTitle = "Home";

  ?>

<?php include('../template/header.php'); ?>
<?php include('../template/startNavbar.php'); ?>

<main>
    <header class="py-10  mb-4 bg-img-cover overlay overlay-60">
        <!-- style="background-image: url('../assets/img/demo/demo-ocean-lg.jpg'); min-height: 500px; height: 500px;" -->
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
            <h1 class="text-white z-2"><?php echo lang("Welcome to Airport Parking"); ?></h1>
                <p class="lead mb-0 text-white-75 z-2"><?php echo lang("book your park now!"); ?>
            </div>
        </div>
    </header>
    <!-- Main page content-->


</main>



<?php include('../template/footer.php') ?>