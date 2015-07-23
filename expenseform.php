<?php

$today = date("Y-m-d");
$value=$_GET['buttonvalue'];
echo "$value";
echo"<div id='expense_entry' class='wow zoomIn' >
		<select id='expense_type' class='wow zoomIn' data-wow-duration='0.4s' data-wow-delay='0.2s'> 
						<option value='expense'>Expense</option>	
						<option value='income'>Income</option>							
		</select>
		<input type='text' id='description' class='wow zoomIn' data-wow-delay='0.2s' data-wow-duration='0.4s' placeholder='Description'>
		<textarea id='textarea' rows='1' class='wow zoomIn'   data-wow-delay='0.2s' data-wow-duration='0.4s' style='padding-top:7px;margin-left:35%'></textarea>
		<input id='money' type='number' placeholder='$'' required class='wow zoomIn' placeholder='$' data-wow-delay='0.3s' data-wow-duration='0.4s'>
		<input id='dateselected' type='date' value='$today' class='wow zoomIn' data-wow-delay='0.4s' data-wow-duration='0.4s'>
		<button id='savebutton' type='submit' class='wow zoomIn'  data-wow-delay='.5s' data-wow-duration='0.4s'>Save</button>
		<button id='cancelbutton' class='wow zoomIn'  data-wow-delay='.5s'>Cancel</button>
	</div>";

?>
<script>
	// code for autocomplete of tags 
    $('#textarea')
    .textext({
        plugins : 'autocomplete filter tags ajax',
        ajax : {
            url : 'searchTags.php',
            dataType : 'json',
            cacheResults : true
        }
    });

    //code for save button
	$( "#savebutton" ).click(function() {
		var a1=$('#textarea').textext() [0].hiddenInput().val();
		var b1=$('#description').val();
		var c1=$('#money').val();
		// alert(a1);
		// alert(b1.length);
		// alert(c1.length);
        $("#result").empty();
        $("#selectedresults").empty();
       	$("#datesmenu").show();
      	$(".test").css( "color", "black" );
        $("#target").css( "color", "#5fcf80" );
			$.ajax({
	      method: "POST",
	      url: "gettingexpenses.php",
	      data: { textarea: $('#textarea').textext() [0].hiddenInput().val(), description:$('#description').val(), 
	      dataselected:$('#dateselected').val(), money:$('#money').val(), expensetype:$('#expense_type').val()}
	  	  })
	      .done(function( msg ) { 
	        // alert(msg); 
	        $("#form").empty();
	        $( "#result" ).append( msg );
	        	// $("#target").css( "color", "#5fcf80" );
	      });
		});

	// code for cancel button
	$( "#cancelbutton" ).click(function() {
		$("#datesmenu").show();
		$(".test").css( "color", "black" );
        $("#target").css( "color", "#5fcf80" );
		$.ajax({
	      	method: "POST",
	      	url: "gettingexpenses.php",
      	})
      	.done(function( msg ) { 
	        $("#form").empty();
	        $( "#result" ).append( msg );
      	});
	});

</script>



