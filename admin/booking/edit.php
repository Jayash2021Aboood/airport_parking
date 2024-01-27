<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/park.php');
  include_once('../../includes/customer.php');
  checkAdminSession();

  $pageTitle = lang("Edit Booking");
  //$row = new Booking(null);
   $id =  $park_id =  $customer_id =  $from_date =  $to_date =  $amount =  $is_paid =  $create_date = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getBookingById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $park_id = $row['park_id'];
        $customer_id = $row['customer_id'];
        $from_date = $row['from_date'];
        $to_date = $row['to_date'];
        $amount = $row['amount'];
        $is_paid = ( isset( $row['is_paid']))? 1:0;
        $create_date = $row['create_date'];
      }
      else
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
    if(isset($_POST['updateBooking']))
    {
        $id = $_POST['id'];
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

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateBooking( $id,  $park_id,  $customer_id,  $from_date,  $to_date,  $amount,  $is_paid,  $create_date, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Booking Updated successfuly!");
          $_SESSION["success"] = lang("Booking Updated successfuly!");
          header('Location:'. $PATH_ADMIN_BOOKING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Update Data");
          $_SESSION["fail"] = lang("Error when Update Data");
          $errors[] = lang("Error when Update Data");
        }
        
      }
      else
      {
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            <?php echo lang("Edit Booking"); ?>
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
                    <div class="card-header"><?php echo lang("Booking Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (park_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="park_id"><?php echo lang("Park"); ?></label>
                                    <select class="form-select" name="park_id" id="park_id" required>
                                        <option disabled value=""><?php echo lang("Select a Park"); ?>:</option>
                                        <?php foreach(getAllParks() as $Park) { ?>
                                        <option <?php if($park_id == $Park['id']) echo "selected" ?> value="<?php echo $Park['id']; ?>"> <?php echo $Park['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id"><?php echo lang("Customer"); ?></label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option disabled value=""><?php echo lang("Select a Customer"); ?>:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($customer_id == $Customer['id']) echo "selected" ?> value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (from_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="from_date"><?php echo lang("FromDate"); ?></label>
                                    <input class="form-control" id="from_date" name="from_date" type="datetime-local" placeholder="<?php echo lang("FromDate"); ?>"
                                        value="<?php echo $from_date;?>" required />
                                </div>
                                <!-- Form Group (to_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="to_date"><?php echo lang("ToDate"); ?></label>
                                    <input class="form-control" id="to_date" name="to_date" type="datetime-local" placeholder="<?php echo lang("ToDate"); ?>"
                                        value="<?php echo $to_date;?>" required />
                                </div>
                                <!-- Form Group (amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount"><?php echo lang("Amount"); ?></label>
                                    <input class="form-control" id="amount" name="amount" type="text" placeholder="<?php echo lang("Amount"); ?>"
                                        value="<?php echo $amount;?>" required />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="is_paid" name="is_paid"
                                        type="checkbox"
                                        <?php if($is_paid == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="is_paid"><?php echo lang("Is Paid"); ?></label>
                                </div>
                                <!-- Form Group (create_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="create_date"><?php echo lang("Create Date"); ?></label>
                                    <input class="form-control" id="create_date" name="create_date" type="Date" placeholder="<?php echo lang("Create Date"); ?>"
                                        value="<?php echo $create_date;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateBooking" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

