<?php 
include 'connection.php';
//code for hiding errors
error_reporting(0);	
$selectedweeks=$_GET['selecteddates'];
$weekno= date('W', strtotime("$selectedweeks"));
$yearno= date('Y', strtotime("$selectedweeks"));
$monthno= date('m', strtotime("$selectedweeks"));
$required= "$yearno-W{$weekno}";
$startofweek    = date('Y-m-d', strtotime("$required-1"));
$endoftheweek    = date('Y-m-d', strtotime("$required-7"));
$type=$_GET['inputType'];
// echo $selectedweeks;
// echo $type;
if ($type=="date") {
	echo "<input type='date' name='year_week' id='selecteddate' value='$selectedweeks'>";
	$result = mysql_query("select * from expenses where userselecteddate='$selectedweeks' order BY userselecteddate DESC");
}
else if ($type=="week") {
	echo "<div><input type='week' id='selecteddate' value='$required'>";
	$result = mysql_query("SELECT * FROM expenses WHERE userselecteddate >= '$startofweek' AND userselecteddate <= '$endoftheweek' order BY userselecteddate DESC");
}
else if ($type=="month") {
	echo " <input type='month' id='selecteddate' value='$yearno-{$monthno}'>";
	$result = mysql_query("select * from expenses where MONTH(userselecteddate)='$monthno' order BY userselecteddate DESC");
}
else{
	$result4 = mysql_query("SELECT DISTINCT YEAR(userselecteddate) as years from expenses");
	$yearrows= mysql_num_rows($result4);
	if($yearrows)
	{	
		echo "<select id='selecteddate'>";
		echo "<option>".$selectedweeks."</option>";
		while($yearrow = mysql_fetch_array($result4))
			{ 
				$years=$yearrow['years'];
				// echo "$years";
				echo "<option value=".$years.">".$years."</option>";
			}
		echo "</select>";
	}
	$result = mysql_query("select * from expenses where YEAR(userselecteddate)='$selectedweeks' order BY userselecteddate DESC");
}
	
	$rows = mysql_num_rows($result);
	// echo "$rows";
		if($rows)
		{
			
			while($row = mysql_fetch_array($result))
				{ 
					
					$rowsno=$rowsno+1;
					$time="".$rowsno."s";
					// echo "$time";
					$expense_id=$row['article_id'];
					$description=$row['title'];
					$tags=$row['tags'];
					$expense=$row['money'];
					$datecreated=$row['userselecteddate'];
					$onlyday= date('Y-m-d', strtotime("$datecreated"));
					$expensetype=$row['expense_type'];
					$userid=$row['userid'];
					// this is div that shows the data from that we get from database

					echo "<div class='expenses wow zoomIn' data-wow-duration='0.4s' data-wow-delay='0.$time' id='$expense_id'>";
					echo "<div class='description'>";
					echo "<h3 class='wow fadeInUp'>".$userid."</h3>";
					//code for getting tags of the each expense
					$tagresult = mysql_query("select t.`tag_name` as tagnames  from expenses e, arttcle_tags a, tags t where e.`article_id`= a.`article_id` and a.`tag_id`= t.`tag_id` and e.`article_id`='$expense_id'");
					$tagrows= mysql_num_rows($tagresult);

						if($tagrows)
						{				
							while($tagrow = mysql_fetch_array($tagresult))
								{ 
									$tagnames=$tagrow['tagnames'];
									echo "<p class='wow fadeInUp' data-wow-delay='0.4s'>".$tagnames."</p>";							
								}
						}
					echo "<p class='wow fadeInUp' data-wow-delay='0.7s'>".$expense_id."</p>";
					echo "</div>";
					echo "<div class='money'>";
					// echo "<p>".$expensetype."</p>";
					echo "<h4 class='wow fadeInUp' data-wow-delay='0.$time'>".$expense."</h4>";
					echo "</div>";
					echo "</div>";
				}
		}

		else{
		echo "<div class='expenses wow fadeInUp' data-wow-duration='0.5s'><div class='description'><h3>No Expense Added To this $type </h3></div></div>";
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
        	$("#selectedresults").empty();
         	$("#result").empty();
        	$( "#selectedresults" ).append( msg );
     	 });
	});

$(".expenses").dblclick(function() {
  		var a=$(this).attr("id");
  		alert(a);
});
</script>