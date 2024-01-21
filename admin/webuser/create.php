<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/webuser.php');
  checkAdminSession();


  
  $pageTitle = lang("Add WebUser");
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addWebUser']))
    {


      $email = $_POST['email'];

      $usertype = $_POST['usertype'];

      if( empty($email)){
        $errors[] = "<li>" . lang("Email is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Email is requierd") . "</li>";
        }
      if( empty($usertype)){
        $errors[] = "<li>" . lang("User Type  is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("User Type  is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addWebUser(
                                    $email,
                                    $usertype,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = lang("WebUser Added successfuly!");
          $_SESSION["success"] = lang("WebUser Added successfuly!");
          header('Location:'. $PATH_ADMIN_WEBUSER .'index.php');
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
                           <?php echo lang("Add WebUser"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to WebUsers List"); ?>
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
                <!-- WebUser details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("WebUser Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (usertype)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="usertype"><?php echo lang("User Type "); ?></label>
                                    <input class="form-control" id="usertype" name="usertype" type="text" placeholder="<?php echo lang("User Type "); ?>"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addWebUser" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



