//
<?php
session_start();

require_once '../../db_connect.php'; // Include database connection

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
$query = "SELECT * FROM buyer WHERE busername = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any result is returned
if ($result->num_rows == 1) {
    // Fetch farmer details
    $buyer = $result->fetch_assoc();
} else {
    // Redirect to login page if no farmer found
    header("Location: login.php");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
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
            background: linear-gradient(to bottom right, #C0FFC0, #F0FFF0), url('images/farmers.png'); /* Pale green fading background with image */
            background-size: cover; /* Ensure background image covers the entire element */
            color: #333; /* Text color */
            font-family: Arial, sans-serif; /* Font family */
        }

        .section {
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow effect */
    animation: fadeInUp 1s ease; /* Animation effect */
    transition: background-color 0.3s, box-shadow 0.3s; /* Add transition for smooth color and shadow change */
}

.section:hover {
    background-color: rgba(0, 128, 0, 0.2); 
    box-shadow: 0px 0px 15px rgba(0, 128, 0, 0.4); 
}

        /* Footer styles */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $buyer['bname']; ?>!</h1>
		<nav>
    <ul>
        <li><a href="#" onclick="showContent('salesOverview')">Home</a></li>
		<li><a href="mystock.php" onclick="showContent('productManagement1')">Stocks</a></li>
        <li><a href="buy.php" onclick="showContent('productManagement2')">Buy Stock</a></li>
		<li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    </header>

    <main>
    <section class="component" id="salesOverview">
        <div class="wrapper" >

<div class="wrapper">
  <body class="jumbotron bg-gradient-warning">
    <div class="container">
      <div class="row row-header">
        <div class="col-12 col-sm-6">
          <h1 class="text-white">Farmers & Customers Site</h1>
          <p class="text-white">
           <b>Great Customer FRIEND</b>
          </p>
          <p><b> <h2>Market site</h2></b></p>
          <div class="cg">
            <div class="card card-body bg-gradient-success">
              <blockquote cite="blockquote">
                <h6 class="mb-0 text-dark">
                  <em><b  id="quote"> "Empowering Growth, Cultivating Communities: Your Portal to Agricultural Prosperity..."</b ></em>
                </h6>
                <br />			
              </blockquote>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-3 offset-sm-2 align-self-center">
        </div>
      </div>
    </div>
      </body>

<div class="section features-6 text-dark bg-white" id="services">
  <div class="container ">
    <div class="row align-items-center">
    
      <div class="col-lg-6">
        <div class="info info-horizontal info-hover-success">
          <div class="description pl-4">
            <h3 class="title" >Customers</h3>
       <p class=" ">customers can get recommendations for product.<br> 
        predict the Market Volume and get the news related to Business.<br>Customers can directly Buy  the crops to the Farmers.</p>
                    
          </div>
        </div>

      </div>
      
      
      <div class="col-lg-6 col-10 mx-md-auto d-none d-md-block">
    
      </div>
    </div>
    
    
            <div class="row align-items-center">
              <div class="col-lg-6 col-10 mx-md-auto d-none d-md-block">
      </div>
 
    
    
      <div class="col-lg-6">
        
        <div class="info info-horizontal info-hover-warning mt-5">
          <div class="description pl-4">
            <p class=" ">Customers can buy crops directly from the farmers without the involvement of any middlemen.</p>
          </div>
        </div>
  
      </div>
</div>
  </div>
</div>
  <div class="section features-2 text-dark bg-white" id="features"> 
    <div class="container"> 
      <div class="row align-items-center"> 
        <div class="col-lg-5 col-md-8 mr-auto text-left"> 
          <div class="pr-md-5"> 
            <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5"> <i class="ni ni-favourite-28"> </i></div>
            <h3 class="display-3 text-justify">Features</h3>
            <p>The time is now for the next step in farming. We bring you the future of farming along with great tools for assisting the farmers.</p>
            <ul class="list-unstyled mt-5"> 
              <li class="py-2"> 
                <div class="d-flex align-items-center"> 
                  <div>
                    <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-settings-gear-65"> </i></div>
                  </div>
                  <div>
                    <h6 class="mb-0">Highly Reliable and Accurate.</h6>
                  </div>
                </div>
              </li>
              <li class="py-2"> 
                <div class="d-flex align-items-center"> 
                  <div>
                    <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-html5"> </i></div>
                  </div>
                  <div>
                    <h6 class="mb-0">Faster & Responsive website.</h6>
                  </div>
                </div>
              </li>
              <li class="py-2"> 
                <div class="d-flex align-items-center"> 
                  <div>
                    <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-settings-gear-65"> </i></div>
                  </div>
                  <div>
                    <h6 class="mb-0">Real time Price execution.</h6>
                  </div>
                </div>
              </li>
              <li class="py-2"> 
                <div class="d-flex align-items-center"> 
                  <div>
                    <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-satisfied"> </i></div>
                  </div>
                  <div>
                    <h6 class="mb-0">Integrated news feature.</h6>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        

      
        <div class="col-lg-7 col-md-12 pl-md-0"> 
</div>
        
        
      </div>
    </div>
    <span > </span>
    <span > </span>
  </div>
        </section>

        <section class="component" id="productManagement1">
            <h2>Stocks</h2>
        </section>
        <section class="component" id="productManagement2">
            <h2>MyCart</h2>
        </section>
        <section class="component" id="orderManagement">
            <h2>Digital-Market</h2>
        </section>
        <section class="component" id="productManagement3">
            <h2>Blog</h2>
        </section>
    </main>

    <footer>
      
        &copy; <?php echo date("Y"); ?> Buyer Dashboard
    </footer>

    <script>
        // JavaScript function to show the selected content and hide others
        function showContent(sectionId) {
            // Hide all content sections
            var contents = document.querySelectorAll('.component');
            contents.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected content section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
        }

        // Show the "Home" section by default
        showContent('salesOverview');
    </script>
</body>
</html>
