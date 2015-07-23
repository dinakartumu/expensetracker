<!DOCTYPE html>
<html>
	<head>
		<?php require_once "header.html"; ?>	 
	</head>
	<body>
		<div>
			<!-- navigation bar -->
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
				
				<!-- duv for displaying expense entry form -->
				<div id="form">
					
				</div>
				
				<!-- div for showing type of dates -->
				<!-- <div class='datemenu'>
					<nav class="wow zoomIn" id="dates">
						<ul id="datemenu" >
							<li><input type="button" class="test" id="target" value="Today"></li>
							<li><input type="button" class="test wow fadeInLeft" id="target1" value="Week" data-wow-delay='0.1s'></li>
							<li><input type="button" class="test wow fadeInLeft" id="target2" value="Month" data-wow-delay='0.2s'></li>
							<li><input type="button" class="test wow fadeInLeft" id="target3" value="Year" data-wow-delay='0.3s'></li>	
						</ul>
					</nav>
				</div> -->
				<div id='datesmenu' class="wow zoomIn">
					<div class='test wow fadeInLeft' id="target" value="Today" data-wow-delay='0'><span>Today</span></div>
					<div class='test wow fadeInLeft' id="target1" value="Week" data-wow-delay='0.2s'><span>Week</span></div>
					<div class='test wow fadeInLeft' id="target2" value="Month" data-wow-delay='0.3s'><span>Month</span></div>
					<div class='test wow fadeInLeft' id="target1" value="Year" data-wow-delay='0.4s'><span>Year</span></div>
				</div>

				
				<div class="button">
				<!-- <input type="button" id="getexpenseform" value="+"> -->
					<button id="getexpenseform"><span>+</span></a></button>
				</div>
				
				<!-- div for diplaying expenses -->
				<div id="result">
					<?php include "gettingexpenses.php"; ?>
				</div>

				<!-- div for displaying expenses for particular date or week or month -->
				<div id="selectedresults">
					
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
    
    	//code for getting weekly, monthly and year reports
        $( ".test" ).click(function() {
    	// var thiss='#'+this.id;
    	$(".test").css( "color", "black" );
	 	$(this).css( "color", "#5fcf80" );
  		$.ajax({
          method: "POST",
          url: "gettingexpenses.php",
          data: { daytype: $(this).attr("value")}
      	  })
          .done(function( msg ) { 
            // alert(msg); 
            $("#result").empty();
            $("#selectedresults").empty();
            $("#form").empty();
            $( "#result" ).append( msg );
            
          });
		});

		//code for getting expense entry form when user enter + button
		$( "#getexpenseform" ).click(function() {
		 	$("#datesmenu").hide();
			$("#form").empty(); 
    	// var thiss='#'+this.id;
  		$.ajax({
          method: "POST",
          url: "expenseform.php",
          data: { buttonvalue: $(this).attr("value")}
      	  })
          .done(function( msg ) { 
         	$("#result").empty();
          	$("#selectedresults").empty();
            $("#form" ).append( msg );
          });
		});    
	</script>
</html>


