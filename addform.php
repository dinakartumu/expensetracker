<!DOCTYPE html>
<html>
	<head>
		<?php require_once "connection.php"; ?>
		<link rel="stylesheet" href="css/style.css" text="css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 

	</head>
	<body>
		<div>
			<nav>
				<ul id="logo">
					<li><h1>Peruse</h1></li>
				</ul>
				<ul id="options">
					<li><a href="index.php">Home</a></li>
					<li><a href="categories.php">Categories</a></li>
					<li><a href="#">About Us</a></li>
				</ul>
			</nav>
			<div id="content">

				 <!-- form for entering the data -->
				<form id="expense_entry" action="addexpense.php" aria-hidden="true">
				<!-- 	<select name="categories">
						<option value="general" name="general">General</option>
  						<option value="food" name="food">Food</option>
  						<option value="groceries" name="groceries">Groceries</option>
  						<option value="payments" name="payments">Payments</option>
  						<option value="transport" name="transport">Transport</option>
  						<option value="utilities" name="utilities">Utilities</option>
  						<option value="personal" name="personal">Personal</option>
  						<option value="iTunes" name="iTunes">iTunes</option>
						<option value="amusement" name="amusement">Amusement</option>
					</select>
					<input type="text" name="description" placeholder="Description" required>
					<input type="number" name="money" placeholder="$" required>
					<input type="date" name="date">
					<button type="submit">Save</button> -->
					<span class=".integers" style='color:#000000'>12345</span>
					<p>nmdbdnmfb</p>
				</form>
				

			</div>
		</div>
		<script>
			jQuery(document).ready(function( $ ) {
        $('.integers').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
	</body>
</html>