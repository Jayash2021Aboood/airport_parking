<?php
  session_start();
  include('includes/lib.php');
  include('includes/park.php');
  include('includes/booking.php');
  $pageTitle = "Home";

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main class="mt-1">
    <header class="d-md-block py-10  mb-4 bg-img-cover">
        <!-- style="background-image: url('assets/img/backgrounds/library3.jpeg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;" -->
        <div class="container-xl p-0 overlay overlay-60 overlay-black">
            <div class="text-center  z-1 text-white mb-0">
                <h1 class="text-white z-2"><?php echo lang("Welcome to Airport Parking"); ?></h1>
                <p class="lead mb-0 text-white-75 z-2"><?php echo lang("book your park now!"); ?>
                </p>
            </div>
        </div>
    </header>

    <div class="container-xl px-4">
        <div class="row justify-content-center">
        </div>
    </div>
</main>












<?php include('template/footer.php') ?>