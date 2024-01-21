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

// دالة لجلب الخدمات اعتماد على نوع الخدمة
function getAllServicesByTypeID($service_type_id)
{
	return selectByCondition("*","service","where  service_type_id like '$service_type_id'");
}

// دالة لجلب الخدمات اعتماد على نوع الخدمة
function getAllServicesByEngineerID($engineer_id)
{
	return selectByCondition("*","service","where  engineer_id like '$engineer_id'");
}

function getAllBooksByAuthorID($author_id)
{
	return selectByCondition("*","book","where  author_id like '$author_id'");
}


function getAllBooksByPublisherID($publisher_id)
{
	return selectByCondition("*","book","where  publisher_id like '$publisher_id'");
}


function getAllBooksByPubAndAuthAndSecByID($publisher_id,$author_id,$section_id)
{
	return selectByCondition("*","book","where  publisher_id And author_id And section_id like '$publisher_id','$author_id','$section_id' ");
}

function getAllEngineersWithRatesAndServiceTotals($engineer_id = null)
{
    if(isset( $engineer_id) && !empty($engineer_id))
    {
    return select(' SELECT e.* , COUNT(s.id) as total_service, SUM(r.rate)/ COUNT(r.id) as total_rate
                    FROM engineer AS e
                    LEFT JOIN service AS s ON e.id = s.engineer_id
                    LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE e.id = '.$engineer_id.'
                    GROUP BY e.id;');
    }
    else
    {
    return select(' SELECT e.* , COUNT(s.id) as total_service, SUM(r.rate)/ COUNT(r.id) as total_rate
                    FROM engineer AS e
                    LEFT JOIN service AS s ON e.id = s.engineer_id
                    LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY e.id;');
    }

}

//Author
function getAllAuthorWithBookTotals($author_id = null)
{
    if(isset( $author_id) && !empty($author_id))
    {
    return select(' SELECT a.* , COUNT(b.id) as total_book
                    FROM author AS a
                    LEFT JOIN book AS b ON a.id = b.author_id
                    WHERE a.id = '.$author_id.'
                    GROUP BY a.id;');
    }
    else
    {
    return select(' SELECT a.* , COUNT(b.id) as total_book
                    FROM author AS a
                    LEFT JOIN book AS b ON a.id = b.author_id
                    GROUP BY a.id;');
    }

}

//Book
function getAllBooksWithDetails($book_id = null)
{
    if(isset( $book_id) && !empty($book_id))
    {
    return select(' SELECT b.*, a.name as author_name , COUNT(b.id) as total_book
                    FROM book AS b
                    LEFT JOIN author AS a ON b.author_id = a.id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE b.id = '.$book_id.'
                    GROUP BY b.id;');
    }
    else
    {
    return select(' SELECT b.* , COUNT(id) as total_book
                    FROM book AS b
                    -- LEFT JOIN service AS s ON e.id = s.engineer_id
                    -- LEFT JOIN author AS a ON b.id = a.book_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY b.id;');
    }

}

function getAllBooksBySearch($search_term, $limit = null)
{
    $sql = " SELECT book.*,
                           author.name AS author_name, 
                           publisher.name AS publisher_name, 
                           section.name AS section_name, 
                           language.name AS language_name,
                           13 AS available_copies_count
                    FROM book
                    JOIN author ON book.author_id = author.id
                    JOIN publisher ON book.publisher_id = publisher.id
                    JOIN section ON book.section_id = section.id
                    JOIN language ON book.language_id = language.id
                    WHERE CONCAT(book.id, book.name, book.number_copies, book.publish_date, book.detail) LIKE '%$search_term%'
                    OR author.name LIKE '%$search_term%'
                    OR publisher.name LIKE '%$search_term%'
                    OR section.name LIKE '%$search_term%'
                    OR language.name LIKE '%$search_term%' ";

    if(!is_null($limit)){
        $sql .= "LIMIT $limit";
    }
    return select($sql);
}

function getAllAuthorsBySearch($search_term)
{
    return select(" SELECT *
                    FROM author
                    WHERE CONCAT(id, name, email, phone, address, nationality) LIKE '%$search_term%'
                    ;");
}

function getAllSectionsBySearch($search_term)
{
    if(empty($search_term))
        return select("SELECT * From section WHERE parent_id is NULL;");
    else
        return select(" SELECT *
                        FROM section
                        WHERE CONCAT(id, name, number) LIKE '%$search_term%'
                        ;");
}

function getAllPublishersBySearch($search_term)
{
    return select(" SELECT *
                    FROM publisher
                    WHERE CONCAT(id, name, email, phone, address) LIKE '%$search_term%'
                    ;");
}

function getAvailableBooksToIssue($book_id)
{
    // Code to check if book is available for issue
    $book = getBookById($book_id);
    if(is_null($book)){
        throw new Exception(lang("book not found"));
    }

    $result = select("SELECT COUNT(*) FROM issue AS issues_count
    WHERE book_id = $book_id AND return_date LIKE '0000-00-00'
    ;");

    if(is_null($result)){
        throw new Exception(lang("can not calcualte available copies for book"));
    }

    return $book[0]['number_copies'] - $result[0][0];
}

function getStudentIssuesTimes($student_id){
    // Code to check if book is available for issue

    $result = select("SELECT COUNT(*) FROM issue AS issues_count
    WHERE student_id = $student_id AND return_date LIKE '0000-00-00'
    ;");

    if(is_null($result)){
        throw new Exception(lang("can not calcualte student issues times"));
    }

    return $result[0][0];
}

function getAllIssuesByStudentId($student_id)
{
    return select("SELECT * FROM issue WHERE student_id = $student_id order by id desc;");
}

function getAllFinesByStudentId($student_id)
{
    return select("SELECT * FROM fine WHERE student_id = $student_id order by id desc;");
}
//Publisher

function getAllPublishersWithBookTotals($publisher_id = null)
{
    if(isset( $publisher_id) && !empty($publisher_id))
    {
    return select(' SELECT p.* , COUNT(b.id) as total_book
                    FROM publisher AS p
                    LEFT JOIN book AS b ON p.id = b.publisher_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE p.id = '.$publisher_id.'
                    GROUP BY p.id;');
    }
    else
    {
    return select(' SELECT p.* , COUNT(b.id) as total_book
                    FROM publisher AS p
                    LEFT JOIN book AS b ON p.id = b.publisher_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY p.id;');
    }

}

//Section

function getAllSectionsWithBookTotals($section_id = null)
{
    if(isset( $section_id) && !empty($section_id))
    {
    return select(' SELECT s.* , COUNT(b.id) as total_book
                    FROM section AS s
                    LEFT JOIN book AS b ON s.id = b.section_id
                    -- LEFT JOIN book AS b ON s.id = b.section_id
                    WHERE s.id = '.$section_id.'
                    GROUP BY s.id;');
    }
    else
    {
        //,b.name as book_name
    return select(' SELECT s.* , COUNT(b.id) as total_book     
                    FROM section AS s
                    LEFT JOIN book AS b ON s.id = b.section_id
                    -- LEFT JOIN book AS b ON s.id = b.section_id
                    GROUP BY s.id;');
    }

}



function getAllBookingsWithDetails($customer_id = null)
{
    if(isset( $customer_id) && !empty($customer_id))
    {
        return select(' SELECT b.* , s.name as service, CONCAT( e.first_name,\' \',e.last_name)  as engineer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN engineer AS e ON e.id = b.engineer_id
                        WHERE b.customer_id = '.$customer_id.'
                        ;');
    }
    else
    {
        return select(' SELECT b.* , s.name as service, CONCAT( e.first_name,\' \',e.last_name)  as engineer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN engineer AS e ON e.id = b.engineer_id;');
    }
}


function getAllBookingsWithDetailsByEngineer($engineer_id = null)
{
    if(isset( $engineer_id) && !empty($engineer_id))
    {
        return select(' SELECT b.* , s.name as service, CONCAT( c.first_name,\' \',c.last_name)  as customer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN customer AS c ON c.id = b.customer_id
                        WHERE b.engineer_id = '.$engineer_id.'
                        ;');
    }
    else
    {
        return select(' SELECT b.* , s.name as service, CONCAT( c.first_name,\' \',c.last_name)  as customer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN customer AS c ON c.id = b.customer_id;');
    }
}



function getAllBookingNote($booking_id)
{
    return select("SELECT * FROM booking_note WHERE booking_id = $booking_id;");
}

function isUserExist($email)
{
    $webusers =  select("SELECT COUNT(id) as total FROM webuser WHERE email = '$email';");
    $admins =  select("SELECT COUNT(id) as total FROM admin WHERE email = '$email';");
    $students =  select("SELECT COUNT(id) as total FROM student WHERE email = '$email';");
    $employees =  select("SELECT COUNT(id) as total FROM employee WHERE email = '$email';");

    if( $webusers[0]["total"] > 0  ||
        $admins[0]["total"] > 0 ||
        $students[0]["total"] > 0 ||
        $employees[0]["total"] > 0) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function AddNewStudent($name, $phone, $email, $password, $department_id, $level_id, $state, $active)
{
    $isExsist = isUserExist($email);
    if($isExsist == true){
        throw new Exception(lang("this student email is exist try to use another email"));
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
        // Insert data into the student table
        $sql = "INSERT INTO student VALUES(null,'$name','$phone','$email','$password',$department_id,$level_id,'$state',$active)";
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into student table: ". $conn->error);
        }

        // Insert data into the webuser table
        $sql = "INSERT INTO webuser VALUES(null,'$email','s')";	
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