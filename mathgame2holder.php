<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
    <meta name="description" content="Game holder" />
    <meta name="keywords" content="PHP, MySql" />
	<meta name="author" content="(Create the template) Fengei Xie, (Editor) Ju Han Ng"  />

	<link href="styles/style.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
  	integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
  	crossorigin="anonymous">

	<title>Game information</title>
</head>


<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
      header('Location: login.php');
    }
?>


<body>



	<?php
	require_once 'header.inc';
	?>



	<div class="container">
		<div class="row" style="text-align: center;">
			<h1 class="page-header" style="margin-top:8vh; margin-bottom:4vh; padding-left: 1vw;">Multiply</h1>
		</div>
		<div class="row">
			<div class="col-sm-4 col-md-4" style="height: 350px;">
				<div class="jumbotron" style="padding-right: 10px;padding-left: 10px;">
					<p>A fun way for children to practice their multiply.
					</p>
				</div>
			</div>
			<div class="col-sm-8 col-md-8 mtm">
				<img width="100%" src="images/mathgame2inside.png" />
				<p style="position: absolute;left: 45%;top: 45%;"><a href="./mathgame2/index.php" target="_blank" class="btn btn-primary" role="button">play</a></p>
			</div>
		</div>
		<div class="row" style="text-align: left; margin-top:8vh; padding-left: 1vw;">
			<h2 class="page-header">More Games</h2>
		</div>
		<div class="row" style="margin-top: 15px;height: 350px;">
			<div class="bs-example" data-example-id="thumbnails-with-custom-content">
				<div class="row">
					<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<img data-src="holder.js/100%x200" alt="100%x200" src="images/mathgame1.png" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
						<div class="caption">
						<a href="./mathgame1holder.php" ><h3>Addition & Subtraction</h3></a>
						</div>
					</div>
					</div>

					<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<img data-src="holder.js/100%x200" alt="100%x200" src="images/mathgame3.png" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
						<div class="caption">
						<a href="./mathgame3holder.php"><h3>Arithmetic</h3></a>
						</div>
					</div>
					</div>
					<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<img data-src="holder.js/100%x200" alt="100%x200" src="images/englishgame1.jpg" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
						<div class="caption">
						<a href="./englishgame1holder.php"><h3>Punctuation</h3></a>
						</div>
					</div>
					</div>
					<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<img data-src="holder.js/100%x200" alt="100%x200" src="images/sciencegame1.jpg" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
						<div class="caption">
						<a href="./sciencegame1holder.php"><h3>Science</h3></a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<?php
	require_once 'footer.inc';
	?>



</body>
