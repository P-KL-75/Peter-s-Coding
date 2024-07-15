<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AgroCulture</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="login.css"/>
    <link rel="stylesheet" href="indexfooter.css" />
	
</head>
<body>
<div class="navbar">
    <a href="#">
        <img src="/login/farmer/images/logo.png" alt="Logo">
    </a>
    <a href="#"><b>Home Background</b></a>
    <a href="#" onclick="toggleContactForm()"><b>Contact Us</b></a>
</div>

<!-- Contact Form -->
<div id="contactForm" style="display: none; z-index: 9999;">
    <button onclick="toggleContactForm()" style="position: absolute; top: -10px; right: -265px; background-color: transparent; border: none; color: red; font-size: 50px; cursor: pointer;">&times;</button>
    <div class="shape shape-style-1 shape-primary">
        <span></span>
        <span></span>
    </div>
    <div class="text-gray-100 ">
        <form action="contact.php" method="post" class="mx-auto max-w-lg bg-gray-100 rounded-lg p-8 shadow-lg">
            <h2 class="text-4xl lg:text-5xl font-bold leading-tight text-center mb-8">Contact Us</h2>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="user_name" class="uppercase text-sm text-gray-600 font-bold">Full Name</label>
                    <input type="text" id="user_name" name="user_name"
                           class="w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                           placeholder="Enter your Full Name" required>
                </div>
				<div>
    <label for="user_mobile" class="uppercase text-sm text-gray-600 font-bold">Mobile Number</label>
           <input type="tel" id="user_mobile" name="user_mobile"
           pattern="^0[6-9][0-9]{8}$" 
           title="Enter a valid 10-digit Mobile Number starting with 0 (Ex. 0710255XXX)"
           class="w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
           placeholder="Enter your Mobile Number" required>
        </div>

                <div>
                    <label for="user_email" class="uppercase text-sm text-gray-600 font-bold">Email Id</label>
                    <input type="email" id="user_email" name="user_email"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                           title="Enter Valid Email Id (Ex. abc@xyz.com)"
                           class="w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                           placeholder="Enter your Email Id" required>
                </div>
                <div>
                    <label for="user_address" class="uppercase text-sm text-gray-600 font-bold">Address</label>
                    <input type="text" id="user_address" name="user_address"
                           class="w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                           placeholder="Enter your City/Pincode" required>
                </div>
                <div>
                    <label for="user_message" class="uppercase text-sm text-gray-600 font-bold">Message</label>
                    <textarea id="user_message" name="user_message"
                              class="w-full h-32 bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                              rows="8" placeholder="Enter your Issue" required></textarea>
                </div>
                <div>
                    <button type="submit" name="submit" value="Submit"
                            class="uppercase text-sm font-bold tracking-wide bg-indigo-500 text-gray-100 p-3 rounded-lg w-full focus:outline-none focus:shadow-outline">
                        Send Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<section id="banner" class="wrapper">
    <div class="container">
        <h1>AgroCulture</h1>
        <p>Your Product Our Market</p>
        <br><br>
        <center>
            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                    <button class="button fit" onclick="document.getElementById('id01').style.display='block'" style="width:auto">LOGIN</button>
                </div>

                <div class="6u 12u$(xsmall)">
                    <button class="button fit" onclick="document.getElementById('id02').style.display='block'" style="width:auto">REGISTER</button>
                </div>
            </div>
        </center>


    </section>

    <!-- One -->
    <section id="one" class="wrapper style1 align-center">
        <div class="container">
            <header>
                <h2>AgroCulture</h2>
                <p><h4>True Farmers Friend</h4></p>
            </header>
            <div class="row 200%">
                <section class="4u 12u$(small)">
                    <i class="icon big rounded fa-clock-o"></i>
                    <p><h4>Digital Market</h4></p>
                </section>
                <section class="4u 12u$(small)">
                    <i class="icon big rounded fa-comments"></i>
                    <p><h4>Agro-Blog</h4></p>
                </section>
                <section class="4u$ 12u$(small)">
                    <i class="icon big rounded fa-user"></i>
                    <p><h4>Regiser With Us</h4></p>
                </section>
            </div>
        </div>
    </section>

	<div id="id01" class="modal">

<form class="modal-content animate" action="login/login.php" method='POST'>
  <div class="imgcontainer">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  </div>

  <div class="container">
  <h3>Login</h3>
						  <form method="post" action="login/login.php">
							  <div class="row uniform 50%">
								  <div class="7u$">
									  <input type="text" name="uname" id="uname" value="" placeholder="UserName" style="width:80%" required/>
								  </div>
								  <div class="7u$">
									  <input type="password" name="pass" id="pass" value="" placeholder="Password" style="width:80%" required/>
								  </div>
							  </div>
								  <div class="row uniform">
									  <p>
										  <b>Category : </b>
									  </p>
									  <div class="3u 12u$(small)">
										  <input type="radio" id="farmer" name="category" value="1" checked>
										  <label for="farmer">Farmer</label>
									  </div>
									  <div class="3u 12u$(small)">
										  <input type="radio" id="buyer" name="category" value="0">
										  <label for="buyer">Buyer</label>
									  </div>
								  </div>
								  <center>
								  <div class="row uniform">
									  <div class="7u 12u$(small)">
										  <input type="submit" value="Login" />
									  </div>
								  </div>
								  </center>
							  </div>
						  </form>
					  </section>
</div>
  </div>
  </div>
</form>
</div>


<div id="id02" class="modal">

<form class="modal-content animate" action="Login/signUp.php" method='POST'>
  <div class="imgcontainer">
	<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  </div>

  <div class="container">

<section>
						  <h3>SignUp</h3>
						  <form method="post" action="login/signUp.php">
							  <center>
							  <div class="row uniform">
								  <div class="3u 12u$(xsmall)">
									  <input type="text" name="name" id="name" value="" placeholder="Name" required/>
								  </div>
								  <div class="3u 12u$(xsmall)">
									  <input type="text" name="uname" id="uname" value="" placeholder="UserName" required/>
								  </div>
							  </div>
							  <div class="row uniform">
								  <div class="3u 12u$(xsmall)">
									  <input type="text" name="mobile" id="mobile" value="" placeholder="Mobile Number" required/>
								  </div>

								  <div class="3u 12u$(xsmall)">
									  <input type="email" name="email" id="email" value="" placeholder="Email" required/>
								  </div>
							  </div>
							  <div class="row uniform">
								  <div class="3u 12u$(xsmall)">
									  <input type="password" name="password" id="password" value="" placeholder="Password" required/>
								  </div>
								  <div class="3u 12u$(xsmall)">
									  <input type="password" name="pass" id="pass" value="" placeholder="Retype Password" required/>
								  </div>
							  </div>
							  <div class="row uniform">
								  <div class="6u 12u$(xsmall)">
									  <input type="text" name="addr" id="addr" value="" placeholder="Address" style="width:80%" required/>
								  </div>
							  </div>
							  <div class="row uniform">
								  <p>
									  <b>Category : </b>
								  </p>
								  <div class="3u 12u$(small)">
									  <input type="radio" id="farmer" name="category" value="1" checked>
									  <label for="farmer">Farmer</label>
								  </div>
								  <div class="3u 12u$(small)">
									  <input type="radio" id="buyer" name="category" value="0">
									  <label for="buyer">Buyer</label>
								  </div>
							  </div>
							  <div class="row uniform">
								  <div class="3u 12u$(small)">
									  <input type="submit" value="Submit" name="submit" class="special" /></li>
								  </div>
								  <div class="3u 12u$(small)">
									  <input type="reset" value="Reset" name="reset"/></li>
								  </div>
							  </div>
						  </center>
						  </form>
					  </section>

  </div>
  </div>
</form>
</div>


    <!-- Footer -->
    <footer class="footer-distributed" style="background-color:black" id="aboutUs">
        <center>
            <h1 style="font: 35px calibri;">About Us</h1>
        </center>
        <div class="footer-left">
            <h3 style="font-family: 'Times New Roman', cursive;">AgroCulture &copy; </h3>

            <br />
            <p style="font-size:20px;color:white">Your product Our market !!!</p>
            <br />
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p style="font-size:20px">Agro Culture Fam<span>Elisha</span></p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p style="font-size:20px">0713418452</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p style="font-size:20px"><a href="mailto:agroculture@gmail.com" style="color:white">elishakiplaa001@gmail.com</a></p>
            </div>
        </div>

        <div class="footer-right">
            <p class="footer-company-about" style="color:white">
                <span style="font-size:20px"><b>About AgroCulture</b></span>
                AgroCulture is e-commerce trading platform for grains & grocerries...
            </p>
            <div class="footer-icons">
                <a  href="#"><i style="margin-left: 0;margin-top:5px;"class="fa fa-facebook"></i></a>
                <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-instagram"></i></a>
                <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-youtube"></i></a>
            </div>
        </div>

    </footer>

    <script>
          function toggleContactForm() {
        var contactForm = document.getElementById('contactForm');
        contactForm.style.display === 'none' ? contactForm.style.display = 'block' : contactForm.style.display = 'none';
    }

        var modal = document.getElementById('id01');

       
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var modal1= document.getElementById('id02');
        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }

    </script>


</body>
</html>
