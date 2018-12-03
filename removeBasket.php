<?php 
	session_start();
	
	
	$key=array_search($_GET['ID'],$_SESSION['cart']);
	if($key!==false)
	{
		unset($_SESSION['cart'][$key]);
		$_SESSION["cart"] = array_values($_SESSION["cart"]);
			
		echo "<script>
				alert('Item removed from basket');
				window.location.href='Basket.php';
			</script>";
	}

?>