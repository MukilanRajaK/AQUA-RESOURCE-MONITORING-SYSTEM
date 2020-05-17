<?php 
 // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/DBCONNECT.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
    $query = mysql_query("select * from watermonitor ORDER BY ID DESC LIMIT 1");
     #$query1 = mysql_query("select status from lockunlock WHERE id=1");
     
    //echo "select * from tampstatus";exit;
    
   //  exit;

?>
<html lang="en">
<head>
	<title>Aqua Resource Monitoring System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
<style>
img {

}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: auto;
}
</style>
</head>
<body>
   <img src="AQUA.png" alt="HTML5 Icon" width="190" height="300" class="center">
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
							    <th class="column1" style="text-align:center;">Lake/River Name</th>
							    <th class="column1" style="text-align:center;">Area No</th>
								<th class="column1" style="text-align:center;">pH</th>
								<th class="column2" style="text-align:center;">Turbudity</th>
								<th class="column3" style="text-align:center;">Water Level</th>
								<th class="column4" style="text-align:center;">Luminous</th>
								<th class="column5" style="text-align:center;">Temperature</th>
							</tr>
						</thead>
						<tbody>
						    <?php 
						     while ($row = mysql_fetch_array($query)) {?>
             <tr>                     <td class="column1" style="text-align: center;">dak Lake</td>
                                     <td class="column1" style="text-align: center;">123216</td>
									<td class="column1" style="text-align: center;"><?php echo $row["pH"]?></td>
									<td class="column2" style="text-align: center;"><?php echo $row["turbidity"];?></td>
									<td class="column3" style="text-align: center;"><?php echo $row["waterlevel"];?></td>
									<td class="column4" style="text-align: center;"><?php echo $row["luminous"];?></td>
									<td class="column5" style="text-align: center;"><?php echo $row["temp"];?></td>
			   </tr>
        <?php }
						    ?>
								
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>
</body>
</html>