<?php
	mysql_connect("localhost","mineckas_user01","Jadvornyobatta.8");
	mysql_select_db("mineckas_login");
	
	if(trim($_POST["username"]) == "")
	{
		echo "Please input Username!";
		exit();	
	}
    
    if(trim($_POST["email"]) == "")
	{
		echo "Please input email!";
		exit();	
	}
	
	if(trim($_POST["password"]) == "")
	{
		echo "Please input Password!";
		exit();	
	}	
		
	if($_POST["password"] != $_POST["re_password"])
	{
		echo "Password not Match!";
		exit();
	}
	
	if(trim($_POST["name"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	
	
    if(trim($_POST["last"]) == "")
    {
        echo "Please input Lastname!";
        exit();
    }
    
	$strSQL = "SELECT * FROM coin_member WHERE Username = '".trim($_POST['username'])."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{
			echo "Username already exists!";
	}
	else
	{	
		
		$strSQL = "INSERT INTO coin_member (Username,email,Password,Firstname,Lastname) VALUES ('".$_POST["username"]."', '".$_POST["email"]."','".$_POST["password"]."','".$_POST["name"]."', '".$_POST["last"]."')";
		$objQuery = mysql_query($strSQL);
		
        header('Location:../index/index.html');
			
	}

	mysql_close();
?>
