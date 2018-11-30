<?php

    $con=new mysqli("localhost","root","","groupproject");
    if($con->connect_error)
	{
        die('Connect Error');
	}
?>