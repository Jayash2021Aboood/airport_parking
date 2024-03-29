<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/booking.php');

  checkEmployeeSession();

  $pageTitle = lang("Delete Booking");
  $row = new Booking(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = lang('Are You Sure Want to Delete?');
      $id = $_GET['id'];
      $result = getBookingById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = lang('There is No data for this id');
          $_SESSION["fail"] = lang('There is No data for this id');
      }

    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
    }

  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['deleteBooking']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteBooking($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Booking Deleted successfuly!");          
          $_SESSION["success"] = lang("Booking Deleted successfuly!");          
          header('Location:'. $PATH_EMPLOYEE_BOOKING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Delete Data");
          $_SESSION["fail"] = lang("Error when Delete Data");

          $errors[] = lang("Error when Delete Data");
        }
      }
      else
      {
        $_SESSION["message"] = lang('No data for Delete');
        $_SESSION["fail"] = lang('No data for Delete');
      }
    }
    else
    {
      $_SESSION["message"] = lang('No data for Delete');
      $_SESSION["fail"] = lang('No data for Delete');
    }

  }

?>

<?php include('../../template/startNavbar.php'); ?>

<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            <?php echo lang("Delete Booking"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Bookings List"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Booking details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Booking Details"); ?> <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (park_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="park_id"><?php echo lang("Park"); ?></label>
                                    <input class="form-control" id="park_id" name="park_id" type="text" placeholder="<?php echo lang("Park"); ?>"
                                        value="<?php echo $row['park_id'];?>" readonly />
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id"><?php echo lang("Customer"); ?></label>
                                    <input class="form-control" id="customer_id" name="customer_id" type="text" placeholder="<?php echo lang("Customer"); ?>"
                                        value="<?php echo $row['customer_id'];?>" readonly />
                                </div>
                                <!-- Form Group (from_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="from_date"><?php echo lang("FromDate"); ?></label>
                                    <input class="form-control" id="from_date" name="from_date" type="text" placeholder="<?php echo lang("FromDate"); ?>"
                                        value="<?php echo $row['from_date'];?>" readonly />
                                </div>
                                <!-- Form Group (to_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="to_date"><?php echo lang("ToDate"); ?></label>
                                    <input class="form-control" id="to_date" name="to_date" type="text" placeholder="<?php echo lang("ToDate"); ?>"
                                        value="<?php echo $row['to_date'];?>" readonly />
                                </div>
                                <!-- Form Group (amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount"><?php echo lang("Amount"); ?></label>
                                    <input class="form-control" id="amount" name="amount" type="text" placeholder="<?php echo lang("Amount"); ?>"
                                        value="<?php echo $row['amount'];?>" readonly />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="is_paid" name="is_paid"
                                        type="checkbox" disabled
                                        <?php if($row['is_paid'] == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="is_paid"><?php echo lang("Is Paid"); ?></label>
                                </div>
                                <!-- Form Group (create_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="create_date"><?php echo lang("Create Date"); ?></label>
                                    <input class="form-control" id="create_date" name="create_date" type="text" placeholder="<?php echo lang("Create Date"); ?>"
                                        value="<?php echo $row['create_date'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deleteBooking" class="btn btn-danger" type="submit"><?php echo lang("Delete"); ?></button>
                            <a href="index.php" class="btn btn-primary" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
