<?php
// ====================================================
// ====================================================
// ======================= Start WebUser Part ===========

class WebUser
{
	public $id;
	public $email;
	public $usertype;

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
			$this->usertype = $row[2];
		}
	}

}

function getAllWebUsers()
{
	return selectAndOrder("select * from webuser","id","desc");
}

function getWebUserById($id)
{
	return selectById("*","webuser", $id);
}

function getWebUserByName($search)
{
	return select("SELECT * FROM webuser WHERE name like '%$search%' and active = 1");
}

function addWebUser( $email, $usertype)
{
    $sql = 
		"INSERT INTO webuser VALUES(null,
'$email','$usertype')";	return query($sql);
}

function updateWebUser( $id, $email, $usertype)
{
    $sql = 
		"UPDATE webuser SET 
		email = '$email'
,		usertype = '$usertype'
		WHERE id = $id ";
    return query($sql);
}

function deleteWebUser($id)
{   
     return query("DELETE FROM webuser WHERE id = $id");
}
?>


