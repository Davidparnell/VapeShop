<?php
	session_start();
	if (isset($_SESSION['Login_Status'])) //is logged in
	{
		$login = "Logout";
		$db = mysqli_connect("localhost","root","","groupproject");
		$welcome = $_SESSION['Login_Status'];
		$delete = "delete.php?id="; //php file to delete
		$update = "update.php?id="; //php file to update
	}
	else //not logged in
	{
		header("location: Home.php");
		$login = "Login";
	}
?>
<html>
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
					<li><a href="Hardware.php">Hardware</a></li>
					<li><a href="Liquid.php">Liquid</a></li>
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
	<?php
    $db = mysqli_connect("localhost","root","","groupproject");
    $result = mysqli_query($db,"select PNAME,BRAND, ID, FLAVOR, CAPACITY, DESCRIPTION, PRICE, IMAGE from picture");


    if ($result->num_rows > 0) // non zero result
    {
        echo "<table><tr><th>PNAME</th><th>BRAND</th><th>FLAVOR</th><th>CAPACITY</th>
		<th>ID</th><th>DESRIPTION</th><th>PRICE</th><th>IMAGE</th><th>DELETE</th><th>UPDATE</th></tr>";

        while($row = $result->fetch_assoc()) //while still has rows print them
        {
            echo "<tr><td>" . $row["PNAME"]. "</td><td>" . $row["BRAND"]. "</td><td>"
			. $row["FLAVOR"]. "</td><td>" . $row["ID"]."</td><td>" .$row["CAPACITY"]. 
			"</td><td>".$row["DESCRIPTION"]."</td><td>".$row["PRICE"]."</td><td>".$row["IMAGE"]."</td>
			<td><a href=".$delete .$row['PRODUCTID']. ">Delete</a></td><td><a href=".$update .$row['PRODUCTID']. ">
			</a></td></tr>";
        }
        echo "</table>";
    }
    else // zero result
    {
        echo "Nothing to Display";
    }
    ?>
	</div>
	<div style="width:100%;float:left;margin:20px">

		<form action="add.php" method="post">
			<center><h1 style="color:blue;margin-bottom:10px">Add Product</h1><br/><br/>
			<label>Name: </label><br/><input type="text"  id="pname" name="pname"><br/><br/>
			<label>Brand: </label><br/><input type="text"  id="brand" name="brand"><br/><br/>
			<label>Flavor: </label><br/><input type="text"  id="flavour" name="flavor"><br/><br/>
			<label>ID: </label><br/><input type="text"  id="id" name="id"><br/><br/>
			<label>Capacity: </label><br/><input type="text"  id="capacity" name="capacity"><br/><br/>
			<label>Description:</label><br/><input type="text" id="description" name="description"><br/><br/>
			<label>Price:</label><br/><input type="text" id="price" name="price"><br/><br/>
			<label>Image:</label><br/><input type="file" name="image"/>
			<input type="submit" value="submit"></center>
		</form>
	</div>
</body>
</html>