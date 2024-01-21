<?php
// ====================================================
// ====================================================
// ======================= Start Admin Part ===========

class Admin
{
	public $id;
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
			$this->email = $row[1];
			$this->password = $row[2];
		}
	}

}

function getAllAdmins()
{
	return selectAndOrder("select * from admin","id","desc");
}

function getAdminById($id)
{
	return selectById("*","admin", $id);
}

function getAdminByName($search)
{
	return select("SELECT * FROM admin WHERE name like '%$search%' and active = 1");
}

function addAdmin( $email, $password)
{
    $sql = 
		"INSERT INTO admin VALUES(null,
'$email','$password')";	return query($sql);
}

function updateAdmin( $id, $email, $password)
{
    $sql = 
		"UPDATE admin SET 
		email = '$email'
,		password = '$password'
		WHERE id = $id ";
    return query($sql);
}

function deleteAdmin($id)
{   
     return query("DELETE FROM admin WHERE id = $id");
}
?>


