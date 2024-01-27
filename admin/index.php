<?php
  session_start();
  include('../includes/lib.php');
  $pageTitle = "Home";

  checkAdminSession();
  ?>

<?php include('../template/header.php'); ?>


<?php include('../template/startNavbar.php'); ?>


<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">

        <!-- Illustration dashboard card example-->
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Welcome back, your dashboard is ready!</h2>
                        <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view sales,
                            generate links, prepare coupons, and download affiliate reports using this dashboard.</p>
                        <a class="btn btn-primary p-3" href="#!">
                            Get Started
                            <i class="ms-1" data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5"
                            src="<?php echo $PATH_SERVER ?>assets/img/illustrations/statistics.svg" /></div>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-pink h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-pink mb-3 text-center">Parks (count)</div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from park;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-secondary mb-3 text-center">Employee (count)</div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from employee;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-success mb-3 text-center">Customer (count)</div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from customer;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard orange widget 2-->
                <div class="card border-start-lg border-start-orange h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-orange mb-3 text-center">Booking (count)</div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from booking;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>


<?php include('../template/footer.php') ?>