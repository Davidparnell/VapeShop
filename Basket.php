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
	
	$remove= "removeBasket.php?ID=";

?>

<html>
<html lang="en">

<head>
	<title>Vape Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="vapeShop.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
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
					<li ><a href="Products.php">Products</a></li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
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
								<input type="password" class="form-control" name="password" placeholder="Enter password">
							
						
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
	
	
	<div class="col-sm-16">
		<div class="col-sm-2">
		</div>
		
		<div class="col-sm-10">
			<div class="basket">
				<table class="tbl-cart" cellspacing="1">
					<tr>
					<th>Name</th>
					<th>Brand</th>
					<th>Type</th>
					<th>Price</th>
					<th>Quantity</th>
					<th style="text-align:center;">Remove</th>
					</tr>
					
					<?php
	
						var_dump($_SESSION['cart']);
						
						$whereIn = implode(',',$_SESSION['cart']);
	
						$query= "select * from products where ID in($whereIn)";
						
						$total = 0;
						
						$result=$con->query($query);
						
						//If rows are found
						if($result->num_rows >0)
						{	
							//While the DB has rows print
							while($row= mysqli_fetch_array($result))
							{
								echo "<table class='basket'><tr>
								<td>".$row["Name"]."</td>
								<td>".$row["Brand"]."</td>
								<td>".$row["PType"]."</td>
								<td>".$row["Price"]."</td>
								<td>";
								echo "<a href=".$remove. $row['ID'].">Remove</a>";
								"</td></tr>
								</table>";
								$total = $total + $row["Price"];
							}
						}
						
						else
						{
							echo "Basket Empty";
						}
					?>
				</table>
				
				<table class="info">
					<tr><td width="15%">Number of items:</td>
					<td width="5%"><?php 
					
					$number = $result->num_rows;
					
					if($number > 0)
					{
						echo "$number";
					}
					else
					{
						echo "Basket empty";
					}
					?>
					</td>
					<td style="text-align:center ;" width="10%">Total:</td>
					<td width="5%">€<?php
						echo $total;
					?>
					</td>
				</table>
			</div>
			</br>
			<!-- Payment Button -->
			<form action="Payment.php">
				<label>Proceed to Payment</label></br>
				<input type="submit" value="Proceed" />
			</form>
			
			<form action="emptyBasket.php">
				<label>Empty basket"</label></br>
				<input type="submit" value="Empty" />
			</form>
		</div>
		
		<div class="col-sm-4">
		</div>
	</div>
	
</body>
</html>+