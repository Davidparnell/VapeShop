<?php
    session_start();
    if (isset($_SESSION['Login_Status'])){
        $uname = $_SESSION['Login_Status'];
        $name = $addr = $email = "";
    
        require 'conn.php';
        
        $sql = "SELECT Username,Name,Address,Email FROM users WHERE Username LIKE '$uname'";
        $result = $con->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $addr = $row["addr"];
                $email = $row["email"];
            }
        }
        else {
            echo $uname;
            echo "0 results";
        }
        $con->close();

    }
    else {
        header("Location: Home.php");
    }
    function change_pwd($uname, $pwd) {
        require 'conn.php';
        $sql = "UPDATE userinfo SET pwd = $pwd WHERE uname='$uname'";
        try {
            $con->query($sql);
        } catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
        $con->close();
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
		.error { color: red; }
        .profile-pic {
            width:300px;
            height:300px;
            max-width: 100%;
            border-radius: 25px;
        }
    </style>

</head>
	
<body>
	
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
    
    <div class="row text-center" style="padding: 30px;"> <h1 style="color: yellowgreen;">Profile Page</h1><br></div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div class="row text-center">
                <img class="profile-pic" src="img/me.jpg" alt="mypic">
            </div>
            <br>
            <div class="row text-center">
                <form action="imageup.php" method="post" enctype="multipart/form-data">
                    <input type="file" style="float:right; padding: 3px;" name="fileToUpload" id="fileToUpload">
                    <input type="submit" class="btn btn-primary" value="Change Image">
                </form>
            </div>
            
        </div>
        <div class="col-sm-6" style="padding-left: 50px;">
            <h2>Hi, <b><?php echo $uname ?></b>!</h2>
            <h3>Name</h3>
            <p><?php echo $name ?></p>
            <h3>Address</h3>
            <p><?php echo $addr ?></p>
            <h3>Email</h3>
            <p><?php echo $email ?></p>
        </div>
        <div class="col-sm-2" style="padding-left: 50px;">
            <br><br>
            <button class="btn">Change Password</button>
            <br><br>
            <button class="btn btn-danger">Delete Account</button>
        </div>
  </div>
  <div class="row text-center">
      
  </div>

    </body>
    </html>