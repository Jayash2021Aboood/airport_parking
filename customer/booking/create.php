<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/park.php');
  include_once('../../includes/customer.php');
  include_once('../../includes/setting.php');
  checkCustomerSession();


  
  $pageTitle = lang("Add Booking");
  include('../../template/header.php'); 
  $errors = array();
  $setting = GetSetting();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addBooking']))
    {


      $park_id = $_POST['park_id'];

      $customer_id = $_POST['customer_id'];

      $from_date = $_POST['from_date'];

      $to_date = $_POST['to_date'];

      $amount = $_POST['amount'];

      $is_paid = ( isset( $_POST['is_paid']))? 1:0;

      $create_date = $_POST['create_date'];

      if( empty($park_id)){
        $errors[] = "<li>" . lang("Park is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Park is requierd") . "</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>" . lang("Customer is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Customer is requierd") . "</li>";
        }
      if( empty($from_date)){
        $errors[] = "<li>" . lang("FromDate is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("FromDate is requierd") . "</li>";
        }
      if( empty($to_date)){
        $errors[] = "<li>" . lang("ToDate is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("ToDate is requierd") . "</li>";
        }
      if( empty($amount)){
        $errors[] = "<li>" . lang("Amount is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Amount is requierd") . "</li>";
        }
      if( empty($create_date)){
        $errors[] = "<li>" . lang("Create Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Create Date is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addBooking(
                                    $park_id,
                                    $customer_id,
                                    $from_date,
                                    $to_date,
                                    $amount,
                                    $is_paid,
                                    $create_date,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = lang("Booking Added successfuly!");
          $_SESSION["success"] = lang("Booking Added successfuly!");
          header('Location:'. $PATH_CUSTOMER_BOOKING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Adding Data");
          $_SESSION["fail"] = lang("Error when Adding Data");
          $errors[] = lang("Error when Adding Data");
        }
        
      }
  
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
                           <?php echo lang("Add Booking"); ?>
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
                    <div class="card-header">
                        <?php echo lang("Booking Details"); ?> 
                        <h4>
                            <?php echo lang("Amount Per Hour"); ?> 
                            <?php echo $setting[0]['amount_per_hour']; ?> 

                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (park_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="park_id"><?php echo lang("Park"); ?></label>
                                    <select class="form-select" name="park_id" id="park_id" required>
                                        <option selected disabled value=""><?php echo lang("Select a Park"); ?>:</option>
                                        <?php foreach(getAllParks() as $Park) { ?>
                                        <option value="<?php echo $Park['id']; ?>"> <?php echo $Park['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3 d-none">
                                    <label class="small mb-1" for="customer_id"><?php echo lang("Customer"); ?></label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option disabled value=""><?php echo lang("Select a Customer"); ?>:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($_SESSION['userID'] == $Customer['id']) echo ' selected ';?> value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name'] .' '. $Customer['last_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                                <!-- Form Group (from_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="from_date"><?php echo lang("FromDate"); ?></label>
                                    <input class="form-control" id="from_date" name="from_date" type="datetime-local" placeholder="<?php echo lang("FromDate"); ?>"
                                        value="" required  oninput="calculateTotal()">
                                </div>
                                <!-- Form Group (to_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="to_date"><?php echo lang("ToDate"); ?></label>
                                    <input class="form-control" id="to_date" name="to_date" type="datetime-local" placeholder="<?php echo lang("ToDate"); ?>"
                                        value="" required  oninput="calculateTotal()">
                                </div>
                                <!-- Form Group (amount)-->
                                <?php //var_dump($setting); exit(); ?>
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount"><?php echo lang("Amount"); ?></label>
                                    <input class="form-control" id="amount" name="amount" type="text" placeholder="<?php echo lang("Amount"); ?>"
                                         min="0" step="0.01" required readonly value="<?php echo $setting[0]['amount_per_hour']; ?>">

                                         <input class="form-control" id="amount_per_hour" name="amount_per_hour" type="hidden" placeholder="<?php echo lang("Amount"); ?>"
                                         min="0" step="0.01" required  value="<?php echo $setting[0]['amount_per_hour']; ?>">
                                </div>
                                <div class="form-check d-none">
                                    <input class="form-check-input" id="is_paid" name="is_paid"
                                        type="checkbox" />
                                    <label class="form-check-label" for="is_paid"><?php echo lang("Is Paid"); ?></label>
                                </div>
                                <!-- Form Group (create_date)-->
                                <div class="col-md-4 mb-3 d-none">
                                    <label class="small mb-1" for="create_date"><?php echo lang("Create Date"); ?></label>
                                    <input class="form-control" id="create_date" name="create_date" type="datetime-local" placeholder="<?php echo lang("Create Date"); ?>"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addBooking" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>

document.addEventListener('DOMContentLoaded', function () {
    // Get the current date and time in the format required by datetime-local input
    var currentDate = new Date().toISOString().slice(0, 16);

    // Set the default value for the from_date input
    document.getElementById('from_date').value = currentDate;
    document.getElementById('to_date').value = currentDate;
    document.getElementById('create_date').value = currentDate;
    
    // You can set a default to_date as well if needed
    // document.getElementById('to_date').value = currentDate;
    calculateTotal();
});

function calculateTotal() {
    // Get values from inputs
    var amount_per_hour = parseFloat(document.getElementById("amount_per_hour").value) || 0;
    var from_date = new Date(document.getElementById("from_date").value);
    var to_date = new Date(document.getElementById("to_date").value);

    // Calculate the difference in hours
    var timeDiff = Math.abs(to_date - from_date);
    var diffHours = Math.ceil(timeDiff / (1000 * 60 * 60));

    // Calculate total amount
    var total = amount_per_hour * diffHours;

    // Update the "total" input
    document.getElementById("amount").value = total.toFixed(2);
}
</script>

<?php include('../../template/footer.php'); ?>



