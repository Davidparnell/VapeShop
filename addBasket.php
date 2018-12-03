<?php 

	//Php file that takes in the ID of a row from Products.php
	session_start();
	
	//If session doesnt exist
	if(empty($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();//Create session
		array_push($_SESSION['cart'], $_GET['ID']);//Add to array
		echo "<script>
		alert('Basket created and product added');
		window.location.href='Products.php';
		</script>";
		
	}
	//If session exists
	else
	{
		array_push($_SESSION['cart'], $_GET['ID']);
		echo "<script>
		alert('Item added to basket');
		window.location.href='Products.php';
		</script>";
	}
?>