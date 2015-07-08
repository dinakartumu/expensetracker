<?php

$conn = @mysql_connect('localhost','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
// echo "Success";
mysql_select_db('expense_tracker', $conn);

?>