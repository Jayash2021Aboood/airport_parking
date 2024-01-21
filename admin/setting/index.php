<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/setting.php');
  checkAdminSession();

  $pageTitle = lang("Update Setting");
  //$row = new Setting(null);
   $id =  $amount_per_hour = "";
  
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
      $_SESSION["message"] = '';
      $result = GetSetting();

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $amount_per_hour = $row['amount_per_hour'];
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateSetting']))
    {
        $id = $_POST['id'];
        $amount_per_hour = $_POST['amount_per_hour'];
      if( empty($amount_per_hour)){
        $errors[] = "<li>" . lang("Amount Per Hour is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Amount Per Hour is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = GetSetting();
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = AddOrUpdateSetting( $amount_per_hour);
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Setting Updated successfuly!");
          $_SESSION["success"] = lang("Setting Updated successfuly!");
          header('Location:'. $PATH_ADMIN_SETTING .'index.php');
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
                            <?php echo lang("Update Setting"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Setting details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Setting Data"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (amount_per_hour)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1"
                                        for="amount_per_hour"><?php echo lang("Amount Per Hour"); ?></label>
                                    <input class="form-control" id="amount_per_hour" name="amount_per_hour" type="text"
                                        placeholder="<?php echo lang("Amount Per Hour"); ?>"
                                        value="<?php echo $amount_per_hour;?>" required />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="updateSetting" class="btn btn-success"
                                type="submit"><?php echo lang("Save"); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>