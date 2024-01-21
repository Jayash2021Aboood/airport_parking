<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/admin.php');
  checkAdminSession();

  $pageTitle = lang("Edit Admin");
  //$row = new Admin(null);
   $id =  $email =  $password = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getAdminById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
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
    if(isset($_POST['updateAdmin']))
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
      if( empty($email)){
        $errors[] = "<li>" . lang("Email is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Email is requierd") . "</li>";
        }
      if( empty($password)){
        $errors[] = "<li>" . lang("Password is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Password is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getAdminById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateAdmin( $id,  $email,  $password, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Admin Updated successfuly!");
          $_SESSION["success"] = lang("Admin Updated successfuly!");
          header('Location:'. $PATH_ADMIN_ADMIN .'index.php');
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
                            <?php echo lang("Edit Admin"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Admins List"); ?>
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
                <!-- Admin details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Admin Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $email;?>" required />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="<?php echo $password;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateAdmin" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

