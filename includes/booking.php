<?php
// ====================================================
// ====================================================
// ======================= Start Booking Part ===========

class Booking
{
	public $id;
	public $park_id;
	public $customer_id;
	public $from_date;
	public $to_date;
	public $amount;
	public $is_paid;
	public $create_date;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->park_id = $row[1];
			$this->customer_id = $row[2];
			$this->from_date = $row[3];
			$this->to_date = $row[4];
			$this->amount = $row[5];
			$this->is_paid = $row[6];
			$this->create_date = $row[7];
		}
	}

}

function getAllBookings()
{
	return selectAndOrder("select * from booking","id","desc");
}

function getBookingById($id)
{
	return selectById("*","booking", $id);
}

function getBookingByName($search)
{
	return select("SELECT * FROM booking WHERE name like '%$search%' and active = 1");
}

function addBooking( $park_id, $customer_id, $from_date, $to_date, $amount, $is_paid, $create_date)
{
    $sql = 
		"INSERT INTO booking VALUES(null,
$park_id,$customer_id,'$from_date','$to_date',$amount,$is_paid,'$create_date')";	return query($sql);
}

function updateBooking( $id, $park_id, $customer_id, $from_date, $to_date, $amount, $is_paid, $create_date)
{
    $sql = 
		"UPDATE booking SET 
		park_id = $park_id
,		customer_id = $customer_id
,		from_date = '$from_date'
,		to_date = '$to_date'
,		amount = $amount
,		is_paid = $is_paid
,		create_date = '$create_date'
		WHERE id = $id ";
    return query($sql);
}

function deleteBooking($id)
{   
     return query("DELETE FROM booking WHERE id = $id");
}
?>


