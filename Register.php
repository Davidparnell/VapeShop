<?php
	$nameErr = $addrErr = $unameErr = $emailErr = $passwordErr = $re_passwordErr = ""; // will show error message for each field
	$name = $addr = $uname = $email = $password = $re_password = "";
	$completeMsg = ""; //the sign up hasn't been completed
	$successful = 1; //true, the form status - completed now

	// echo '<script type="text/javascript">alert("hello!");</script>';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// name validation
		if (empty($_POST["name"])) {
			$nameErr = "Enter your name";
			$successful = 0;
		} else {
			$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "The name has to be letters and spaces only";
				$successful = 0;
			}
		}
		// address validation
		if (empty($_POST["addr"])) {
			$addr1Err = "Enter your address";
			$successful = 0;
		} else {
			$addr = test_input($_POST["addr"]);
		}
		// username validation, up to 12 characters, has to be unique
		if (empty($_POST["uname"])) {
			$uname = "Enter your user name";
			$successful = 0;
		} else {
			$uname = test_input($_POST["uname"]);
			if (!preg_match("/^[a-zA-Z]*$/",$uname)) {
				$unameErr = "The user name has to be characters without spaces only.";
				$successful = 0;
			}

			require 'conn.php';
			
			$sql = "SELECT Username FROM users WHERE Username LIKE '$uname'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) { //someone is using the same username, the user has to change the username
				$unameErr = "Someone is using the username, please use another username.";
				$successful = 0;
			}
			$con->close();
		}
		// email validation
		if (empty($_POST["email"])) {
			$emailErr = "Enter your email";
			$successful = 0;
		} else {
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
				$successful = 0;
			}
		}
		//password validation
		if (empty($_POST["password"])) {
			$passwordErr = "Enter your password";
			$successful = 0;
		} else {
			$password = test_input($_POST["password"]);
			if (!preg_match("/^[0-9]*$/",$password)) { //checking if password's numbers only
				$passwordErr = "The password has to be digits only";
				$successful = 0;
			}
		}
		if (empty($_POST["re_password"])) {
			$re_passwordErr = "Enter your password again";
			$successful = 0;
		} else {
			$re_password = test_input($_POST["re_password"]);
			if (!preg_match("/^[0-9]*$/",$re_password)) { 
				$re_passwordErr = "The password has to be digits only";
				$successful = 0;
			}
			else if(strcmp($password, $re_password) != 0) {//when the passwords are different
				$re_passwordErr = "This has to be the same as the first password.";
				$successful = 0;
			}
		}
		//when the form has successfully completed
		if($successful){
			// DRY principle -> reusing SQL connection statement
			require 'conn.php';
			//inserting signup form data into table avoiding SQL injectino with prepared statement
			$stmt = $con->prepare("INSERT INTO users (Name, Address, Username, Email, Password) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssi", $name, $addr, $uname, $email, $password);
			$stmt->execute();

			$stmt->close();
			$con->close();

			$nameErr = $addrErr = $unameErr = $emailErr = $passwordErr = $re_passwordErr = "";
			$name = $addr = $uname = $email = $password = $re_password = "";
			$completeMsg = "You have successfully signed up!";

			
		}

	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<html class="gr__dit-bb_blackboard_com">
<script>(function () { (function () { function e(e) { return function (e, t, n) { if (void 0 === n && (n = 10), e) { for (; e && e !== document.body && !t(e) && n > 0;)e = e.parentElement, n--; return e && t(e) } }(e, function (e) { return e.classList && e.classList.contains("editor-element") }) } var t = 0, n = 0; document.addEventListener("blur", function (r) { var o, i, a, s, c = r.target, u = r.relatedTarget || r.explicitOriginalTarget || document.elementFromPoint(t, n); u && c && e(c) && "function" == typeof (s = u).matches && s.matches("grammarly-card, grammarly-card *, .gr-top-zero, .gr-top-zero *") && (r.stopImmediatePropagation(), o = c, "editor" !== (a = (i = u) && i.getAttribute("data-action")) && "login" !== a && o.focus()) }, !0), document.addEventListener("DOMContentLoaded", function () { document.addEventListener("mousemove", function (e) { t = e.clientX, n = e.clientY }, !0) }) })() })()</script>

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
		.error { color: red; }
    </style>
	<script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});
		$(document).ready(function(){
			$("#alert").hide();
			$("#signupsubmit").click(function(){
				$("#signup").fadeOut(400);
				$("#alert").show();
			});
		});
	</script>

	</head>
	
	<body data-gr-c-s-loaded="true">
	
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
					<img src="Images/Register/Quit.jpg" style="height:300px">
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
				<form method="post" id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="name" maxlength="50" placeholder="Enter your full name" 
						value="<?php echo $name;?>" class="form-control" id="name" required>
						<span class="error"> <?php echo $nameErr;?></span>
					</div>
					<div class="form-group">
						<label>Address:</label>
						<input type="text" name="addr" maxlength="100" placeholder="Enter your address" 
						value="<?php echo $addr;?>" class="form-control" id="addr" required>
						<span class="error"> <?php echo $addrErr;?></span>
					</div>
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="uname" maxlength="12" placeholder="Enter your user name, up to 12 characters without spaces" 
						value="<?php echo $uname;?>" class="form-control" id="uname" required>
						<span class="error"> <?php echo $unameErr;?></span>
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="text" name="email" maxlength="100" placeholder="Enter a valid email" 
						value="<?php echo $email ?>" class="form-control" id="email" required>
						<span class="error"> <?php echo $emailErr;?></span>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="passwrd" minlength="5" maxlength="10" placeholder="Enter your password, 5-10 numbers only" 
						value="<?php echo $password ?>" class="form-control" id="password" required>
						<span class="error"> <?php echo $passwordErr;?></span>
					</div>
					<div class="form-group">
						<label>Re-enter Password:</label>
						<input type="password" name="re_password" minlength="5" maxlength="10" placeholder="Re-enter your password, 5-10 numbers only" 
						value="<?php echo $re_password ?>"class="form-control" id="re_password" required>
						<span class="error"> <?php echo $re_passwordErr;?></span>
					</div>
					<button type="submit" class="btn btn-default" id="signupsubmit">Sign up</button>
				</form>
				<div id="alert" class="alert alert-success"><?php echo $completeMsg ?></div>
			</div>
		</div>
		
		<footer class="container-fluid text-center">
			<p>Vape Shop reserves the right to sell off your personal data 
			whenever we want, we're not big enough for you to make a big deal
			out of it like you all did with Zuckerburg</p>
		</footer>
		
	</body>
</html>