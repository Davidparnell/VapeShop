<?php
	$name_err = $uname_err = $email_err = $password_err = $form_err = "";
	$name = $address = $uname = $email = $password = $re_password = "";
	// name, address, username, email, password, re-passwords
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input($_POST["name"]); //char only, allow spaces
		$address = test_input($_POST["address"]);
		$uname = test_input($_POST["uname"]); //up to 12 chars without spaces
		$email = test_input($_POST["email"]); //normal email format
		$password = test_input($_POST["password"]); // 8-10 digits only
		$re_password = test_input($_POST["re_password"]); // 8-10 digits only, should be the same with the other password
		if ($name == NULL || $address == NULL || $uname == NULL || $email == NULL || $password == NULL || $re_password == NULL){
			$form_err = "Please fill in all fields";
		}
		// if()
	}
	// alert(isValidEmail($email));
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function isValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL) 
			&& preg_match('/@.+\./', $email);
	}
	
	
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		/* Add a gray background color and some padding to the footer */
		header {
      background-color: #212121;
      padding: 25px;
   	 }
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
			$("#signupsubmit").click(function(){ 
				var nm = $("#name_msg");
				var nameReturnStr;
				if (nm.val().length == 0)
					nameReturnStr = "Enter your name.";
				else if (!nm.val().match(/^[a-zA-Z ]+$/))
					nameReturnStr = "The name has to be letters and spaces only.";
				else nameReturnStr = "";
				$("#err1").text(nameReturnStr);
			 });
		});
	</script>	
	</head>
<!--Nav Bar-->
	<nav class="navbar navbar-inverse" style="border: none">
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
					<li><a class="active" href="Hardware.php">Hardware</a></li>
					<li><a href="Liquid.php">Liquid</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
					<li><a href="#" role="button" id="myBtn"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
					
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
		
		<div class="">
			<div class="col-sm-4">
				<div class="well">
					<img src="img/Register/Quit.jpg" style="height:300px">
				</div>
				<div class="well">
					<p>Want to get everything you need to quit smoking delivered right
						to your door and at the lowest prices?Join thousands in the significantly
						cheaper and healthier world of vaping. Studies show that
						vapers have a 95% reduction in the risk of getting cancer and on 
						average save about €15-20 a week,thats €780-1040 a year!!
						Register now and your first order on liquids under €25 is free!</p>
				</div>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-4 text-center">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="name" placeholder="Enter your full name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" class="form-control" id="name" >
						<span id="name_msg"></span>
					</div>
					<div class="form-group">
						<label>Address:</label>
						<input type="text" name="address" placeholder="Enter your address" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" class="form-control" id="addr">
						<span id="addr_msg"></span>
					</div>
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="uname" placeholder="Enter your user name, up to 12 characters without spaces" value="<?php if(isset($_POST['uname'])) { echo $_POST['uname']; } ?>" class="form-control" id="uname">
						<span id="uname_msg"></span>
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="text" name="email" placeholder="Enter a valid email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" class="form-control" id="email">
						<span id="email_msg"></span>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="text" name="password" placeholder="Enter your password, 8-10 numbers only" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" class="form-control" id="password">
						<span id="password_msg"></span>
					</div>
					<div class="form-group">
						<label>Re-enter Password:</label>
						<input type="text" name="re_password" placeholder="Re-enter your password, 8-10 numbers only" value="<?php if(isset($_POST['re_password'])) { echo $_POST['re_password']; } ?>" class="form-control" id="re_password">
						<span id="re_password_msg"></span>
					</div>
					<button type="submit" class="btn btn-default" id="signupsubmit">Submit</button>
				</form>
			</div>
			<div class="row">
				<div class="col-sm-4 text-center" id="errormessages">
					<div class="alert alert-danger" id="err1"></div>
				</div>
			</div>
		</div>
		
		<footer class="container-fluid text-center">
			<p>Vape Shop reserves the right to sell off your personal data 
			whenever we want, we're not big enough for you to make a big deal
			out of it like you all did with Zuckerburg</p>
		</footer>
	</body>
</html>