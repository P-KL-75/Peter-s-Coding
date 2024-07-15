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

// Fetch data from production_approx table
$sql = "SELECT product, quantity FROM stock WHERE quantity > 0";
$query = mysqli_query($conn, $sql);
if (!$query) {
    die("Error: " . mysqli_error($conn));
}

// Fetch data from farmer stock table
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
<body>
    <header>
        <h1>Welcome, <?php echo $farmer['fname']; ?>!</h1>
        <nav>
            <ul>
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><h2> My Stock</h2></a></li>
                <li><a href="dashboard_farmer.php">Back to Home</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div>
            <h2>Crop Availability</h2>
            <table>
                <thead>
                    <tr>
                        <th>Crop Name</th>
                        <th>Quantity (in KG)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $res['product']; ?></td>
                            <td><?php echo $res['quantity']; ?></td>
                        </tr>
                    <?php } ?>

                    <?php while ($res_trade = mysqli_fetch_array($query_trade)) { ?>
                        <tr>
                            <td><?php echo $res_trade['crop']; ?></td>
                            <td><?php echo $res_trade['quantity']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> AgroFarm-farmer</p>
    </footer>
</body>
</html>