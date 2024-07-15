
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        /* Navigation styles */
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

        /* Add red hover color */
        nav ul li a:hover {
            color: red;
        }

        /* Main content styles */
        main {
            padding: 20px;
        }

        .component {
            margin-bottom: 30px;
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
    </style>

</head>
<body>
    <header>
        <h1>Welcome, <?php echo $farmer['fname']; ?>!</h1>
        <nav>
            <ul>
            <ul>
						<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"> MyCart</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-grain"> Digital-Market</a></li>
						<li><a href="blogView.php"><span class="glyphicon glyphicon-comment"> BLOG</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Placeholder for each component -->
        <section class="component" id="salesOverview">
            <h2>MyCart</h2>
            <!-- Your sales overview content here -->
        </section>
        <section class="component" id="productManagement">


  <body class="bg-white" id="top">
  
 	
  <section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
      <span></span>
      <span></span>
    </div>


<div class="container ">
    
	<div class="row">
	<div class="col-md-8 mx-auto text-center">
	<span class="badge badge-danger badge-pill mb-3">Trade</span>
	</div>
	</div>
		
          <div class="row row-content">
            <div class="col-md-12 mb-3">

				<div class="card text-white bg-gradient-success mb-3">
				  <div class="card-header">
				  <span class=" text-success display-4" > Update Crop Stock  </span>					
				  </div>

				  <div class="card-body text-dark">
				  
				  <form role="form" onsubmit="return tradecrops()" id="sellcrops" action="ftradecropsScript.php" method="POST">



									<div class="alert alert-info alert-dismissible fade show text-center" style="display: none;" id="popup" role="alert">
									<strong class="text-center text-dark ">Current Market Avg Price for <span id="crop"></span> is: <span id="price"></span></strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									
									
									<div class="alert alert-info alert-dismissible fade show text-center" style="display: none;" id="details" role="alert">
									<strong class="text-center text-dark ">Crop Details Added Successfully</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									
									
										<table class="table table-striped table-hover table-bordered bg-gradient-white text-center display" id="myTable">

							<thead>
											<tr class="font-weight-bold text-default">
											<th><center>Crop Name</center></th>
											<th><center>Quantity (in KG)</center></th>
											<th><center>Cost borne by farmer per KG (in Ksh)</center></th>
											<th><center>Upload CROP Details</center></th>
											
								</tr>
							</thead>
	

                    <tbody>
                                 <tr class="text-center">
                        <td>
                        <div class="form-group" >
						<select id="crops" name="crops" class="form-control ">
							<option value="">Select Crop</option>
  							<option value="sorghum">Sorghum</option>
							<option value="tomatoes">Tomatoes</option>  
							<option value="barley">Barley</option>
							<option value="cotton">Cotton</option>	
							<option value="gram">Gram</option>
							<option value="onion">Onion</option>
							<option value="avocado">Avocado</option>
							<option value="lentil">Lentil</option>
							<option value="maize">Maize</option>
							<option value="mangoes">Mangoes</option>
							<option value="potatoes">Potatoes</option>
  							<option value="rice">Rice</option>
							<option value="soyabean">Soyabean</option>
							<option value="millet">Millet</option>
							<option value="wheat">Wheat</option>
						</select>					
						</div>					
						</td>
						
                        <td>
                        <div class="form-group" >
                        <input type="number" name="trade_farmer_cropquantity"  required class="form-control required">
                        </div>
						</td>

						<td>
						<div class="form-group" >
                        <input type="number" name="trade_farmer_cost" id="trade_farmer_cost" required class="form-control required">
                        </div>
						</td>
						
                        <td>
                        <center>
                        <button type="submit" name="Crop_submit" value="Crop_submit" class="btn btn-success">Submit</button>
                        </center>
                        </td>
                    </tr>
                    
                    </tbody>

                    </table> 
                </form>
</div>
</div>



	
            </div>
          </div>  
       </div>
		 
</section>


 
        <section class="component" id="orderManagement">
            <h2>Digital-Market</h2>
						</section>
					</div>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
					</ul>
				</div>
			</footer>




	</body>
</html>

        </section>
        <!-- Add more sections for other components -->
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Farmer Dashboard</p>
    </footer>
</body>
</html>
