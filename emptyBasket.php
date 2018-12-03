<?php
	//Php file to empty a basked by getting rid of it 
	session_start();
	
	unset($_SESSION['cart']);
	
	echo "<script>
	alert('Basket Emptied, Returning home');
	window.location.href='Home.php';
	</script>";
?>