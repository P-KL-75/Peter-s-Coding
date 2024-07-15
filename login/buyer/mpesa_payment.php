<?php
include('csession.php');
include('db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
    exit(); 
}

$error = '';
$para2 = '';

// Function to make a curl request
function curlRequest($url, $data = null, $headers = [], $method = 'GET') {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    return json_decode($response);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {
    if (isset($_POST['phone_number']) && preg_match("/^[0-9]{10}$/", $_POST['phone_number'])) {
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

        // Retrieve total amount from the form
        if (isset($_POST['total_amount'])) {
            $total_amount = floatval($_POST['total_amount']);

            
            $amount = $total_amount;
            $phone_number = '254' . substr($phone_number, -9); 

            // Safaricom sandbox API credentials
            $consumer_key = 'oORfCKiuXzeuxAWCh81Sl7lXylD0iSkqk6IACOWNjFlVCAXI';
            $consumer_secret = 'SdwBIXnZKcB9c55gxelCuqOImgP0fdEiEwBefunmR6pwX1l8QYhFOgwEX2iQPjjy';

            // Generate access token
            $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
            $headers = [
                'Content-Type: application/json',
                'Authorization: Basic ' . $credentials
            ];

            $access_token_response = curlRequest($access_token_url, null, $headers);

            if ($access_token_response && isset($access_token_response->access_token)) {
                $access_token = $access_token_response->access_token;

                
                $api_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
                $stk_request = [
                    'BusinessShortCode' => '174379',
                    'Password' => base64_encode('174379' . 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919' . date('YmdHis')),
                    'Timestamp' => date('YmdHis'),
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => '254708374149',
                    'PartyB' => '174379',
                    'PhoneNumber' => $phone_number,
                    'CallBackURL' => 'https://subtly-harmless-oriole.ngrok-free.app/FARMER%20FRIEND/customer/callback.php',
                    'AccountReference' => 'Farmer Friend',
                    'TransactionDesc' => 'Payment for goods/services'
                ];

                // Make STK push request
                $stk_response = curlRequest($api_url, $stk_request, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $access_token
                ], 'POST');

                if ($stk_response) {
                    // Process API response
                    if (isset($stk_response->ResponseCode) && $stk_response->ResponseCode == 0) {
                        header("Location: cmoney_transfered.php");
                        exit();
                    } else {
                        $error = "Failed to initiate STK push: " . $stk_response->errorMessage;
                    }
                } else {
                    $error = "Failed to initiate STK push. Please try again later.";
                }
            } else {
                $error = "Failed to generate access token. Please try again later.";
            }
        } else {
            $error = "Total amount is missing.";
        }
    } else {
        $error = "Please enter a 10-digit phone number.";
    }
}
?>

<!DOCTYPE html>
<html>
<?php include('cheader.php'); ?>

<body class="bg-white" id="top">

    <?php include('cnav.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <span class="badge badge-danger badge-pill mb-3">M-Pesa Payment</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header bg-info text-white">
                        <h3><b>Make Payment</b></h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="total_amount" value="<?php echo isset($_SESSION['Total_Cart_Price']) ? $_SESSION['Total_Cart_Price'] : '0'; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="pay">Confirm Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
