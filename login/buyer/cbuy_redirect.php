<?php
session_start();
require('db_connect.php');

if(isset($_POST['add_to_cart'])) {
    $crop = $_POST['crops'];
    $quantity = $_POST['quantity'];
    $tradeID = $_POST['tradeid'];
    $price = $_POST['price'];

    $checkQuery = "SELECT * FROM cart WHERE cropname = '$crop'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if(mysqli_num_rows($checkResult) > 0) {
        
        $updateQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE cropname = '$crop'";
        mysqli_query($conn, $updateQuery);
    } else {
       
        $insertQuery = "INSERT INTO cart (cropname, quantity, price) VALUES ('$crop', $quantity, $price)";
        mysqli_query($conn, $insertQuery);
    }

  
    $updateQuery = "UPDATE production_approx SET quantity = quantity - $quantity WHERE crop = '$crop'";
    mysqli_query($conn, $updateQuery);

    if(isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($tradeID, $item_array_id)) {
            $item_array = array(
                'item_id'         => $tradeID,
                'item_name'       => $_POST["crops"],
                'item_price'      => $_POST["price"],
                'item_quantity'   => $_POST["quantity"]
            );
            $_SESSION['shopping_cart'][] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'         => $tradeID,
            'item_name'       => $_POST['crops'],
            'item_price'      => $_POST["price"],
            'item_quantity'   => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
    header("Location: buy.php?action=add&id=$tradeID");
}
?>
