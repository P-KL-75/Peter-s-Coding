<?php
include('csession.php');
include('../sql.php');

// Set memory limit and timezone
ini_set('memory_limit', '-1');
date_default_timezone_set("Africa/Nairobi");

// Check if Total_Cart_Price is set in session
if (!isset($_SESSION['Total_Cart_Price'])) {
    header("location: cprofile.php");
    exit(); // Redirect to home page if Total_Cart_Price is not set
}

// Fetch customer details from database
$query = "SELECT * FROM custlogin WHERE email='$user_check'";
$result = mysqli_query($conn, $query);
if (!$result) {
    // Handle query error
    die("Database query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$para2 = isset($row['cust_name']) ? $row['cust_name'] : '';
$para6 = isset($row['phone_no']) ? $row['phone_no'] : '';
$para8 = isset($row['city']) ? $row['city'] : '';
$para9 = isset($row['address']) ? $row['address'] : '';
$para10 = isset($row['pincode']) ? $row['pincode'] : '';

// Fetch total price from session and unset it
$totalPrice = $_SESSION['Total_Cart_Price'];
unset($_SESSION['Total_Cart_Price']);

// Query to fetch cart details
$cartQuery = "SELECT * FROM cart";
$cartResult = mysqli_query($conn, $cartQuery);
if (!$cartResult) {
    // Handle query error
    die("Failed to fetch cart details: " . mysqli_error($conn));
}

// Check if form is submitted for payment confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_confirmed'])) {
    $transaction_id = uniqid(); // Generate a unique transaction ID
    $amount_paid = $totalPrice; // Assuming total price is paid
    $timestamp = date('Y-m-d H:i:s'); // Current timestamp

    // Save payment details to database
    $insertQuery = "INSERT INTO payments (transaction_id, amount_paid, timestamp) VALUES ('$transaction_id', '$amount_paid', '$timestamp')";
    $insertResult = mysqli_query($conn, $insertQuery);
    if (!$insertResult) {
        // Handle insert query error
        die("Failed to save payment details to database: " . mysqli_error($conn));
    }

    // Redirect to receipt page after successful payment confirmation and saving details
    header("Location: receipt.php?transaction_id=$transaction_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<?php include('cheader.php'); ?>
<style>
    
    body {
        background-color: #ffffff; 
    }
    
    .text-green-rainbow {
        color: #4caf50; 
    }
    
    .bg-green-rainbow {
        background-color: #4caf50; 
    }

    .card-header {
        background-color: #8a2be2; 
    }

    .badge-danger {
        background-color: #8a2be2; 

    }

    .btn-default,
    .btn-white {
        background-color: #ffffff; 
        color: #8a2be2; 
    }

    .btn-default:hover,
    .btn-white:hover {
        background-color: #f0f0f0; 
    }

    .invoice-company h3 {
        color: #4caf50; 
    }
</style>

<body id="top">

    <?php include('cnav.php'); ?>

    <section class="section section-shaped section-lg">
      
        <div class="container">
           
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <span class="badge badge-danger badge-pill mb-3">Invoice</span>
                </div>
            </div>
            <div class="row row-content">
                <div class="col-md-12 mb-3">
                    <div class="card text-dark bg-gradient-secondary mb-3">
                        <div class="card-header">
                            <span class="text-green-rainbow display-4">Invoice</span>
                        </div>
                       
                        <div class="card-body">
                            <div class="invoice">
                                <div class="invoice-company text-inverse f-w-600">
                                    <span class="pull-right hidden-print">
                                        <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                                        <a class="btn btn-sm btn-default m-b-10 p-l-5" href="cprofile.php"> <i class="fa fa-rotate-left t-plus-1 fa-fw fa-lg"></i> Home</a>
                                    </span>
                                    <h3>Farmer's Friend</h3> 
                                </div>
                                <div class="invoice-header">
                                    <div class="invoice-to">
                                        <small>To</small>
                                        <address class="m-t-5 m-b-5">
                                            <strong class="text-inverse"><?php echo $para2; ?></strong><br>
                                            <?php echo $para9; ?><br>
                                            <?php echo $para8; ?>, <?php echo $para10; ?><br>
                                            Phone: <?php echo $para6; ?><br>
                                        </address>
                                    </div>
                                    <div class="invoice-date">
                                        <small>Invoice </small>
                                        <div class="date text-inverse m-t-5"><?php echo date('d/m/Y'); ?></div>
                                        <div class="date text-inverse m-t-5"><?php echo date('H:i:s'); ?></div>
                                        <div class="invoice-detail">
                                            #0000123DSS<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-content">
                                    <div class="table-responsive">
                                        <table class="table table-invoice">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th class="text-center" width="10%">Quantity</th>
                                                    <th class="text-center" width="10%">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($rows = mysqli_fetch_assoc($cartResult)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-green-violet"><?php echo ucfirst($rows['cropname']); ?></td>
                                                        <td class="text-center"><?php echo $rows['quantity']; ?></td>
                                                        <td class="text-center"><?php echo $rows['price']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="invoice-price-left">
                                        <div class="invoice-price-row">
                                            <p>Amount Paid</p>
                                        </div>
                                    </div>
                                    <div class="invoice-price-right">
                                        <small>TOTAL</small> <span class="f-w-600">Ksh.&nbsp<?php echo $totalPrice ?></span>
                                    </div>
                                </div>
                                <div class="invoice-footer">
                                    <p class="text-center m-b-5 f-w-600">
                                        THANK YOU FOR YOUR BUSINESS
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>
