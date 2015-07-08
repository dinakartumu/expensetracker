<?php 
include "connection.php";

$jsonText = $_GET['textarea'];
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);
// $jsonTitle = $_GET['textarea1'];
// $decodedTitle = html_entity_decode($jsonTitle);
// $tagss = json_decode($decodedTitle, true);
$title=$_GET['textarea1'];
$title1=$_GET['textarea2'];

$result2 = mysql_query("INSERT INTO expenses (`title`, `money`, `tags`, `userselecteddate`) VALUES ('Food','100','food,change','')");
// echo "$result2<br>";
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

// $cou = count($myArray);
// //print_r($myArray);

// for ($i=0; $i <=$cou ; $i++) 
// { 
// 	// echo "$myArray[$i]<br>";
// 	$result = mysql_query("select * from tags where tag_name = '$myArray[$i]'");
// 	$rows = mysql_num_rows($result);
// 	// echo "$rows";
// 	if($rows)
// 		{
			
// 			while($row = mysql_fetch_array($result))
// 				{ 
					
					
// 					$tags=$row['tag_id'];
// 					echo "$article_idq<br>";
// 					echo "$tags<br>";
// 					// this is div that shows the data from that we get from database

// 					$result1 = mysql_query("INSERT INTO arttcle_tags (article_id, tag_id) VALUES ('$article_idq','$tags')");
										
// 					echo "$result1<br>";
// 				}
// 		}
					
// 	// $sql = "INSERT INTO cat_expenses (date_selected, categories, description, expense) VALUES ('$date','$categories','$description','$money')";
// }

// echo $str = implode (", ", $cou);
// echo $tagss;
echo $title;
// echo $cou;
?>
