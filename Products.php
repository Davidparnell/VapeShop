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
	
	$addBasket ="addBasket.php?ID=";//file to add to basket
	
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
	
	//Set max and min prices
	$min = 6;
	$max = 120;

	if (! empty($_GET['min'])) 
	{
		$min = $_GET['min'];
	}

	if (! empty($_GET['max'])) 
	{
		$max = $_GET['max'];
	}
	
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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	
	<script>
		//Modal Function
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
						<form action="post" >
							<!-- Slider to set price range-->
							<div>
								<input type="radio" name="type" value="Liquid">Liquid<br>
								<input type="radio" name="type" value="Hardware">Hardware<br>
								<input type="radio" name="type" value="All" checked>All<br>
								
								<p>Price Range:</p>
								<table class="rangeTbl">
								<tr><td>
								<td>
								<input type="text" class="min" name="min_price"
								value="<?php echo $min; ?>"></td>
								<td><p>-</p></td>
								<td><input type="text" class="max" name="max_price"
								value="<?php echo $max; ?>"></td>
								</table>
							</div>
							<div>
								</br>
								<input type="submit" name="submit_range"
								value="Filter Product" class="btn-submit">
							</div>
							
						</form>	
					</li>
				</ul>
			</nav>
		</div>
		</div><!-- End Filters -->
			
		<!-- Print database results -->
		<div class="col-sm-8">
		<div class="displays">
		<?php
			if(isset($_POST['sub']))
			{
				/*
				if(isset($_POST['filterType']) == "Liquid")
				{
					$query="select * from products where(PType = 'Liquid')";
				}
				//Hardware - Select all where PType = hardware
				elseif(isset($_POST['filterType'])== "Hardware") 
				{	
					$query="select * from products where(PType = 'Hardware')";
				}
				//Default - Select all with not filter
				else
				{
					$query="select * from products";
				}
				*/
				
				$searched= mysqli_real_escape_string($_POST['search']);
					
				$query ="SELECT * FROM products WHERE Name LIKE '%$searched%'";
				
			}				
			else
			{
				$query = "select * from products where Price BETWEEN '$min' AND '$max' ";
			}
			
			
			$result=$con->query($query);
			
			//If rows are found
			if($result->num_rows >0)
			{	
				//Print number of results found
				echo "$result->num_rows";				
				echo "	Results Found<br><br>";
				
				//While the DB has rows print
				while($row= mysqli_fetch_array($result))
				{
					echo '<td><div style="border-bottom: 1px solid #101010; padding: 25px;"></td>';
					
					echo 
					"<br><table class='catalogue'>
					<tr><td>";
					echo '<img src="data:Image/jpeg;base64,'.base64_encode( $row['Image'] ).'" style="width:150px;height=150px;"/></br>';
					echo "</td><td>";
					echo "<tr class='brand'>".$row["Brand"]."</tr></br>";
					echo "<tr>".$row["Name"]."</tr></br>";
					echo "<tr>".$row["PType"]."</tr></br>";
					echo "<tr>".$row["Description"]."</tr></br>";
					echo "<tr><td>€".$row["Price"]."</td><td>";
					echo"<a href=".$addBasket. $row['ID']." class='addButton'>Add to Cart</a>";
					echo"</td></tr></td>
					</table></br></br>";
					
					echo "</div>";
				}//end while
			}
			else
			{
				echo "<div class='no-result'>No Results</div>";
			}
			?>
		</div>
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