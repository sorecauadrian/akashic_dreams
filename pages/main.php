<?php
	require_once("./db_connection.php");
	require_once("./module/variables.php");

	$query = "SELECT * FROM dreams WHERE id_user = '" . $_SESSION['id'] . "' ORDER BY id DESC";
	$result = mysqli_query($link, $query);

	if (isset($_POST['delete']))
		mysqli_query($link, "DELETE FROM dreams WHERE id = {$_POST['dream_id']}");
	
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
		<link rel = "icon" type = "image/png" href = "./logos/logon.png">
        <script src="https://kit.fontawesome.com/d42c2a7423.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>akashic dreams</title>
        <script type="text/javascript">
        	$("div.story").text(function(index, currentText) {
    			return currentText.substr(0, 30);
			});
        </script>
    </head>
    <body>
    	<div class="background">
	        <?php
				include "./module/navbar.php";
			?>
			<div class="container-fluid" style="width: 90%;">
				<?php
					if ($result)
						while($row = mysqli_fetch_assoc($result))
						{
				?>
							<div class="border border-1 rounded rounded-3 my-3 p-3 bg-lucidity-<?=$row['lucidity']?>" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row['id']?>">
								<div class="d-flex justify-content-between mb-3">
									<div>
										<?=DATE_FORMAT(new DateTime($row["date_time"]), "d M Y, H:i");?>
									</div>
									<div>
										<i class="mx-2 fa fa-thin fa-<?=$clarity_icon[$row["clarity"]]?> fa-2x"></i>
										<i class="mx-2 fa fa-thin fa-<?=$mood_icon[$row["mood"]]?> fa-2x"></i>
									</div>
								</div>
								<div class="row my-2">
									<div class="col fw-bold"><?=$row["title"]?></div>
								</div>
								<div class="row mt-2">
									<div class="col"><?=mb_strimwidth($row["story"], 0, 350, "...");?></div>
								</div>
							</div>
							<div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content" style="background-color: #4D1E6A;">
										<div class="modal-header">

											<form action="./index.php?page=main" method="post">
												<input type="hidden" name="dream_id" value="<?=$row['id']?>">
												<button type="submit" class="btn btn-danger mx-2" name="delete"><i class="fa fa-thin fa-trash-can"></i></button>
											</form>

											<button type="button" class="btn btn-warning mx-2 edit"><i class="fa fa-thin fa-pen"></i></button>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
										</div>
										<div class="modal-body">
											<p><?=DATE_FORMAT(new DateTime($row["date_time"]), "d M Y, H:i");?></p>
											<h6 class="modal-title"><?=$row["title"]?></h6><br/>
											<pre style="white-space: pre-wrap; word-wrap: break-word"><?=$row["story"]?></pre>
											<br/>
											<div class="d-flex justify-content-between align-items-center">
												<div style="min-width: 50px;">sleep</div>
												<div class="progress mx-4" style="height: 5px; width: 100%;">
													<div class="progress-bar bg-progress" role="progressbar" style="width: <?=25 * ($row["sleep_quality"] - 1)?>%;" aria-valuenow="<?=($row["sleep_quality"] - 1)?>" aria-valuemin="0" aria-valuemax="4"></div>
												</div>
												<i class="fa fa-solid fa-circle fa-2x" id="circle<?=$row["sleep_quality"]?>" style="min-width: 50px;"></i>
											</div>
											<hr>
											<div class="d-flex justify-content-between align-items-center">
												<div style="min-width: 50px;">clarity</div>
												<div class="progress mx-4" style="height: 5px; width: 100%;">
													<div class="progress-bar bg-progress" role="progressbar" style="width: <?=25 * ($row["clarity"] - 1)?>%;" aria-valuenow="<?=($row["clarity"] - 1)?>" aria-valuemin="0" aria-valuemax="4"></div>
												</div>
												<i class="fa fa-solid fa-<?=$clarity_icon[$row["clarity"]]?> fa-2x" style="min-width: 50px;"></i>
											</div>
											<hr>
											<div class="d-flex justify-content-between align-items-center">
												<div style="min-width: 50px;">mood</div>
												<div class="progress mx-4" style="height: 5px; width: 100%;">
													<div class="progress-bar bg-progress" role="progressbar" style="width: <?=25 * ($row["mood"] - 1)?>%;" aria-valuenow="<?=($row["mood"] - 1)?>" aria-valuemin="0" aria-valuemax="4"></div>
												</div>
												<i class="fa fa-solid fa-<?=$mood_icon[$row["mood"]]?> fa-2x" style="min-width: 50px;"></i>
											</div>
											<hr>
											<div class="d-flex justify-content-between align-items-center">
												<div style="min-width: 50px;">lucidity</div>
												<div class="progress mx-4" style="height: 5px; width: 100%;">
													<div class="progress-bar bg-progress" role="progressbar" style="width: <?=50 * ($row["lucidity"] - 1)?>%;" aria-valuenow="<?=($row["lucidity"] - 1)?>" aria-valuemin="0" aria-valuemax="2"></div>
												</div>
												<i class="fa fa-solid fa-circle fa-2x bg-lucidity-<?=$row['lucidity']?> text-background" style="min-width: 50px;"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
				<?php
						}
					else
						echo "write a dream using the '+' button.";
				?>
			</div>
			<form action="./index.php?page=add_dream" method="post">
	    		<button class="btn add-button position-fixed rounded-circle" style="right: 2.5%; bottom: 5%; width: 75px; height: 75px;"><i class="fa fa-thin fa-plus fa-3x"></i></button>
			</form>
			<?php
				include "./module/footer.php";
			?>
		</div>
    </body>
</html>