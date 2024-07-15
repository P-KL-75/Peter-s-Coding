<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    require_once '../db_connect.php'; 

   
    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_POST["uname"];
    $password = $_POST["pass"];

    $query = "SELECT * FROM farmer WHERE fusername = ? AND fpassword = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful for farmer
        $_SESSION["username"] = $username;
        header("Location: farmer/dashboard_farmer.php");
        exit();
        
    } else {
        // Prepare and execute the query for the buyer table
        $query = "SELECT * FROM buyer WHERE busername = ? AND bpassword = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Login successful for buyer
            $_SESSION["username"] = $username;
            header("Location: buyer/dashboard_buyer.php");
            exit();
        } else {
            // Login failed
            echo "Invalid username or password.";
            // Execute JavaScript alert for better user experience
            echo '<script>alert("Invalid username or password.");</script>';
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
