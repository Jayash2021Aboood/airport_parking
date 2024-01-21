<?php
	$localhost = "localhost";
	$DBusername = "root";
	$dbname = "airport_parking";
	$pwd="";

	$mysqlilink = @mysqli_connect($localhost,$DBusername,$pwd)or die('<center><div>wrong in connect with server</div>'.mysqli_connect_error()."</center>");


	@mysqli_select_db($mysqlilink,$dbname)or die('<center><div>wrong in connect with database</div>'.mysqli_connect_error($mysqlilink)."</center>");

	@mysqli_set_charset($mysqlilink,"UTF8")or die('<center><div>wrong </div>'.mysqli_connect_error($mysqlilink)."</center>");


	//  ======================  Start Path ============================
	//  ====================== =========== ============================

	// HTTP
	// define('HTTP_SERVER', 'http://localhost/airport_parking/admin/');
	$PATH_SERVER 			= 'http://localhost/airport_parking/';
	$PATH_PHOTOES 			= $PATH_SERVER . 'photoes/';
	$PATH_ATTACHMENTS 		= $PATH_SERVER . 'attachments/';

	$PATH_ADMIN 			= $PATH_SERVER . 'admin/';
	// $PATH_CUSTOMER 			= $PATH_SERVER . 'customer/';
	$PATH_EMPLOYEE 			= $PATH_SERVER . 'employee/';

	
	$PATH_EMPLOYEE_EMPLOYEE = $PATH_EMPLOYEE . 'employee/';
	$PATH_EMPLOYEE_SETTING = $PATH_EMPLOYEE . 'setting/';


	$PATH_ADMIN_ADMIN = $PATH_ADMIN . 'admin/';
	$PATH_ADMIN_BOOKING = $PATH_ADMIN . 'booking/';
	$PATH_ADMIN_CUSTOMER = $PATH_ADMIN . 'customer/';

	$PATH_ADMIN_EMPLOYEE = $PATH_ADMIN . 'employee/';
	$PATH_ADMIN_PARK = $PATH_ADMIN . 'park/';
	$PATH_ADMIN_SETTING = $PATH_ADMIN . 'setting/';
	
	
	$PATH_ADMIN_INCLUDES 			= $PATH_ADMIN . 'includes/';
	$PATH_ADMIN_TEMPLATE 			= $PATH_ADMIN . 'template/';
	$PATH_ADMIN_PHOTOES 			= $PATH_ADMIN . 'photoes/';
	$PATH_ADMIN_LANG 			    = $PATH_ADMIN . 'lang/';
	

	// DIR
	define('DIR_APPLICATION', 'C:/xampp/htdocs/airport_parking/');
	define('DIR_ADMIN', 'C:/xampp/htdocs/airport_parking/admin/');
	define('DIR_ADMIN_INCLUDES', 'C:/xampp/htdocs/airport_parking/admin/includes/');
	define('DIR_ADMIN_TEMPLATE', 'C:/xampp/htdocs/airport_parking/admin/template/');
	define('DIR_ADMIN_PHOTOES', 'C:/xampp/htdocs/airport_parking/admin/photoes/');
	define('DIR_PHOTOES', 'C:/xampp/htdocs/airport_parking/photoes/');
	define('DIR_LANG', 'C:/xampp/htdocs/airport_parking/lang/');
	define('DIR_ATTACHMENTS', 'C:/xampp/htdocs/airport_parking/attachments/');



	//  ======================  End  Path =============================
	//  ====================== =========== ============================


	//  ======================  Start Function ============================
	//  ====================== =============== ============================
	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}


  function checkAdminSession($path = "http://localhost/airport_parking/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'a')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkEmployeeSession($path = "http://localhost/airport_parking/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'e')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkStudentSession($path = "http://localhost/airport_parking/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 's')
			{
				header('Location:'. $path . $page);
			}
  }

  function isLogin()
  {
	if(isset($_SESSION['user']))
	{
		if(isset($_SESSION['userType']))
		{
			if($_SESSION['userType'] == 'a' || $_SESSION['userType'] == 's' || $_SESSION['userType'] == 'e')
			{
				return true;
			}
		}
	}
	return false;	
  }

  function getLoginType()
  {
	if(isLogin())
	{
		return $_SESSION['userType'];
	}
	else
	{
		return null;
	}
  }

  function isAdmin() { if(getLoginType() == 'a') return true; }
//   function isEngineer() { if(getLoginType() == 'e') return true; }
  function isEmployee() { if(getLoginType() == 'e') return true; }
//   function isCustomer() { if(getLoginType() == 'c') return true; }
  function isStudent() { if(getLoginType() == 's') return true; }
  function getLoginEmail() { return $_SESSION['user'] ;}

//   function checkAdminSession($path = "http://localhost/airport_parking/" , $page = "login.php")
//   {
// 	// global $PATH_ADMIN;
//     // if(isset($loginRequire))
//     // {
//     //     if($loginRequire == true)
//     //     {
//             if (!(isset($_SESSION['adminID'])) || !(isset($_SESSION['adminName']))) 
//             {
//                 //header('Location:'. $path .'login.php');
//                 header('Location:'. $path . $page);
//                 //echo $_SESSION['adminID'];
//                 //echo '<script> window.location.replace("login.php"); </script>';
//             }
//     //     }
//     // }
//   }
	//  ======================  End Function ============================
	//  ====================== ============= ============================
?>