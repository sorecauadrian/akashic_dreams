<?php
	require_once("./db_connection.php");
	require_once("./module/functions.php");
	require_once("./module/variables.php");

	$title = $story = $sleep_quality = $clarity = $mood = $lucidity = '';
	$title_err = $story_err = $sleep_quality_err = $clarity_err = $mood_err = $lucidity_err = '';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		/*
		valid_text($_POST["title"], $title_err, $title, "title");
		valid_text($_POST["story"], $story_err, $story, "dream");
		valid_value($_POST["sleep_quality"], $sleep_quality_err, $sleep_quality, "sleep_quality", 0, 5);
		valid_value($_POST["clarity"], $clarity_err, $clarity, "clarity", 0, 5);
		valid_value($_POST["mood"], $mood_err, $mood, "mood", 0, 5);
		valid_value($_POST["lucidity"], $lucidity_err, $lucidity, "lucidity", 0, 5);
		*/
		if (!isset($_POST["title"]) || empty(trim($_POST["title"])))
			$title_err = "please enter a title.";
		else
			$title = trim($_POST["title"]);

		if (!isset($_POST["story"]) || empty(trim($_POST["story"])))
			$story_err = "please write the dream you've had.";
		else
			$story = trim($_POST["story"]);

		if (!isset($_POST["sleep_quality"]) || ($_POST["sleep_quality"] < 1 || $_POST["sleep_quality"] > 5))
			$sleep_quality_err = "please evaluate correctly your sleep quality.";
		else
			$sleep_quality = trim($_POST["sleep_quality"]);

		if (!isset($_POST["clarity"]) || ($_POST["clarity"] < 1 || $_POST["clarity"] > 5))
			$clarity_err = "please evaluate correctly your clarity.";
		else
			$clarity = trim($_POST["clarity"]);

		if (!isset($_POST["mood"]) || ($_POST["mood"] < 1 || $_POST["mood"] > 5))
			$mood_err = "please evaluate correctly your mood.";
		else
			$mood = trim($_POST["mood"]);

		if (!isset($_POST["lucidity"]) || ($_POST["lucidity"] < 0 || $_POST["lucidity"] > 100))
			$lucidity_err = "please evaluate correctly your lucidity."; 
		else
			if (trim($_POST["lucidity"]) <= 20)
				$lucidity = 1;
			else if (trim($_POST["lucidity"]) >= 80)
				$lucidity = 3;
			else
				$lucidity = 2;

		if (empty($title_err) && empty($story_err) && empty($sleep_quality_err) && empty($clarity_err) && empty($mood_err) && empty($lucidity_err))
		{
			$date = $_POST['date'] . " " . $_POST['time'];
			$query = "INSERT INTO dreams (id_user, date_time, title, story, sleep_quality, clarity, mood, lucidity) VALUES ({$_SESSION['id']}, '" . $date . "', '" . $title . "', '" . $story . "', '" . $sleep_quality . "', '" . $clarity . "', '" . $mood . "', '" . $lucidity . "')";
			if ($result = mysqli_query($link, $query))
			{
				header("location: ./index.php?page=main");
				exit;
			}
			else
				printf("error: %s\n", mysqli_error($link));
		}
	}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>akashic dreams - add a dream</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
		<link rel = "icon" type = "image/png" href = "./logos/logon.png">
        <script src="https://kit.fontawesome.com/d42c2a7423.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
			$(function(){
				var current = 0, current_step, next_step, fieldset = 2;
			    $(".next").click(function()
			    {
			    	$('fieldset:nth-child(' + fieldset + ')').hide();
			    	$('fieldset:nth-child('+ ++fieldset + ')').show();
			    	fix_step_indicator(++current);
			  	});
			  	$(".previous").click(function()
			  	{
			    	$('fieldset:nth-child(' + fieldset + ')').hide();
			    	$('fieldset:nth-child(' + --fieldset + ')').show();
			    	$('#range_input').hide();
			    	fix_step_indicator(--current);
			  	});
			  	$(".btn-check").click(function()
			  	{
		  			$('fieldset:nth-child(' + fieldset + ')').hide();
		    		$('fieldset:nth-child('+ ++fieldset + ')').show();
		    		fix_step_indicator(++current);
			  	});
			  	$("#btn41").click(function()
			  	{
			  		$('#range_input').val(0); 
		  			$('#range_input').show();
			  	});
			  	$("#btn42").click(function()
			  	{
			  		$('#range_input').val(50); 
		  			$('#range_input').show();
			  	});
			  	$("#btn43").click(function()
			  	{
			  		$('#range_input').val(100); 
		  			$('#range_input').show();
			  	});
			  	fix_step_indicator(current);
			  	

			  	/*
				
				function validateForm() 
				{
					// This function deals with validation of the form fields
					var x, y, i, valid = true;
					x = document.getElementsByTagName("fieldset");
					y = x[current_step].getElementsByTagName("input");
					// A loop that checks every input field in the current tab:
					for (i = 0; i < y.length; i++) 
					{
					// If a field is empty...
						if (y[i].value == "") 
						{
					  		// add an "invalid" class to the field:
					  		y[i].className += " invalid";
					  		// and set the current valid status to false
					  		valid = false;
						}
					}
					// If the valid status is true, mark the step as finished and valid:
					if (valid)
						document.getElementsByClassName("step")[current_step].className += " finish";
					return valid; // return the valid status
				}
				*/
				function fix_step_indicator(n) 
				{
					// This function removes the "active" class of all steps...
					for (var i = 0; i < $('.step').length; i++)
						$('.step')[i].className = $('.step')[i].className.replace(" opacity-100", " opacity-25");
					//... and adds the "active" class on the current step:
					$('.step')[n].className += " opacity-100";

					if (n == 0)
			  		{
			  			$('.back').show();
			  			$('.next').show();
			  			$('.previous').hide();
			  			$('.submit').hide();
			  		}
			  		else if (n == $('.step').length - 1)
			  		{
			  			$('.back').hide();
			  			$('.previous').show();
			  			$('.submit').show();
			  			$('.next').hide();
			  		}
			  		else
			  		{
			  			$('.back').hide();
			  			$('.next').show();
			  			$('.previous').show();
			  			$('.submit').hide();
			  		}
				}
			});
        </script>
		<style type="text/css">
  			#dream_form fieldset:not(:first-of-type), #range_input, .btn-submit
  			{
    			display: none;
  			}
			textarea:focus, input:focus, textarea, input, label
			{
   				color: white !important;
			}
			.step 
			{
				height: 15px;
				width: 15px;
				background-color: #FFF;  
				border-radius: 50%;
				display: inline-block;
			}
  		</style>
	</head>
	<body>
		<div class="container-fluid w-100 background">
			<form action="./index.php?page=add_dream" method="post" id="dream_form">
				<div class="position-relative mt-4" style="height: 50px;">
					<a type="button" href="./index.php?page=main" name="back" class="back text-decoration-none position-absolute top-0" style="left: 5px;"><i class="fa fa-thin fa-arrow-left fa-2x text-white"></i></a>
					<a type="button" name="previous" class="previous text-decoration-none position-absolute top-0" style="left: 5px;"><i class="fa fa-thin fa-angle-left fa-2x text-white"></i></a>
					<div class="position-absolute top-0 start-50 translate-middle-x">
		    			<span class="step opacity-25"></span>
		    			<span class="step opacity-25"></span>
		    			<span class="step opacity-25"></span>
		    			<span class="step opacity-25"></span>
		    			<span class="step opacity-25"></span>
		  			</div>
		  			<a type="button" name="next" class="next text-decoration-none position-absolute top-0" style="right: 5px;"><i class="fa fa-thin fa-angle-right fa-2x text-white"></i></a>
		  			<a type="submit" name="submit" class="submit text-decoration-none position-absolute top-0 end-0" onclick="$('#dream_form').submit(); return false;" style="right: 5px;"><i class="fa fa-thin fa-arrow-right fa-2x text-white"></i></a>
  				</div>
				<fieldset class="container-fluid" style="width: 90%">
					<div class="row my-2">
						<div class="col-8">
							<label for="date" class="col-form-label">date</label>
							<input type="text" class="form-control text-white border border-white bg-transparent rounded rounded-3" name="date" value="<?=date('Y-m-d')?>" readonly>
						</div>
						<div class="col-4">
							<label for="time" class="col-form-label">time</label>
							<input type="text" class="form-control text-white border border-white bg-transparent rounded rounded-3" name="time" value="<?=date('H:i:s')?>" readonly>
						</div>
					</div>
					<div class="row my-2">
						<div class="col">
	  						<label for="title" class="col-form-label">title</label>
	  						<input type="text" class="form-control text-white border border-white bg-transparent rounded rounded-3" name="title">
						</div>
					</div>
					<div class="row my-2">
						<div class="col">
							<label for="story" class="col-form-label">story</label>
							<textarea class="form-control text-white border border-white bg-transparent rounded rounded-3" name="story"></textarea>
						</div>
					</div>
				</fieldset>
				<fieldset class="container-fluid" style="width: 90%;">
					<h2 class="text-center mb-4">how was your dream?</h2>
					<div class="btn-group-vertical w-100">
						<?php
							for ($i = 1; $i <= 5; $i++)
							{
						?>
								<input type="radio" class="btn-check" name="<?=$sleep_quality_array[0]?>" id="btn1<?=$i?>" value=<?=$i?>>
								<label class="btn btn-outline-light bg-transparent rounded-pill position-relative my-2" for="btn1<?=$i?>" style="height: 50px;">
									<i class="fa fa-solid fa-circle fa-2x position-absolute top-50 translate-middle-y" style="left: 2.5%;" id="circle<?=$i?>"></i>
									<span class="position-absolute top-50 translate-middle fs-4"><?=$sleep_quality_array[$i]?></span>
									<i class="fa fa-thin fa-angle-right fa-2x position-absolute top-50 translate-middle-y" style="right: 2.5%;"></i>
								</label>
						<?php
							}
						?>
					</div>
				</fieldset>
				<fieldset class="container-fluid" style="width: 90%;">
					<h2 class="text-center mb-4">how clear do you remember your dream?</h2>
					<div class="btn-group-vertical w-100">
						<?php
							for ($i = 1; $i <= 5; $i++)
							{
						?>
								<input type="radio" class="btn-check" name="<?=$clarity_array[0]?>" id="btn2<?=$i?>" value=<?=$i?>>
								<label class="btn btn-outline-light bg-transparent rounded-pill position-relative my-2" for="btn2<?=$i?>" style="height: 50px;">
									<i class="fa fa-thin fa-<?=$clarity_icon[$i]?> fa-2x position-absolute top-50 translate-middle-y" style="left: 2.5%;"></i>
									<span class="position-absolute top-50 translate-middle fs-4"><?=$clarity_array[$i]?></span>
									<i class="fa fa-thin fa-angle-right fa-2x position-absolute top-50 translate-middle-y" style="right: 2.5%;"></i>
								</label>
						<?php
							}
						?>
					</div>
				</fieldset>
				<fieldset class="container-fluid" style="width: 90%;">
					<h2 class="text-center mb-4">what was the mood of your dream?</h2>
					<div class="btn-group-vertical w-100">
						<?php
							for ($i = 1; $i <= 5; $i++)
							{
						?>
								<input type="radio" class="btn-check" name="<?=$mood_array[0]?>" id="btn3<?=$i?>" value=<?=$i?>>
								<label class="btn btn-outline-light bg-transparent rounded-pill position-relative my-2" for="btn3<?=$i?>" style="height: 50px;">
									<i class="fa fa-thin fa-<?=$mood_icon[$i]?> fa-2x position-absolute top-50 translate-middle-y" style="left: 2.5%;"></i>
									<span class="position-absolute top-50 translate-middle fs-4"><?=$mood_array[$i]?></span>
									<i class="fa fa-thin fa-angle-right fa-2x position-absolute top-50 translate-middle-y" style="right: 2.5%;"></i>
								</label>
						<?php
							}
						?>
					</div>
				</fieldset>
				<fieldset class="container-fluid text-white" style="width: 90%;">
					<h2 class="text-center mb-4">how lucid was your dream?</h2>
					<div class="row" style="height: 250px;">
						<div class="col-4">
							<button type="button" class="btn btn-outline-light bg-lucidity-1 w-100 h-100 rounded-pill" id="btn41">not lucid</button>
						</div>
						<div class="col-4">
							<button type="button" class="btn btn-outline-light bg-lucidity-2 w-100 h-100 rounded-pill" id="btn42">semi lucid</button>
						</div>
						<div class="col-4">
							<button type="button" class="btn btn-outline-light bg-lucidity-3 w-100 h-100 rounded-pill" id="btn43">lucid</button>
						</div>
					</div>
					<input type="range" class="form-range my-4" min="0" max="100" name="lucidity" id="range_input" style="color: purple;">
					<h5 class="text-center mt-4">a lucid dream means you became lucid and recognised that you are in a dream</h5>
				</fieldset>
			</form>
		</div>
	</body>
</html>