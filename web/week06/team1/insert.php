<?php
// retrieve POST data from the other page
$first = $_POST['first'];
$last = $_POST['last'];
$food = $_POST['food'];

require("dbConnect.php");
$db = get_db();

try
{
	// insert into database
	$query = 'INSERT INTO w6_user (first_name, last_name, food_type) VALUES (:first, :last, 1)';
	$statement = $db->prepare($query);
	$statement->bindValue(':first', $first);
	$statement->bindValue(':food', $food);
	$statement->bindValue(':last', $last);
	$statement->execute();

	$userId = $db->lastInsertId("w6_user_id_seq");
	
	// SELECT c.relname FROM pg_class c WHERE c.relkind = 'S';   -- display all sequences
	// get id of last inserted row - save in $userId
}
catch (Exception $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}
header("Location: display.php/?personId=$userId");

die(); 
?>
