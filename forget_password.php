<?php
  session_start();
//   ini_set("SMTP", "localhost");
//   ini_set("smtp_port", "25");
  include('includes/lib.php');
  $pageTitle =  lang("Forget Password");

if (isset($_SESSION['user'])) 
  {
    if(isset($_SESSION['userType']))
    {
        if($_SESSION['userType'] == 'a')
        {
            header('Location: admin/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'e')
        {
            header('Location: employee/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'c')
        {
            header('Location: student/index.php');
            exit();
        }
    }
    header('Location: index.php');
    exit();
  }
  
  $errors = array();

  $email = "";
  $result = null;
  $password = null;
  if(isset($_POST['forgetPassword']))
  {
    $email = $_POST['email'];

    if( !(isset($_POST['email']) && !empty($_POST['email']) )){
        $errors[] = lang("Email is requierd");
        $_SESSION["fail"] = "Email is requierd.";
    }
    
    if(count($errors) == 0)
    {
      $logins = select("select * from webuser where email like '$email';");
      if(count($logins) > 0)
      {
        $userType = $logins[0]['usertype'];
        if($userType == 'a')
        {
            $admins = select("select * from admin where email like '$email';");
            if(count($admins) > 0)
            {
                $result = $admins[0]['email'];
                $password = $admins[0]['password'];
            }
            else
            {
                $_SESSION["message"] = lang("user not found");
                $_SESSION["fail"] = lang("user not found");
                $errors[] = lang("user not found");
            }
        }
        else if($userType == 'e')
        {
            $employees = select("select * from employee where email like '$email';");
            if(count($employees) > 0)
            {
                $result = $employees[0]['email'];
                $password = $employees[0]['password'];
            }
            else
            {
                $_SESSION["message"] = lang("user not found");
                $_SESSION["fail"] = lang("user not found");
                $errors[] = lang("user not found");
            }
        }
        else if($userType == 'c')
        {
            $students = select("select * from student where email like '$email';");
            if(count($students) > 0)
            {
                $result = $students[0]['email'];
                $password = $students[0]['password'];
            }
            else
            {
                $_SESSION["message"] = lang("user not found");
                $_SESSION["fail"] = lang("user not found");
                $errors[] = lang("user not found");
            }
        }
        else
        {
            $_SESSION["message"] = lang("UnKnow user state ... contact admininstrator");
            $_SESSION["fail"] = lang("UnKnow user state ... contact admininstrator");
            $errors[] = lang("UnKnow user state ... contact admininstrator");
        }

        if(is_null($result) || is_null($password)){
            $_SESSION["message"] = lang("Email or user not found!");
            $_SESSION["fail"] = lang("Email or user not found!");
            $errors[] = lang("Email or user not found!");
        }
        else{
            // Send mail
            // recipient email address
            $to = $result;

            // email subject
            $subject = "Recovery Password";

            // email message
            $message = "hello $result your password in Airport Parking is $password \n thanks for contact us.";

            // additional headers
            $headers = "From: support@airport_parking.com\r\n";

            

            // send email
            if(mail($to, $subject, $message, $headers)) {
                $_SESSION["message"] = lang("Email sent successfuly");
                $_SESSION["success"] = lang("Email sent successfuly");
            } else {
                $_SESSION["message"] = lang("Email sending failed.");
                $_SESSION["fail"] = lang("Email sending failed.");
                $errors[] = lang("Email sending failed.");
            }
        }
      }
      else
      {
        $_SESSION["message"] = lang("Email or user not found!");
        $_SESSION["fail"] = lang("Email or user not found!");
        $errors[] = lang("Email or user not found!");
      }
      
    }
    else
    {
        foreach($errors as $error)
        {
            if( !(isset($_SESSION["fail"]) && !empty($_SESSION["fail"]) ))
            {
                $_SESSION["fail"] = $error;
            }
            else
            {
                $_SESSION["fail"] .= "</br>$error";
            }
        }
    }

  }

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-10">
                <!-- Basic forgot password form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4"><?php echo lang("Password Recovery"); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="small mb-3 text-muted">
                            <?php echo lang("Enter your email address and we will send your password to your email."); ?>
                        </div>
                        <!-- Forgot password form-->
                        <form action="" method="POST">
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress"><?php echo lang("Email"); ?></label>
                                <input class="form-control" id="email" name="email" type="email"
                                    aria-describedby="emailHelp" placeholder="Enter email address" required />
                            </div>
                            <!-- Form Group (submit options)-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="auth-login-basic.html"><?php echo lang("Return to login"); ?></a>
                                <button class="btn btn-primary" name="forgetPassword"
                                    type="submit"><?php echo lang("Send Password"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>