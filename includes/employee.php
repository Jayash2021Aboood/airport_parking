<?php
// ====================================================
// ====================================================
// ======================= Start Employee Part ===========

class Employee
{
	public $id;
	public $name;
	public $date_of_birth;
	public $salary;
	public $phone;
	public $email;
	public $password;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->name = $row[1];
			$this->date_of_birth = $row[2];
			$this->salary = $row[3];
			$this->phone = $row[4];
			$this->email = $row[5];
			$this->password = $row[6];
		}
	}

}

function getAllEmployees()
{
	return selectAndOrder("select * from employee","id","desc");
}

function getEmployeeById($id)
{
	return selectById("*","employee", $id);
}

function getEmployeeByName($search)
{
	return select("SELECT * FROM employee WHERE name like '%$search%' and active = 1");
}

function addEmployee( $name, $date_of_birth, $salary, $phone, $email, $password)
{
    $sql = 
		"INSERT INTO employee VALUES(null,
'$name','$date_of_birth',$salary,'$phone','$email','$password')";	return query($sql);
}

function updateEmployee( $id, $name, $date_of_birth, $salary, $phone, $email, $password)
{
    $sql = 
		"UPDATE employee SET 
		name = '$name'
,		date_of_birth = '$date_of_birth'
,		salary = $salary
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
		WHERE id = $id ";
    return query($sql);
}

function deleteEmployee($id)
{   
     return query("DELETE FROM employee WHERE id = $id");
}
?>


