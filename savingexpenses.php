<?php 
include "connection.php";

$today = date("Y-m-d");
$expensetype=$_GET['expensetype'];
$description=$_GET['description'];
$jsonText = $_GET['textarea'];
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);
// $tags=$_GET['textarea'];
$money=$_GET['money'];
$userselecteddate = $_GET['dataselected'];

// print_r($myArray);
// echo $description;
// echo "$money";
// echo $userselecteddate;
// echo $expensetype;
$cou = count($myArray);

// code to insert expense into database
$result2 = mysql_query("INSERT INTO expenses (`title`, `money`, `tags`, `userselecteddate`) VALUES ('$description','$money','$cou','$userselecteddate')");
// code for getting last added expense id 
$result3 = mysql_query("SELECT * from expenses order by article_id DESC limit 1");
$rows1 = mysql_num_rows($result3);
// echo "$rows1";
if($rows1)
	{
		
		while($row1 = mysql_fetch_array($result3))
			{ 
	
				$article_idq=$row1['article_id'];
			
				// echo "$article_idq";
			
			}
	}


//print_r($myArray);


for ($i=0; $i <$cou ; $i++) 
{ 
	// echo "$myArray[$i]<br>";
	// code for getting tags id number
	$result = mysql_query("select * from tags where tag_name = '$myArray[$i]'");
	$rows = mysql_num_rows($result);
	// echo "$rows";
	if($rows)
		{
			
			while($row = mysql_fetch_array($result))
				{ 
		
					$tags=$row['tag_id'];
					// code for storing article id with tagid
					$result1 = mysql_query("INSERT INTO arttcle_tags (article_id, tag_id) VALUES ('$article_idq','$tags')");
										
				}
		}
					
	// $sql = "INSERT INTO cat_expenses (date_selected, categories, description, expense) VALUES ('$date','$categories','$description','$money')";
}

//code for displaying expenses of today expenses
echo "<input type='date' name='year_week' id='selecteddate' value='$today'>";
	// 		<button type='button' id='submit'>Click Me</button>";
	$result = mysql_query("select * from expenses where userselecteddate='$today' order BY userselecteddate DESC");
	$rows = mysql_num_rows($result);
	// echo "$rows";
		if($rows)
		{
			
			while($row = mysql_fetch_array($result))
				{ 
					
					$description=$row['title'];
					$tags=$row['tags'];
					$expense=$row['money'];
					$datecreated=$row['userselecteddate'];
					$onlyday= date('Y-m-d', strtotime("$datecreated"));
					// this is div that shows the data from that we get from database

					echo "<div class='expenses wow fadeInUp'>";
					echo "<div class='description'>";
					echo "<h3>".$description."</h3>";
					echo "<p>".$tags."</p>";
					echo "<p>".$onlyday."</p>";
					echo "</div>";
					echo "<div class='money'>";
					echo "<h4>".$expense."</h4>";
					echo "</div>";
					echo "</div>";
				}
		}	
 ?>
 <script type="text/javascript">
		$( "#selecteddate" ).change(function() {
    	// var thiss='#'+this.id;
  		$.ajax({
          method: "POST",
          url: "selecteddates.php",
          data: { selecteddates: $('#selecteddate').val(),inputType: $('#selecteddate').attr('type')}
      	  })
          .done(function( msg ) { 
            // alert(msg); 
            // $("#selectedresults").empty();
             $("#result").empty();
            $( "#selectedresults" ).append( msg );
          });
		});
</script>