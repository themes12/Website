<?php
	session_start();
	if ($_SESSION['ID'] == ""){
		header("location:../../Login.php");
	} 
	$serverName = "localhost";
    $userName = "mineckas_user01";
    $userPassword = "Jadvornyobatta.8";
    $dbName = "mineckas_login";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	$strSQL = "SELECT * FROM bank WHERE cus_id = '".$_SESSION['ID']."' order by date_time";
	mysqli_set_charset($objCon,"utf8");
	$objQuery = mysqli_query($objCon,$strSQL);

	$strSQL3 = "SELECT * FROM coin_member WHERE Username = '".$_SESSION['ID']."' ";
	mysqli_set_charset($objCon,"utf8");
	$objQuery3 = mysqli_query($objCon,$strSQL3);
	$objResult3 = mysqli_fetch_array($objQuery3);

	$strSQL1 = "SELECT SUM(money_add) AS SumMoney_add FROM bank WHERE cus_id = '".$_SESSION['ID']."' ";
	mysqli_set_charset($objCon,"utf8");
	$objQuery1 = mysqli_query($objCon,$strSQL1);
	$objResult1 = mysqli_fetch_array($objQuery1);

	$query2="SELECT * FROM bank LEFT JOIN coin_member ON bank.cus_id=coin_member.Username WHERE bank.cus_id=coin_member.Username";
	mysqli_set_charset($objCon,"utf8");
    $result2=mysqli_query($objCon,$query2);
	$objResult2 = mysqli_fetch_array($result2);

	if(!$objResult3)
    {
	   session_write_close();
	   mysqli_close($objCon);
        header("location:../Incorrect/ErrorIN.html");
    }
	$i=1;


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transaction history</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../../Login.php">Coin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/coin/login/user/">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ประวัติการฝากเงิน</a>
      </li>
    </ul>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo "คุณ"; echo " "; echo $objResult3['Firstname']; echo " "; echo $objResult3['Lastname']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	<a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">สรุป</a>
          <a class="dropdown-item" href="../../logout.php">logout</a>
        </div>
      </li>
  </div>
</nav>
    <form>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">no.</th>
								<th class="column2">Name</th>
								<th class="column2">Email</th>
								<th class="column4">Money</th>
								<th class="column3">Date-Time</th>
								<th class="column2">Note</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php while($row=mysqli_fetch_array($objQuery)){?>
								<td class="column1"><?php echo $i; ?></td>
								<td class="column2"><?php echo $row['firstname']; echo " "; echo $row['lastname']; ?></td>
								<td class="column2"><?php echo $row['email']; ?></td>
								<td class="column4"><?php echo $row['money_add']; echo " "; echo "บาท"; ?></td>
								<td class="column3"><?php echo $row['date_time']; ?></td>
								<td class="column2"><?php echo $row['Memo']; ?></td>
							</tr>
							<?php
								$i=$i+1;
							}
							?>
                        </tbody>
					</table>
				</div>
			</div>
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
        <?php echo "สรุปคุณ "; echo $objResult3['Firstname']; echo " "; echo $objResult3['Lastname'];  ?>
	<?php echo "มีเงินฝากทั้งหมด ";  echo $objResult1['SumMoney_add']; echo " บาท";    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <?php mysqli_close($con); ?>
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
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
$( "edit_data" ).click(function() {
  $( this ).slideUp();
});
</script>
    </form>
</body>
</html>
