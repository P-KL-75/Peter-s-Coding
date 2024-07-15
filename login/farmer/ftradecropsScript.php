<?php
session_start();

// Database connection parameters
require_once 'db_connect.php';

// Establish database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if (isset($_POST['Crop_submit'])) {
    // Retrieve form data
    $crop = $_POST['crops'];
    $quantity = $_POST['trade_farmer_cropquantity'];
    $price = $_POST['trade_farmer_cost'];
    $username = $_SESSION['username'];

    // Retrieve farmer ID from the database
    $query1 = "SELECT fid FROM farmer WHERE fusername = ?";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("s", $username);
    $stmt1->execute();
    $result = $stmt1->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $farmer_id = $row['fid'];

        // Insert data into the stock table
        $query2 = "INSERT INTO stock (farmer_id, product, quantity, price) 
                   VALUES (?, ?, ?, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("isdd", $farmer_id, $crop, $quantity, $price);
        if ($stmt2->execute()) {
            // Data inserted successfully
            // Display pop-up window
            echo "<script>alert('Crop added to cart successfully!');";
            // Redirect back to myCart.php after displaying the pop-up
            echo "window.location.href = 'myCart.php';";
            echo "</script>";
        } else {
            // Error inserting data
            echo "Error: " . $stmt2->error;
        }
        // Close second statement
        $stmt2->close();
    } else {
        // No farmer found
        echo "Error: Farmer not found!";
    }

    // Close first statement
    $stmt1->close();
} else {
    // Redirect to the form page if accessed directly
    header("Location: myCart.php");
    exit();
}

// Close connection
$conn->close();
?>
