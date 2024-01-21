<?php
// لاستخدام الجلسات في الصفحة 
  session_start();

  //  نتأكد اذا المستخدم مسجل من قبل نحوله للصفحة الرئيسية 
  if ((isset($_SESSION['userID']))) {
    header('Location:'. $PATH_SERVER . 'index.php');
	}

  //    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');


  $pageTitle = "Registration";
  // استدعاء رأس الصفحة 
  include('template/header.php'); 
  $errors = array();
  $name = "";
  $email = "";
  $phone = "";
  $username = "";
  $password = "";

// التأكد اذا كان الدخول للصفحة عن طريق الفورم 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addUser']))
    {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $repeatPassword = $_POST['repeatPassword'];
      $active = 1;
      
      
// يتم فحص القيم والتأكد من سلامتها
      if( empty($name))
        $errors[] = "Name is requierd.";
  
      if( empty($email))
        $errors[] = "Email is requierd.";

      if( empty($username))
        $errors[] = "Username is requierd.";
  
      if( empty($password))
        $errors[] = "Password is requierd.";

      if( empty($repeatPassword))
        $errors[] = "repeatPassword is requierd.";

      if( $password != $repeatPassword)
        $errors[] = "Passwords Does Not Match .";

    if(count($errors) == 0)
    {
      // التأكد ان قاعدة البيانات لاتجتوي مستخدم بهذا الاسم 
        $users =  select("select * from user where username = '$username'");
        if( count($users) > 0)
        $errors[] = "Try Again With Another Username";
        
        $users =  select("select * from user where email = '$email'");
        if( count($users) > 0)
        $errors[] = "Try Again With Another Email";
    }

          
      if(count($errors) == 0)
      {
        // اضافة السمتخدم لقاعدة البيانات
        $add = addUser($name, $email, $phone, $username, $password, $active);
        if($add ==  true)
        {
          $_SESSION["message"] = "Your Acoount Added successfuly!";
          header('Location:'. $PATH_SERVER .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Create Account";
          $errors[] = "Error when Adding Data";
        }
        
      }
  
    }
  }
?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>


<!-- محتوى الصفحة -->
<main class="page registration-page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Registration</h2>
            </div>
            <form action="" method="POST">
                <?php
                if(count($errors) > 0)
                {
                    echo '<div id="errors" class="form-group text-danger" > <ul>';
                    foreach($errors as $error)
                    {
                    echo "<li> $error </>";
                    }      
                    echo '</ul> </div>';
                }
                ?>
                <div class="form-group"><label for="name">Name</label><input class="form-control item" type="text"
                        id="name" name="name" value="<?php echo $name;?>"></div>
                <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email"
                        id="email" name="email" value="<?php echo $email;?>"></div>
                <div class="form-group"><label for="phone">Phone</label><input class="form-control item" type="phone"
                        id="phone" name="phone" value="<?php echo $phone;?>"></div>
                <div class="form-group"><label for="username">Username</label><input class="form-control item"
                        type="text" id="username" name="username" value="<?php echo $username;?>"></div>
                <div class="form-group"><label for="password" value="<?php echo $password;?>">Password</label><input
                        class="form-control item" type="password" id="password" name="password"></div>
                <div class="form-group"><label for="repeatPassword">Repeat Password</label><input
                        class="form-control item" type="Password" id="repeatPassword" name="repeatPassword"
                        value="<?php echo $repeatPassword;?>"></div>
                <button name="addUser" class="btn btn-primary btn-block" type="submit">Sign Up</button>
            </form>
        </div>
    </section>
</main>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>