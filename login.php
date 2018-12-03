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
	require 'conn.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$check = "select username from users where username = '$username' and password = '$password'";
	$status=$con->query($check);
	
	$numrows = mysqli_num_rows($status);
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
<head>
	<title>Vape Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="vapeShop.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<header class="container-fluid text-center">
		<div class="container-fluid">
			<h1>VAPE SHOP</h1>
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
				<a class="navbar-brand glyphicon glyphicon-home" href="Home.php"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="Products.php">Products</a></li>
					 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="Basket.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
					<li><button type="button" class="btn btn-default btn-lg" id="myBtn"><?php 
					echo $login; ?></button></li></li>
				
				</ul>
			</div>
		</div>
	</nav>
	
	</br>
	
	<div class="login">
		<form action = "" method = "post">
			<center><label>Username:</label><input type = "text" name = "username"/>
			<br/>
			<label>Password:</label><input type = "password" name = "password"/>
			<br/><br/>
			<input type = "submit" value = " Log in"/>
			<br/>
			<?php 
				echo $errormsg; 
			?></center>
		</form>
	</div>
	
	</br>
	
	<footer class="container-fluid text-center">
		<h2 class="text-left" style="color:yellowgreen" id="aboutus">About us</h2>
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