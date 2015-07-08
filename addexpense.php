<!DOCTYPE html>
<html>
	<?php 
		
	// this code is used for connecting to database	
		$conn = mysqli_connect('localhost', 'root', '', 'expense_tracker');

	//this code is used to get values from add.php
		$description=$_REQUEST['description'];
		$categories=$_REQUEST['categories'];
		$money=$_REQUEST['money'];
		$date=$_REQUEST['date'];
		$date1=date("Y-m-d");
		// echo "$title</br>";
		// echo "$categories</br>";
		// echo "$money</br>";
		if ($date=="") {
			$date=$date1;
			// echo "$date";
		}
		else{
			// echo "$date";
		}
		
		//below line is used for saving the date entered in add.php
		$sql = "INSERT INTO cat_expenses (date_selected, categories, description, expense) VALUES ('$date','$categories','$description','$money')";
		if (mysqli_query($conn, $sql)) {
    		 echo (" <script>window.location.href='index.php';</script>");
		} 
		else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
?>
</html>