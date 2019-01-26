<?php
	session_start();
	if ($_SESSION['ID'] == ""){
		header("location:../Login.php");
	} 
	$serverName = "localhost";
    $userName = "mineckas_user01";
    $userPassword = "Jadvornyobatta.8";
    $dbName = "mineckas_login";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	$strSQL = "SELECT * FROM coin_member WHERE Username = '".$_SESSION['ID']."' ";
	mysqli_set_charset($objCon,"utf8");
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);

	$strSQL1 = "SELECT SUM(money_add) AS SumMoney_add FROM bank WHERE cus_id = '".$_SESSION['ID']."' ";
	mysqli_set_charset($objCon,"utf8");
	$objQuery1 = mysqli_query($objCon,$strSQL1);
	$objResult1 = mysqli_fetch_array($objQuery1);

	$query2="SELECT * FROM bank LEFT JOIN coin_member ON bank.cus_id=coin_member.Username WHERE bank.cus_id=coin_member.Username";
	mysqli_set_charset($objCon,"utf8");
    	$result2=mysqli_query($objCon,$query2);
	$objResult2 = mysqli_fetch_array($result2);

    if(!$objResult)
    {
	   session_write_close();
	   mysqli_close($objCon);
        header("location:../Incorrect/ErrorIN.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>บันทึกข้อมูล</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../../index/">Coin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/coin/login/user/history/">ประวัติการฝากเงิน</a>
      </li>
    </ul>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo "คุณ"; echo " "; echo $objResult['Firstname']; echo " "; echo $objResult['Lastname']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	<a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">สรุป</a>
          <a class="dropdown-item" href="../logout.php">logout</a>
        </div>
      </li>
  </div>
</nav>
	<div class="container-contact100">

		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="save_data.php">
				<span class="contact100-form-title">
					บันทึกข้อมูล
				</span>

				<div class="wrap-input100 validate-input" data-validate="Please enter your Firstname">
					<input class="input100" type="text" name="firstname" id="firstname" placeholder="Please enter your Firstname">
				</div>
				<div class="wrap-input100 validate-input" data-validate="Please enter your Lastname">
					<input class="input100" type="text" name="lastname" id="lastname" placeholder="Please enter your Lastname">
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Please enter your email: e@a.x">
					<input class="input100" type="text" name="email" id="email" placeholder="Please enter your email" >
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Please enter Time">
					<input class="input100" type="datetime-local" name="time" id="time" placeholder="Please enter Time" >
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Please enter Money">
					<input class="input100" type="number" name="num" id="num" placeholder="Please enter Money">
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Please enter your message">
					<textarea class="input100" name="Memo" id="Memo" placeholder="Please enter your message"></textarea>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							Send
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">สรุปยอดเงิน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo "สรุปคุณ "; echo $objResult['Firstname']; echo " "; echo $objResult['Lastname'];  ?>
	<?php echo "มีเงินฝากทั้งหมด ";  echo $objResult1['SumMoney_add']; echo " บาท";    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
