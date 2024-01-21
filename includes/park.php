<?php
// ====================================================
// ====================================================
// ======================= Start Park Part ===========

class Park
{
	public $id;
	public $name;
	public $detail;

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
			$this->detail = $row[2];
		}
	}

}

function getAllParks()
{
	return selectAndOrder("select * from park","id","desc");
}

function getParkById($id)
{
	return selectById("*","park", $id);
}

function getParkByName($search)
{
	return select("SELECT * FROM park WHERE name like '%$search%' and active = 1");
}

function addPark( $name, $detail)
{
    $sql = 
		"INSERT INTO park VALUES(null,
'$name','$detail')";	return query($sql);
}

function updatePark( $id, $name, $detail)
{
    $sql = 
		"UPDATE park SET 
		name = '$name'
,		detail = '$detail'
		WHERE id = $id ";
    return query($sql);
}

function deletePark($id)
{   
     return query("DELETE FROM park WHERE id = $id");
}
?>


