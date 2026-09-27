

<?php

	// 5bfPo2sdHPIpzkLOZ56T - password to db
	$con = mysqli_connect('127.0.0.1','root', '5bfPo2sdHPIpzkLOZ56T');
	if(!$con) {
		echo 'not connect to the server';
	}
	if(!mysqli_select_db($con,'lsnDb')) {
		echo 'database not selected';
	}


    include("../projects/picture/frontpage.php");






?>


