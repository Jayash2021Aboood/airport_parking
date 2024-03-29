<?php
  session_start();

  include('../includes/lib.php');
  include_once('../includes/employee.php');
  checkEmployeeSession();

  $pageTitle = "My Profile";
  
  $id =  $name =  $date_of_birth =  $salary =  $phone =  $email =  $password = "";
  
  include('../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
      $_SESSION["message"] = '';
      $id = $_SESSION['userID'];
      $result = getEmployeeById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $_SESSION['userID'];
        $name = $row['name'];
        $date_of_birth = $row['date_of_birth'];
        $salary = $row['salary'];
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
    if(isset($_POST['updateEmployee']))
    {
        $id = $_SESSION['userID'];
        $name = $_POST['name'];
        $date_of_birth = $_POST['date_of_birth'];
        $salary = $_POST['salary'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if( empty($name)){
          $errors[] = "<li>" . lang("Name is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
          }
        if( empty($date_of_birth)){
          $errors[] = "<li>" . lang("Date of Birth is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Date of Birth is requierd") . "</li>";
          }
        if( empty($salary)){
          $errors[] = "<li>" . lang("Salary is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Salary is requierd") . "</li>";
          }
        if( empty($phone)){
          $errors[] = "<li>" . lang("Phone is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Phone is requierd") . "</li>";
          }
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

        $result = getEmployeeById($id);
        if( count( $result ) > 0)
          $row = $result[0];
          $email = $row['email'];
        
        $update = updateEmployee( $id,  $name,  $date_of_birth,  $salary,  $phone,  $email,  $password, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Employee Updated successfuly!";
          $_SESSION["success"] = "Employee Updated successfuly!";
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
                <!-- Employee details card-->
                <div class="card mb-4">
                    <div class="card-header">My Profile Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (date_of_birth)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_birth"><?php echo lang("Date of Birth"); ?></label>
                                    <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="<?php echo lang("Date of Birth"); ?>"
                                        value="<?php echo $date_of_birth;?>" required />
                                </div>
                                <!-- Form Group (salary)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="salary"><?php echo lang("Salary"); ?></label>
                                    <input class="form-control" id="salary" name="salary" type="text" placeholder="<?php echo lang("Salary"); ?>"
                                        value="<?php echo $salary;?>" required />
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
                            <button name="updateEmployee" class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php'); ?>