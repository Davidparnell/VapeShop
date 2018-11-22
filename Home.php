<!-- We are using a bootscrap template from W3Schools for the basic desgin of our homepage
adding more features and components -->

<!-- Check if the user is logged in and change the content
 of the log in button to reflect that -->
<?php
	$errormsg = "";
	session_start();
	
	if (isset($_SESSION['Login_Status'])) //Is logged in? - set button text
	{
		$login = "Logout";
	}
	else
	{
		$login = "Login";
	}
	
	//Connect to the db and check if logged in 
	$db = mysqli_connect("localhost","root","","groupproject");
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysqli_query($db,"select username from users where username = '$username' and password = '$password'");
	$numrows = mysqli_num_rows($result);
	if ($numrows == 1) // one result indicates successful login
	{
		//session_register("username");
        $_SESSION['Login_Status'] = $username;
		//echo $result;
        header("location: Home.php"); // redir
	}
	else
	{
		$errormsg = "Incorrect User Name and Password";
	}
	
	
?>

<html>
<html lang="en">

<head>
	<title>Vape Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		/* Add a gray background color and some padding to the footer */
		
		.modal-header, h4, .close {
		background-color: #101010;
		color:white !important;
		text-align: center;
		font-size: 30px;
		}
		.modal-footer {
			background-color: #101010;
			color: white;
		}
		
		.btn-block {
			display: block;
			width: 100%;
			background-color: #101010;
		}
    </style>
	<script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});
	</script>
</head>

<body>
	<!-- Headed-->
	<header class="container-fluid text-center">
		<div class="container-fluid">
			<h1>VAPE SHOP</h1>
			<input type="text" placeholder="Search items..">
			<a href="#" class="glyphicon glyphicon-search"></a>
		</div>
	</header>
	
	<!--Nav Bar-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand glyphicon glyphicon-home" href="#"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="Hardware.php">Hardware</a></li>
					<li><a href="Liquid.php">Liquid</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
					<li><button type="button" class="btn btn-default btn-lg" id="myBtn"><?php 
					echo $login; ?></button></li></li>
					
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
						<div class="modal-header" style="padding:35px 50px;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
						</div>
					
						<div class="modal-body" style="padding:40px 50px;">
							<div class="form-group">

							<form role="form" action = "" method = "post">
								<label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
								<input type="text" class="form-control" name="username" placeholder="Enter Username">
								<label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
								<input type="text" class="form-control" name="password" placeholder="Enter password">
							
						
								<div class="checkbox">
									<label><input type="checkbox" value="" checked>Remember me</label>
								</div>
								<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
								<?php 
									echo $errormsg; 
								?>
								</form>
							</div>
						</div>
					
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<p>Not a member? <a href="Register.php">Sign Up</a></p>
							<p>Forgot <a href="#">Password?</a></p>
						</div>
						</div>
					</div>
					</div>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
							<div class="carousel-caption">
								<h3>Item1</h3>
								<p>Special Offer1</p>
							</div>
						</div>

						<div class="item">
							<img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
							<div class="carousel-caption">
								<h3>Item2</h3>
								<p>Special Offer2</p>
							</div>
						</div>
						<div class="item">
							<img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
							<div class="carousel-caption">
								<h3>Item3</h3>
								<p>Special Offer3</p>
							</div>
						</div>
					</div>

					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="well">
					<img src="img/Home/newtovaping.png" class="img-responsive" style="width:100%" alt="Image"></img>
					<h3>New to vaping?</h3>
					<br><br>
					<!-- learn more page -->
					<a href="#part2">
						<p>Learn more here!</p>
					</a>
				</div>
			</div>
		</div>
		<hr>
	</div>

	<div class="container text-center" id="part1">
		<h3>What We Have</h3>
		<br>
		<div class="row">
			<div class="col-sm-3">
				<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
				<p>Current Project</p>
			</div>
			<div class="col-sm-3">
				<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
				<p>Project 2</p>
			</div>
			<div class="col-sm-3">
				<div class="well">
					<p>Some text..</p>
				</div>
				<div class="well">
					<p>Some text..</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="well">
					<p>Some text..</p>
				</div>
				<div class="well">
					<p>Some text..</p>
				</div>
			</div>
		</div>
		<hr>
	</div>

	<div class="container text-center" id="part2">
		<h1>What is Vaping?</h1>
		<br>
		<div class="row">
			<div class="col-sm-5">
				<img src="img/Home/vaping.jpg" class="img-responsive" style="width:100%" alt="Image">
			</div>
			<div class="col-sm-7">
				<h2 style="color:yellowgreen;">A nice, fancy Alternative to Cigarettes</h2>
				<p style="font-size: 16px">An electronic cigarette or e-cigarette is a handheld electronic device that simulates 
					the feeling of smoking. It works by heating a liquid to generate an aerosol, 
					commonly called a "vapor", that the user inhales. 
					Using e-cigarettes is commonly referred to as <b>vaping</b>. 
					The liquid in the e-cigarette, called e-liquid, or e-juice, is usually made of nicotine, 
					propylene glycol, glycerine, and flavorings. Not all e-liquids contain nicotine. <br>- Wikipedia</p>

					<h2 style="color:yellowgreen">Why Should You Start Vaping?</h2>
					<ul style="font-size: 24px">
						<li>Vaping is healthier</li>
						<li>Vaping products are cheaper</li>
						<li>It doesn't smell bad</li>
					</ul>
					<br>
					<a href="#">Go Shopping</a>
			</div>
		</div>
		
	</div><br>

	<footer class="container-fluid text-center" id="footer">
		<h2 class="text-left" style="color:yellowgreen">About us</h2>
		<div class="row">
			<div class="col-sm-4">
				<p style="padding:10px">
					8 Parker House Myrtle Court<br>
					The Coast, Baldoyle<br>
					Dublin 13, Ireland<br>
					<p >9am to 8pm</p>
				</p>
			</div>
			<div class="col-sm-4">
				<p style="font-size: 20px">Call Us On</p>
				<h3 style="color:yellowgreen">+353-1-495-2222</h3>
				<p>9am to 8pm</p>
				<p style="font-size: 15px">vapeshop.info@vapeshop.com</p>
			</div>
			<div class="col-sm-4">
				<img src="img/Footer/payment.jpg" class="img-responsive" style="width:100%; max-width: 200px;" alt="Image"></img>
			</div>
		</div>
	</footer>

</body>

</html>
