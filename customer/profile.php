<?php
  session_start();

  include('../includes/lib.php');
  include_once('../includes/customer.php');
  checkCustomerSession();

  $pageTitle = "My Profile";
  
   $id =  $first_name =  $last_name =  $phone =  $email =  $password = "";
  
  include('../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    
      $_SESSION["message"] = '';
      $id = $_SESSION['userID'];
      $result = getCustomerById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $_SESSION['userID'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $password = $row['password'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateCustomer']))
    {
        $id = $_SESSION['userID'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
      if( empty($first_name)){
        $errors[] = "<li>First Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>First Name is requierd.</li>";
        }
      if( empty($last_name)){
        $errors[] = "<li>Last Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Last Name is requierd.</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>Phone is requierd.</li>";
        $_SESSION["fail"] .= "<li>Phone is requierd.</li>";
        }
      if( empty($email)){
        $errors[] = "<li>Email is requierd.</li>";
        $_SESSION["fail"] .= "<li>Email is requierd.</li>";
        }
      if( empty($password)){
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getCustomerById($id);
        if( count( $result ) > 0)
          $row = $result[0];
          $email = $row['email'];
        
        $update = updateCustomer( $id,  $first_name,  $last_name,  $phone,  $email,  $password, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Data Updated successfuly!";
          $_SESSION["success"] = "Data Updated successfuly!";
          header('Location:index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Update Data";
          $_SESSION["fail"] = "Error when Update Data";
          $errors[] = "Error when Update Data";
        }
        
      }
      else
      {
        redirectToReferer();
      }
  
    }
  }
?>

<?php include('../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            My Profile
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Home
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
                <!-- Customer details card-->
                <div class="card mb-4">
                    <div class="card-header">My Profile Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                        placeholder="First Name" value="<?php echo $first_name;?>" required />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                        placeholder="Last Name" value="<?php echo $last_name;?>" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="<?php echo $phone;?>" required />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $email;?>" required readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Password" value="<?php echo $password;?>" required />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateCustomer" class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php'); ?>