<?php
session_start();
//if (isset($_SESSION['Login_Status'])) // if logged in
{
    $login = "Logout";
    $db = mysqli_connect("localhost","root","","groupproject"); 
	//get variables
	$pname = $_POST["pname"];
	echo "pname = $pname";
	$brand = $_POST["brand"];
	echo "brand = $brand";
	$flavor= $_POST["flavor"];
	echo "flavor = $flavor";
	$id = $_POST["id"];
	echo "id = $id";
	$capacity = $_POST["capacity"];
	echo "capacity = $capacity";
	$price = $_POST["price"];
	echo "price = $price";
	$image = $_POST["image"];
	echo "image = $image";
	$result = mysqli_query($db,"INSERT INTO picture VALUES('$pname','$brand','$flavor','$id','$capacity','$price','$image');");
	header("location: addform.php"); //back to staff-area

	
}
/*else //not logged in
{
    //header("location: Home.php");
}*/
?>
