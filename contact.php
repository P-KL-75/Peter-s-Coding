<?php
include 'db_connect.php';

if ($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_name = $_POST['user_name'];
        $user_mobile = $_POST['user_mobile'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_message = $_POST['user_message'];
        $show_modal = false;

        try {
            $stmt = $pdo->prepare("INSERT INTO contactus (c_name, c_mobile, c_email, c_address, c_message) VALUES (?, ?, ?, ?, ?)");

           
            $stmt->bindParam(1, $user_name);
            $stmt->bindParam(2, $user_mobile);
            $stmt->bindParam(3, $user_email);
            $stmt->bindParam(4, $user_address);
            $stmt->bindParam(5, $user_message);


            if ($stmt->execute()) {
                echo "<script type='text/javascript'>
                alert('Submitted successfully');
                window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                alert('Submission failed. Please make sure your entries are unique.');
                window.location.href = 'index.php#contactForm';
                </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Failed to connect to the database.";
}
?>
