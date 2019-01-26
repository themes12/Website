<?php
session_start();
$serverName = "localhost";
$userName = "mineckas_user01";
$userPassword = "Jadvornyobatta.8";
$dbName = "mineckas_login";

$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

$strSQL = "SELECT * FROM coin_member WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['username'])."' and Password = '".mysqli_real_escape_string($objCon,$_POST['password'])."'";
$objQuery = mysqli_query($objCon,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
if(!$objResult)
{
	session_write_close();
	mysqli_close($objCon);
    header("location:./Incorrect/Error.html");
}
else
{
    $_SESSION["ID"] = $objResult["Username"];
	   session_write_close();
	   mysqli_close($objCon);
	   header("location:./user/index.php"); 
}
?>