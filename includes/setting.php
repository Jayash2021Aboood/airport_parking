<?php
// ====================================================
// ====================================================
// ======================= Start Setting Part ===========

class Setting
{
	public $id;
	public $amount_per_hour;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->amount_per_hour = $row[1];
		}
	}

}

function getAllSettings()
{
	return selectAndOrder("select * from setting","id","desc");
}

function getSettingById($id)
{
	return selectById("*","setting", $id);
}

function getSettingByName($search)
{
	return select("SELECT * FROM setting WHERE name like '%$search%' and active = 1");
}

function addSetting( $amount_per_hour)
{
    $sql = 
		"INSERT INTO setting VALUES(null,
$amount_per_hour)";	return query($sql);
}

function updateSetting( $id, $amount_per_hour)
{
    $sql = 
		"UPDATE setting SET 
		amount_per_hour = $amount_per_hour
		WHERE id = $id ";
    return query($sql);
}


function AddOrUpdateSetting($amount_per_hour)
{
	$setting = GetSetting();
	if(is_null($setting) || empty($setting) || count($setting) == 0){
		$sql = 
			"INSERT INTO setting VALUES(null,
			$amount_per_hour)";
	}
	else{
		$sql = "UPDATE setting 
			SET amount_per_hour = $amount_per_hour
			WHERE id = " . $setting[0]['id'] . ";";
	}
    return query($sql);
}

function GetSetting() 
{
    return select("SELECT * From setting LIMIT 1;");
}

?>