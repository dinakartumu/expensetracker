<!DOCTYPE html>
<html>
<!-- page to display all tag details -->
	<head>
		<?php require_once "connection.php"; ?>
		<link rel="stylesheet" href="css/style.css" text="css">
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
				<?php 

				$categories=$_REQUEST["categories"];
			
					$result = mysql_query("select * from cat_expenses where categories='$categories'");
					$rows = mysql_num_rows($result);
						if($rows)
						{
							$i = 0;
							while($row = mysql_fetch_array($result))
								{ 
						
									$categories=$row['categories'];
									$description=$row['description'];
									$money=$row['expense'];
								
									echo "<div class='expenses'>";
									echo "<div class='description'>";
									echo "<h3>".$categories."</h3>";
									echo "<p>".$description."</p>";
									echo "</div>";
									echo "<div class='money'>";
									echo "<h4>".$money."</h4>";
									echo "</div>";
									echo "</div>";
								}
						}

				 ?>

				<div class="button">
					<button><a href="addform.php"><span>+</span></a></button>
				</div>
			</div>
		</div>
	</body>
</html>