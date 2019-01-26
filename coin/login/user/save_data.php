<?php
	session_start();
	mysql_connect("localhost","mineckas_user01","Jadvornyobatta.8");
	mysql_select_db("mineckas_login");
	
    if(trim($_POST["firstname"]) == ""){
		echo "Please input firstname!";
		exit();	
	}
	if(trim($_POST["lastname"]) == ""){
		echo "Please input lastname!";
		exit();	
	}
	if(trim($_POST["email"]) == ""){
		echo "Please input email!";
		exit();	
	}
	if(trim($_POST["time"]) == ""){
		echo "Please input time!";
		exit();	
	}	
	if(trim($_POST["num"]) == ""){
		echo "Please input money!";
		exit();	
	}	
	
		$strSQL = "INSERT INTO bank (cus_id,firstname,lastname,email,date_time,money_add,Memo) VALUES ('".$_SESSION['ID']."','".$_POST["firstname"]."','".$_POST["lastname"]."', '".$_POST["email"]."','".$_POST["time"]."','".$_POST["num"]."','".$_POST["Memo"]."')";
		$objQuery = mysql_query($strSQL);
		
        header('Location:index.php');

	mysql_close();
?>
