<?php
session_start();

require_once 'db_connect.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Establish a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve farmer information from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM farmer WHERE fusername = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any result is returned
if ($result->num_rows == 1) {
    // Fetch farmer details
    $farmer = $result->fetch_assoc();
} else {
    // Redirect to login page if no farmer found
    header("Location: login.php");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>AgroCulture</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
		<link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	
	</head>
	<body class>
		<!-- One -->
			<section id="main" class="wrapper style1 align-center" >
				<div class="container">
						<h2>Welcome to digital market</h2>

				<?php
					if(isset($_GET['n']) AND $_GET['n'] == 1):
				?>
					<h3>Select Filter</h3>
					<form method="GET" action="productMenu.php?">
						<input type="text" value="1" name="n" style="display: none;"/>
						<center>
							<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<div class="select-wrapper" style="width: auto" >
									<select name="type" id="type" required style="background-color:white;color: black;">
										<option value="all" style="color: black;">List All</option>
										<option value="fruit" style="color: black;">Fruit</option>
										<option value="vegetable" style="color: black;">Vegetable</option>
										<option value="grain" style="color: black;">Grains</option>
									</select>
							  	</div>
							</div>
							<div class="col-sm-2">
								<input class="button special" type="submit" value="Go!" />
							</div>
							<div class="col-sm-4"></div>
						</div>
						</center>
					</form>
				<?php endif; ?>

				<section id="two" class="wrapper style2 align-center">
				<div class="container">
				<?php
					if(!isset($_GET['type']) OR $_GET['type'] == "all")
					{
					 	$sql = "SELECT * FROM fproduct WHERE 1";
					}
				    if(isset($_GET['type']) AND $_GET['type'] == "fruit")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Fruit'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "vegetable")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Vegetable'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "grain")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Grains'";
					}
					$result = mysqli_query($conn, $sql);

					?>
					<div class="row">
					<?php

						while($row = $result->fetch_array()):
							$picDestination = "images/productImages/".$row['pimage'];
						?>
							<div class="col-md-4">
							<section>
							<strong><h2 class="title" style="color:black; "><?php echo $row['product'].'';?></h2></strong>
							<a href="review.php?pid=<?php echo $row['pid'] ;?>" > <img class="image fit" src="<?php echo $picDestination;?>" height="220px;"  /></a>

							<div style="align: left">
							<blockquote><?php echo "Type : ".$row['pcat'].'';?><br><?php echo "Price : ".$row['price'].' /-';?><br></blockquote>

						</section>
						</div>

						<?php endwhile;	?>


					</div>

			</section>
					</header>

			</section>

	</body>
</html>
