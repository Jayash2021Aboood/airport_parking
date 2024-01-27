<?php

  session_start();
  $pageTitle = "Signin as Customer";

  include('includes/lib.php');
  include('includes/webuser.php');
  include('includes/customer.php');
   
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['createAccount']))
    {

      $first_name = $_POST['first_name'];

      $last_name = $_POST['last_name'];
      
      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $confirm_password = $_POST['confirm_password'];



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
        else
        {
            if(isUserExist($email))
            {
                $errors[] = "<li>try again with another email.</li>";
                $_SESSION["fail"] .= "<li>try again with another email.</li>";
            }
        }
      if( empty($password)){
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }

      if( empty($confirm_password)){
        $errors[] = "<li>confirm_password is requierd.</li>";
        $_SESSION["fail"] .= "<li>confirm_password is requierd.</li>";
        }

      if( $password != $confirm_password ){
        $errors[] = "<li>passwords must be matched </li>";
        $_SESSION["fail"] .= "<li>passwords must be matched </li>";
        }

        
        
      if(count($errors) == 0)
      {
        
        $webUser = addWebUser($email,'c');
        if($webUser == true)
        {
            $add = addCustomer( $first_name, $last_name, $phone, $email, $password);
            if($add ==  true)
            {
                $customers = select("select * from customer where email like '$email' and password like '$password';");
                if(count($customers) > 0)
                {
                    $_SESSION["userID"] = $customers[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'c';
                    $_SESSION['success'] = "Welcome ".$customers[0]['first_name'] ." ". $customers[0]['last_name'] ;
                    header('Location: customer/index.php');
                    exit();                    
                }
                else
                {
                    redirectToReferer("we can't find customer with this data .!!");
                }
            }
            else
            {
                $_SESSION["message"] = "Error when Adding Data";
                $_SESSION["fail"] = "Error when Adding Data";
                $errors[] = "Error when Adding Data";
            }
        }
        else
        {
            redirectToReferer("error When Create New Users ... contact administrator");
        }
        
      }
      else
      {
        redirectToReferer($errors);
      }
    }
  }
  ?>

<?php include('template/header.php'); ?>

<?php include('template/startNavbar.php'); ?>

<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <!-- Basic registration form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4">Create Account</h3>
                    </div>
                    <div class="card-body">
                        <!-- Registration form-->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <!-- Form Group (first name)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                        <input class="form-control" id="inputFirstName" name="first_name" type="text"
                                            placeholder="Enter first name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Form Group (last name)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                        <input class="form-control" id="inputLastName" name="last_name" type="text"
                                            placeholder="Enter last name" required />
                                    </div>
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3">
                                <div class="col-md-12">
                                    <!-- Form Group (phone)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputPhone">Phone</label>
                                        <input class="form-control" id="inputPhone" name="phone" type="tel"
                                            placeholder="Enter phone " required />
                                    </div>
                                </div>
                            </div>
                            <!-- Form Group (email address)            -->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                    aria-describedby="emailHelp" placeholder="Enter email address" name="email"
                                    required />
                            </div>
                            <!-- Form Row    -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <!-- Form Group (password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control" id="inputPassword" type="password"
                                            placeholder="Enter password" name="password" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Form Group (confirm password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirm
                                            Password</label>
                                        <input class="form-control" id="inputConfirmPassword" type="password"
                                            placeholder="Confirm password" name="confirm_password" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Form Group (create account submit)-->
                            <button name="createAccount" class="btn btn-success" type="submit">Create
                                Account</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('template/footer.php') ?>