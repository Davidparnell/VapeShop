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
	
	$addBasket = "AddBasket.php? id=";//
	
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
<html lang="en">

<head>
	<title>Vape Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		<!-- Add a gray background color and some padding to the footer-->
		
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
		
		.catalogue
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		
		.customers td, #customers th 
		{
			border: 1px solid #ddd;
			padding: 8px;
		}
		
		
		.catalogue tr:nth-child(even)
		{
			background-color: #f2f2f2;
		}

		.catalogue tr:hover 
		{
			background-color: #ddd;
		}

		
		.btn-block {
			display: block;
			width: 100%;
			background-color: #101010;
		}
		
		.wrapper {
			display: flex;
			align-items: stretch;
		}

		#sidebar {
			min-width: 200px;
			max-width: 200px;
			min-height: 100vh;
		}
		
		body 
		{
			background: #fafafa;
		}

		p {
			font-size: 1.1em;
			font-weight: 300;
			line-height: 1.7em;
			color: #999;
		}

		a, a:hover, a:focus {
			color: inherit;
			text-decoration: none;
			transition: all 0.3s;
		}

		@media (max-width: 768px) 
		{
			#sidebar {
			margin-left: -250px;
			}
			#sidebar.active {
			margin-left: 0;
			}
		}
		
		#sidebar {
		/* don't forget to add all the previously mentioned styles here too */
			background: white;
			color: black;
			transition: all 0.3s;
		}

		#sidebar .sidebar-header {
			padding: 20px;
			color: white;
			background: #101010;
		}

		#sidebar ul.components {
			padding: 20px;
			border-style: solid;
			border-color: #101010;
		}

		#sidebar ul p {
			color: black;
			padding: 10px;
		}

		#sidebar ul li a {
			padding: 10px;
			font-size: 1.1em;
			display: block;
		}
	
		#sidebar ul li a:hover {
			color: #7386D5;
			background: #fff;
		}

		ul ul a {
			font-size: 0.9em;
			padding-left: 30px;
			background: #6d7fcc;
		}
		
		td
		{
			padding:0 15px 0 15px;
		}
		
		input[type=text]
		{
			width:100%;
		}
		
    </style>
	<script>
		//Modal Function
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});
		
		//Slider fuction using JQuery
		var slider = new Slider('#slide',{});
		
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
				<a class="navbar-brand glyphicon glyphicon-home" href="Home.php"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="Products.php">Products</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="Basket.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
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
	
	<div class="col-sm-12">
		<!-- Side bar for filters -->
		<div class="col-sm-2">
		<div class="wrapper">
			<nav id="sidebar">
				<div class="sidebar-header">
					<h3>Filter Products</h3>
				</div>
				
				<!-- Filter options -->
				<ul class="list-unstyled components">
					<li>
						<!-- Select product type, Liquid, hardware or all products (default) -->
						<form action="">
							<input type="radio" name="filterType" value="Liquid">Liquid<br>
							<input type="radio" name="filterType" value="Hardware">Hardware<br>
							<input type="radio" name="filterType" value="All" checked>All
						</form>
					</li>
					<!-- Slider to set price range-->
					<li>
						<p>SLIDER</p>
					</li>
					
					<li>
						 <label>Search:</label> 
						 <input type="text" name="search_box" value=" "/>
					</li>
					
					<!-- Filter button -->
					<li>
						<input type="submit" value="Filter" name="Filter" id="Filter">
					</li>
				</ul>
			</nav>
		</div>
		</div><!-- End Filters -->
			
		<!-- Print database results -->
		<div class="col-sm-8">
		
		<?php
			require 'conn.php';
			$query="select * from products";
			$result=$con->query($query);
			
				
			//While the DB has rows print
			while($row= mysqli_fetch_array($result))
			{
				echo '<img src="data:Image/jpeg;base64,'.base64_encode( $row['Image'] ).'" style="width:150px;height=150px;"/>';	
				
				echo 
				"<table>
				<tr><td>
				<tr>".$row["Brand"]."</tr></br>
				<tr>".$row["Name"]."</tr></br>
				<tr>".$row["PType"]."</tr></br>
				<tr>".$row["Description"]."</tr></br>
				<tr>
				<td>".$row["Price"]."</td>
				<td><a href=".$addBasket.$row['ID'].">Add to Basket</a></td>
				</tr>
				</table>";
			}//end while
		?>
		</div>
		
		<div class="col-sm-2">
		</div>
	</div><!--end main body-->
	
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