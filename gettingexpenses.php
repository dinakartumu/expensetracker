<?php	
include "connection.php";
// code for hiding errors
error_reporting(0);	
// code for getting userip address
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ipaddress=getRealIpAddr();
$IP1_bin = current(unpack("A4",inet_pton($ipaddress)));
$IP1_string = inet_ntop(pack("A4",$ipaddress));
// echo $IP1_string;
// inet_pton('172.27.1.4') ;

$today = date("Y-m-d");
// echo "$today";
$weekno= date('W', strtotime("$today"));
$yearno= date('Y', strtotime("$today"));
$monthno= date('m', strtotime("$today"));
$required= "$yearno-W{$weekno}";
$startofweek    = date('Y-m-d', strtotime("$required-1"));
$endoftheweek    = date('Y-m-d', strtotime("$required-7"));
$dateselected=$_GET['daytype'];

// saving expenses
$expensetype=$_GET['expensetype'];
$description=$_GET['description'];
$jsonText = $_GET['textarea'];
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);
$money=$_GET['money'];
$userselecteddate = $_GET['dataselected'];
$cou = count($myArray);

if (strlen($expensetype)!=0) {

	// code to insert expense into database
	$result2 = mysql_query("INSERT INTO expenses (`title`, `money`, `tags`, `userselecteddate`,`expense_type`,`userid`) VALUES ('$description','$money','$cou','$userselecteddate','$expensetype','$ipaddress')");
	// code for getting last added expense id 
	$result3 = mysql_query("SELECT * from expenses order by article_id DESC limit 1");
	$rows1 = mysql_num_rows($result3);
	// echo "$rows1";
	if($rows1)
		{	
			while($row1 = mysql_fetch_array($result3))
				{ 
					$article_idq=$row1['article_id'];
				}
		}
	// code for storing article tags into database
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
	}
	echo "<input type='date' name='year_week' id='selecteddate' value='$today' class='wow fadeInUp'>";
		// 		<button type='button' id='submit'>Click Me</button>";
		$result = mysql_query("select * from expenses where userselecteddate='$today' order BY userselecteddate DESC");
} // end of if condition

//code for getting expenses for selected date
else if($dateselected=="Today" || $dateselected=="" )
{
	$datetype=date;
	$datetypevalue=$today;
	// 		<button type='button' id='submit'>Click Me</button>";
	$result = mysql_query("select * from expenses where userselecteddate='$today' order BY userselecteddate DESC");
}
else if ($dateselected=="Week") {
	$datetype=week;
	$datetypevalue=$required;
	
			// <button type='button' id='submit'>Click Me</button></div>";
	$result = mysql_query("SELECT * FROM expenses WHERE userselecteddate >= '$startofweek' AND userselecteddate <= '$endoftheweek' order BY userselecteddate DESC");
}

else if ($dateselected=="Month"){
	$datetype=month;
	$datetypevalue="$yearno-$monthno";
	// echo " <input type='$datetype' id='selecteddate' value='$yearno-{$monthno}' class='wow fadeInUp'>";
  			// <button type='button' id='submit'>Click Me</button></div>";
	$result = mysql_query("SELECT * from expenses where MONTH(userselecteddate)='$monthno' order BY userselecteddate DESC");
}

// for year
else {
	$datetype=yearno;
	$result4 = mysql_query("SELECT DISTINCT YEAR(userselecteddate) as years from expenses");
	$yearrows= mysql_num_rows($result4);
	if($yearrows)
	{	
		echo "<select id='selecteddate'>";
		while($yearrow = mysql_fetch_array($result4))
			{ 
				$years=$yearrow['years'];
				// echo "$years";
				echo "<option value=".$years.">".$years."</option>";
			}
		echo "</select>";
	}
	// echo "$yearrows";
	$result = mysql_query("SELECT * from expenses where YEAR(userselecteddate)='$yearno' order BY userselecteddate DESC");
}
	$rows = mysql_num_rows($result);
	$rowsno=1;
	
		if($rows)
		{	
			// echo "$datetype";
			if($datetype!='yearno')
			{
				echo "<input type='$datetype' name='year_week' id='selecteddate' value='$datetypevalue' class='wow fadeInUp'>";
			}
			while($row = mysql_fetch_array($result))
				{ 	
					// code for generaing time for animation delay
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
					echo "<div class='money' style='width:10%'>";
					// echo "<p>".$expensetype."</p>";
					echo "<h4 class='wow fadeInUp' data-wow-delay='0.$time'>".$expense."</h4>";
					echo "</div>";
					echo "</div>";
				}
		}	
		else{
			if($datetype!='yearno')
			{
				echo "<input type='$datetype' name='year_week' id='selecteddate' value='$datetypevalue' class='wow fadeInUp'>";
			}
			echo "<div class='expenses wow fadeInUp' data-wow-duration='0.4s'><div class='description'><h3>No Expense Added To This $dateselected </h3></div></div>";
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

		//edit functionality
		$(".expenses").dblclick(function() {
  		var a=$(this).attr("id");
  		alert(a);
});
</script>