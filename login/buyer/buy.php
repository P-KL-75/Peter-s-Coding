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
    header("Location: login.php");
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
<style>
     
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; 
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
            transition: color 0.3s; 
        }

        nav ul li a:hover {
            color: red; 
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
            background-color: #218838; 
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
  <body class="bg-white" id="top">
  <section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
      <span></span>
    </div>


<div class="container ">
    
    	 <div class="row">
          <div class="col-md-8 mx-auto text-center">
            <span class="badge badge-danger badge-pill mb-3">Shopping</span>
          </div>
        </div>
		
          <div class="row row-content">
            <div class="col-md-12 mb-3">

				<div class="card text-white bg-gradient-danger mb-3">
				  <div class="card-header">
				  <span class=" text-danger display-4" > Buy Crops </span>
				  
					
				  </div>
				  
				  <div class="card-body ">
			

				                                                                                                                         

                <table class="table table-striped table-bordered table-responsive-md btn-table  ">

                    <thead class=" text-white text-center">
                    <tr>
					
                        <th>Crop Name</th>
                        <th>Quantity (in KG)</th>
                        <th>Price (in Ksh)</th>
						<th>Add Item</th>
	
                    </tr>
                    </thead>

                    <tbody>
					
                    <tr>
					
			
						 
<form method="POST" action="cbuy_redirect.php">

						<td>
                        <div class="form-group" >						
									<?php  									
						// query database table for crops with quantity greater than zero
						$sql = "SELECT product FROM stock where quantity > 0 ";
						$result = $conn->query($sql);

						// populate dropdown menu options with the crop names
						echo "<select id='product' name='product' class='form-control text-dark'>";
						echo "<option value=' '>Select Crop</option>";
						while($row = $result->fetch_assoc()) {							
							echo "<option value='" . $row["product"] . "'>" . $row["product"] . "</option>";
						}
						echo "</select>";
						

						?>	
											
						</div>					
						</td>
			
			
<input hidden name="id" id="id"  value="">



						<td>   
						  <div class="form-group">     
							<input id="quantity" type="number" placeholder="Available Quantity" max="1000" name="quantity" required class="form-control text-dark">   
						  </div> 
						 </td>


                        <td>
                        <div class="form-group" >
                        <input id="price" type="text" value="0" name="price"  readonly class="form-control text-dark">
                        </div>
						</td>	
						
						
						 
						<td>
						 <div class="form-group" >
						<button class="btn btn-success form-control" name="add_to_cart" type="submit" disabled >Add To Cart </button>
						</div>
						</td>
							    
	</form>
	
		
						</tr>
						</tbody>
                        </table> 

			<h3 class=" text-white">Order Details</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-responsive-md btn-table display" id="myTable">
					<tr class=" bg-dange">
						<th width="40%">Item Name</th>
						<th width="10%">Quantity (in KG)</th>
						<th width="20%">Price (in Ksh.)</th>				
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>

	
					<tr class=" bg-white">
						<td><?php echo ucfirst($values["item_name"]); ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>Ksh. <?php echo $values["item_price"]; ?> </td>
				
					<td><a href="cbuy_crops.php?action=delete&id=<?php echo $values["item_id"]; ?>" type="button" class="btn btn-warning btn-block" >Remove</a></td>
					
					</tr>

<?php

		if(isset($_GET["action"]))
		{
			if($_GET["action"] == "delete")
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($values["item_id"] == $_GET["id"])
					{
						unset($_SESSION["shopping_cart"][$keys]);
						$b=$_GET["id"];
						
						$query5="SELECT product from stock where id= $b";
						$result5 = mysqli_query($conn, $query5);
						$row5 = $result5->fetch_assoc(); 
						$a=$row5["product"];
						
						
						$query6="DELETE FROM `cart` WHERE `cropname` = '".$a."'";
						$result6 = mysqli_query($conn, $query6); 

						echo '<script>alert("Item Removed")</script>';
						echo '<script>window.location="cbuy_crops.php"</script>';
		

					     
						
					}
				}
			}
		}
?>

					<?php
							$total = $total +  $values["item_price"];
							$_SESSION['Total_Cart_Price']=$total;
						}
					?>
					<tr class="text-dark">
						<td colspan="2" align="right" >Total</td>
						<td align="right">Ksh. <?php echo number_format($total,2); ?></td>

						<td>
						<form method="POST" action="mpesa_payment.php">

    <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
    <button class="btn btn-info form-control" name="pay" type="submit">Pay </button>
</form>

</td>

					<?php
					}
					?>
						
				</table>
			</div>
</div>
				</div>				 		  
            </div>
          </div>
        </div>
		 
</section>
										
<script>
				$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

						
<script> 
document.getElementById("product").addEventListener("change", function() {   
  var crops = jQuery('#product').val();   
  jQuery.ajax({     
    url: 'check_quantity.php',     
    type: 'post',     
    data: 'product=' +product,     
    success: function(result) { 
		      try {
				 var result = JSON.parse(result);
				  
				 var cquantity = parseInt(result.quantityR);
				 var TradeId = parseInt(result.TradeIdR);  
				  console.log(result);

				 if (cquantity > 0) {         
						document.getElementById("quantity").placeholder = cquantity;         
					   
						document.getElementById("id").value =id;
					  } else {         
						document.getElementById("quantity").placeholder = "Select product";       
					  } 

			} catch (error) {
				  console.log('Error:', error);
			}

	  
    }   
  }); 
}); 
</script>    

<script>
  document.getElementById("quantity").addEventListener("change", function() {
const addToCartBtn = document.querySelector('[name="add_to_cart"]');
    var quantity = jQuery('#quantity').val();
	  var product = jQuery('#produc').val();
		
    jQuery.ajax({
      url: 'ccheck_price.php',
      type: 'post',
      data: { product: product, quantity: quantity },
      success: function(result) {
			var cprice = parseInt(result);
			if(cprice>0){
				document.getElementById("price").value = cprice;
				addToCartBtn.removeAttribute('disabled');
			}
			else{
				document.getElementById("price").value = "0";
			}
		}
	});
});
</script>
	<script>
document.getElementById("quantity").addEventListener("change", () => {
  const quantityInput = document.getElementById("quantity");
  const max = parseInt(quantityInput.placeholder);
  const enteredQuantity = parseInt(quantityInput.value);

  if (enteredQuantity > max) {
    alert(`Maximum quantity exceeded. Please enter a quantity less than or equal to ${max}.`);
    quantityInput.value = max; 
  }
});
function tradecrops() {
    var temp = document.getElementById("trade_farmer_cost").value;
    var cost = Number(temp);
    var crop = document.getElementById("crops").value;

    var goAhead = true;

    switch (crop) {
        case "sorghum":
            if (cost > (39 + Math.ceil(39 * 0.05)) || cost < (39 - Math.ceil(39 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "tomatoes":
            if (cost > (14 + Math.ceil(14 * 0.05)) || cost < (14 - Math.ceil(14 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "barley":
            if (cost > (11 + Math.ceil(11 * 0.05)) || cost < (11 - Math.ceil(11 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "cotton":
            if (cost > (37 + Math.ceil(37 * 0.05)) || cost < (37 - Math.ceil(37 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "gram":
            if (cost > (33 + Math.ceil(33 * 0.05)) || cost < (33 - Math.ceil(33 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "onion":
            if (cost > (17 + Math.ceil(17 * 0.05)) || cost < (17 - Math.ceil(17 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "avocado":
            if (cost > (27 + Math.ceil(27 * 0.05)) || cost < (27 - Math.ceil(27 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "lentil":
            if (cost > (32 + Math.ceil(32 * 0.05)) || cost < (32 - Math.ceil(32 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "maize":
            if (cost > (12 + Math.ceil(12 * 0.05)) || cost < (12 - Math.ceil(12 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "mangoes":
            if (cost > (47 + Math.ceil(47 * 0.05)) || cost < (47 - Math.ceil(47 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "potatoes":
            if (cost > (21 + Math.ceil(21 * 0.05)) || cost < (21 - Math.ceil(21 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "rice":
            if (cost > (13 + Math.ceil(13 * 0.05)) || cost < (13 - Math.ceil(13 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "soyabean":
            if (cost > (25 + Math.ceil(25 * 0.05)) || cost < (25 - Math.ceil(25 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "millet":
            if (cost > (38 + Math.ceil(38 * 0.05)) || cost < (38 - Math.ceil(38 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        case "wheat":
            if (cost > (13 + Math.ceil(13 * 0.05)) || cost < (13 - Math.ceil(13 * 0.05))) {
                alert("Price is not in the current market range");
                goAhead = false;
            }
            break;
        default:
            alert("Invalid crop selection");
            goAhead = false;
            break;
    }

    return goAhead;
}


</script>
	
</body>
</html>
