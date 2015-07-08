<!DOCTYPE html>
<html>
<!-- page to display all tags in database and their total cost and count of each tag  -->
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
					<li><a href="tags.php">Categories</a></li>
					<li><a href="#">About Us</a></li>
				</ul>
			</nav>
			<div id="content">
				<?php 
					$result = mysql_query("SELECT COUNT(categories) as count_category,categories,sum(expense) as total from cat_expenses GROUP BY categories");
					$rows = mysql_num_rows($result);
						if($rows)
						{
							$i = 0;
							while($row = mysql_fetch_array($result))
								{ 
									$count_category=$row['count_category'];
									$categories=$row['categories'];
									$money=$row['total'];
									
									echo "<form action='categoriesdetails.php?categories=$categories' method='post'>";
									echo "<a href='categoriesdetails.php?categories=$categories' id='tags_a'>";
									echo "<div class='expenses' id='title'>";
									echo "<div class='description'>";
									echo "<h3>".$categories."</h3>";
									echo "<p> No of Entries:  ".$count_category."</p>";
									echo "</div>";
									echo "<div class='money'>";
									echo "<h4>".$money."</h4>";
									echo "</div>";
									echo "</div>";
									echo "</a>";
									echo "</form>";
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