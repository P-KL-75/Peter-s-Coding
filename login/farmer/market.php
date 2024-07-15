<?php
session_start();

require_once '../../db_connect.php';

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
		<link rel="stylesheet" type="text/css" href="indexFooter.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif; /* Set default font family */
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Set background color */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s; /* Add transition for smooth color change */
        }

        nav ul li a:hover {
            color: red; /* Change hover color */
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            margin-top: 20px;
        }

    </style>
	</head>
	<body>

	<header>
        <h1>Welcome, <?php echo $farmer['fname']; ?>!</h1>
        <nav>
            <ul>
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><h2> Digital Market</h2></a></li>
                <li><a href="dashboard_farmer.php">Back to Home</a></li>
            </ul>
        </nav>
    </header>
	<main>
			<section id="one" class="wrapper style1 align-center" style="height: 600px">
				<div class="container">
					<h2>Welcome to Digital Market</h2>
					<br /><br />
					<div class="row 200%">
						<section class="4u 12u$(small)">
							<a href="profileView.php"><img src="profileDefault.png"></a>
							<p>Your Profile</p>
						</section>
						<section class="4u 12u$(small)">
							<a href="productSearch.php?n=1" name="catSearch"><img src="search.png"></a>
							<p>Search according to your needs</p>
						</section>
						<section class="4u$ 12u$(small)">
							<a href="productMenu.php?n=0"><img src="product.png"></a>
							<p>Our products</p>
						</section>
					</div>
				</div>
			</section>



		<!-- Footer -->
			<footer id="footer">
					 class="copyright">
						&copy; AgroCulture. All rights reserved 2O24.
			</footer>


	  </main>

	</body>
</html>
