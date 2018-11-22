<html>
<html lang="en">

<head>
	<title>Vape Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- Connect to DB-->
	<?php
	session_start();
    $db = mysqli_connect("localhost","root","","groupproject");
    ?>
	
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
</head>
<body>
	<header class="container-fluid text-center">
		<div class="container-fluid">
			<h1>VAPE SHOP</h1>
			<input type="text" placeholder="Search items..">
			<a href="#" class="glyphicon glyphicon-search"></a>
		</div>
	</header>
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
					<li><a href="Home.php">Home</a></li>
					<li class="active"><a href="#">Hardware</a></li>
					<li><a href="Liquids.php">Liquids</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
					<li><button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button></li></li>
					
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
						<div class="modal-header" style="padding:35px 50px;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
						</div>
					
						<div class="modal-body" style="padding:40px 50px;">
							<form role="form">
							<div class="form-group">
								<label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
								<input type="text" class="form-control" id="usrname" placeholder="Enter email">
							</div>
						
							<div class="form-group">
								<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
								<input type="text" class="form-control" id="psw" placeholder="Enter password">
							</div>
						
							<div class="checkbox">
								<label><input type="checkbox" value="" checked>Remember me</label>
							</div>
							<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
							</form>
						</div>
					
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<p>Not a member? <a href="Register.html">Sign Up</a></p>
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
		<div class="col-sm-8">
		
		<!-- Reads through the database while it still has rows and displays each row.
		If no rows it prints a messages stating that -->
		<?php
		$db = mysqli_connect("localhost","root","","groupproject");
		$result = mysqli_query($db,"select HNAME,HBRAND,TYPE,HPRICE from hardware");
	
		if ($result->num_rows > 0) 
		{
			echo "<table><tr><th>Name</th><th>Brand</th><th>Type</th><th>Price</th></tr>";
    
			while($row = $result->fetch_assoc()) 
			{
				echo "<tr><td>" . $row["HNAME"]. "</td><td>" . $row["HBRAND"]. "</td><td>" . $row["TYPE"].
				"</td><td>".$row["PRICE"]."</td></tr>";
			}
			echo "</table>";
		} 
		else 
		{
			echo "Nothing to Display";
		}
		?>
	</div>
</body>
</html>