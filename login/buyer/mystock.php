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

// Retrieve buyer information from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM buyer WHERE busername = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any result is returned
if ($result->num_rows == 1) {
    // Fetch buyer details
    $buyer = $result->fetch_assoc();
} else {
    // Redirect to login page if no buyer found
    header("Location: ../login.php");
    exit();
}

// Execute the query to retrieve crop availability
$sql_trade = "SELECT product AS crop, SUM(quantity) AS quantity FROM stock GROUP BY product";
$query_trade = mysqli_query($conn, $sql_trade);
if (!$query_trade) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crop Availability</title>
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

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid green; /* Set border color to green */
            background-color: #fff; /* Set background color */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            transition: background-color 0.3s; /* Add transition for background color change */
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-size: 16px; /* Increase font size */
        }

        tr:hover {
            background-color: #f5f5f5; /* Light gray background on hover */
        }

        /* Form section styles */
        .card-header {
            text-align: center;
            background-color: #28a745; /* Set background color */
            color: #fff;
            padding: 15px;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .btn-success {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color: #28a745; /* Set background color */
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s; /* Add transition for background color change */
        }

        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body class="bg-white" id="top">
<header>
        <h1>Welcome, <?php echo $buyer['bname']; ?>!</h1>
        <nav>
            <ul>
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><h2> My Stock</h2></a></li>
                <li><a href="dashboard_buyer.php">Back to Home</a></li>
            </ul>
        </nav>
    </header>
<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="container ">

        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <span class="badge badge-danger badge-pill mb-3">Crops</span>
            </div>
        </div>

        <div class="row row-content">
            <div class="col-md-12 mb-3">

                <div class="card text-white bg-gradient-warning mb-3">
                    <div class="card-header">
                        <span class=" text-warning display-4" > Crop Availability </span>
                    </div>

                    <div class="card-body text-white">
                        <table class="table table-striped table-hover table-bordered bg-gradient-white text-center display" id="myTable">

                            <thead>
                            <tr class="font-weight-bold text-default">
                                <th><center>Crop Name</center></th>
                                <th><center>Quantity (in KG)</center></th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $sql = "SELECT product AS crop, SUM(quantity) AS quantity FROM stock GROUP BY product";
                            $query = mysqli_query($conn, $sql);

                            while ($res = mysqli_fetch_array($query)) {
                                ?>

                                <tr class="text-center">
                                    <td><?php echo $res['crop']; ?></td>
                                    <td><?php echo $res['quantity']; ?></td>
                                </tr>

                            <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<footer>
        <p>&copy; <?php echo date('Y'); ?> AgroFarm-Buyer</p>
    </footer>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</body>

</html>