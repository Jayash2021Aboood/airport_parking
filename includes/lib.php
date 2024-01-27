<?php

include("config.php");
include('myFunctions.php');




// ====================================================
// ====================================================
// ====================  Genral Method ==============

function select($statment)
{
    global $mysqlilink;
    $query = $statment;
    $res = mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>"); 

	$list = [];
    while($row=mysqli_fetch_array($res,MYSQLI_BOTH))
    {
      $list[] = $row;
	} 

	 return $list;
}

function selectByCondition($columns ,$table, $where = "")
{   
    return select("select $columns from $table $where");
}

function selectById($columns ,$table, $id)
{   
    return selectByCondition($columns, $table, "where id = $id");
}

function selectAndOrder($statment ,$columns = "id" , $type = "asc")
{   
    return select("$statment order by $columns $type");
}




function insert($statment)
{
    global $mysqlilink;
    $query = $statment;
    return  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );

}

function query($statment)
{
    global $mysqlilink;
    $query = $statment;
    $result =  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );
	
	if($result == false)
		echo mysqli_error($mysqlilink);
	return $result;
}


// ====================================================
// ====================================================
// ====================  Login Method ==============


function loginAdmin($username, $password)
{
	return select("SELECT * FROM admin WHERE username LIKE '$username' AND password LIKE '$password'");
}

// ====================================================
// ====================================================
// ====================  Addtional Method ==============


function isUserExist($email)
{
    $webusers =  select("SELECT COUNT(id) as total FROM webuser WHERE email = '$email';");
    $admins =  select("SELECT COUNT(id) as total FROM admin WHERE email = '$email';");
    $customers =  select("SELECT COUNT(id) as total FROM customer WHERE email = '$email';");
    $employees =  select("SELECT COUNT(id) as total FROM employee WHERE email = '$email';");

    if( $webusers[0]["total"] > 0  ||
        $admins[0]["total"] > 0 ||
        $customers[0]["total"] > 0 ||
        $employees[0]["total"] > 0) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function AddNewCustomer($name, $phone, $email, $password, $department_id, $level_id, $state, $active)
{
    $isExsist = isUserExist($email);
    if($isExsist == true){
        throw new Exception(lang("this customer email is exist try to use another email"));
    }

    /**
     * Start Transaction
     **/

    // Connect to the database

	global $localhost;
	global $DBusername;
	global $dbname ;
	global $pwd;

    $servername = $localhost;
    $username = $DBusername;
    $password = $pwd;
    $dbname = $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
    }

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Insert data into the customer table
        $sql = "INSERT INTO customer VALUES(null,'$name','$phone','$email','$password',$department_id,$level_id,'$state',$active)";
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into customer table: ". $conn->error);
        }

        // Insert data into the webuser table
        $sql = "INSERT INTO webuser VALUES(null,'$email','c')";	
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into webuser table: ". $conn->error);
        }

        // Commit the transaction
        return $conn->commit();

    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();

        die($e->getMessage());
    }

    // Close the connection
    $conn->close();
    

    /**
     * End Transaction
     **/
    
}

function AddNewEmployee( $name, $phone, $email, $password, $address)
{
    $isExsist = isUserExist($email);
    if($isExsist == true){
        throw new Exception(lang("this employee email is exist try to use another email"));
    }

    /**
     * Start Transaction
     **/

    // Connect to the database

	global $localhost;
	global $DBusername;
	global $dbname ;
	global $pwd;

    $servername = $localhost;
    $username = $DBusername;
    $password = $pwd;
    $dbname = $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
    }

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Insert data into the employee table
        $sql = "INSERT INTO employee VALUES(null,'$name','$phone','$email','$password','$address')";
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into employee table: ". $conn->error);
        }

        // Insert data into the webuser table
        $sql = "INSERT INTO webuser VALUES(null,'$email','e')";	
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into webuser table: ". $conn->error);
        }

        // Commit the transaction
        return $conn->commit();

    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();

        die($e->getMessage());
    }

    // Close the connection
    $conn->close();
    

    /**
     * End Transaction
     **/
    
}

?>