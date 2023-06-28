
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>
        .first-main-about-m {
            position: relative;
  font-family: "Poppins", sans-serif;

  background-image: url(images/bgpattern.png);
  background-repeat: no-repeat;
  background-size: cover;
  /* border: 2px solid black; */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.first-main-about-m::before {
  content: "";
  position: absolute;
  background: linear-gradient(to bottom, #9f2485 0%, #00a49a 60%);
  top: 0%;
  bottom: 0%;
  left: 0%;
  right: 0%;

  opacity: 0.9;
}
.first-main-about {
  position: relative;
  font-family: "Poppins", sans-serif;

 
  background-repeat: no-repeat;
  background-size: cover;
  /* border: 2px solid black; */
  display: flex;
  
  align-items: center;
  justify-content: center;
}

    .glass-9 {
  margin-top: 10px;
  
 padding: 10px;
 
  /* margin-right: 50px; */

  height: 60vh;
  width: 80%;

  border-radius: 2rem;
  z-index: 2;

  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  text-align: center;
  
  
}
	
  .glass-9 h1 {
  padding: 3px;
  font-weight: bold;
  /* color: #9f2485; */
  color: white;
  font-size: 30px;
  
}

.glass-9 p {
    color: white;
  padding: 3px;
  font-weight: bold;
  /* color: #9f2485; */
  line-height: 1.5;
  font-size: 20px; /* Adjust this value to increase or decrease the line spacing */
 
}
.glass-10 {
  margin-top: 10px;
  margin-bottom: 50px;
 padding: 10px;
 
  /* margin-right: 50px; */
margin-left: 10px;
  height: 250px;
  width: 250px;
background-color: white;
  border-radius: 2rem;
  z-index: 2;

  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  text-align: center;
  background-image: url(images/bgpattern3.png);
  background-repeat: no-repeat;
  background-size: cover;
  border: 2px solid #9f2485;
}

	</style>
</head>
<body>
<header>
    <div class="header">
        <div class="logo-container">
            <img src="images/logo2.png" class="logoimg" width="125px" height="70px" alt="">
        </div>
        <div class="navbar-buttons">
            <nav>
                <ul class="navbar">
                    <li><a href="index.php">Home</a></li>
                    
                    <li><a href="serive.php">Service</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                </ul>
            </nav>
            <div class="buttons">
            <ul class="navbar">
                    <li><a href="register.php">Sing up</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
        </div>
    </div>
</header>


<main class="first-main-about-m">
<section class="glass-9">
		<div class="Dashboard">
			
		<h1>
      About Us
    </h1>
      <p>
      Welcome to Pet E-Care, where we understand the challenges of accessing healthcare services for your beloved pets.
       Our mission is to simplify and streamline the process, revolutionizing the way pet owners access veterinary care and essential pet services.
       
        With our user-friendly web application, you can effortlessly search and book appointments with veterinary clinics, explore detailed veterinarian profiles, and receive convenient notifications.
         We also go beyond veterinary care by providing access to reputable pet grooming centers and daycares.
          Our goal is to promote accessibility and quality in pet-related services, ensuring the well-being of your pets and strengthening the bond between you and your furry companions.
          Join us on this journey of enhanced pet care for happier, healthier lives.
       Experience convenience, reliability, and exceptional service at Pet E-Care.


      </p>
		</div>
		
	</section>
<main class="first-main-about">
    <section class="glass-10">
		<div class="Dashboard">
		
     
		</div>
		
	</section>
    <section class="glass-10">
		<div class="Dashboard">
		
     
		</div>
		
	</section>
    <section class="glass-10">
		<div class="Dashboard">
		
     
		</div>
		
	</section>
    <section class="glass-10">
		<div class="Dashboard">
		
     
		</div>
		
	</section>
	</main>
</main>




 
	


<footer>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-1">
				<h4>Hot Line</h4>	
				<ul>
			<li>0112244455</li>
			<li>0112244455</li>
            <li>0112244455</li>
			</ul>
        </div>
				<div class="col-2">
				<h4>Head Office</h4>	
				<ul>
			<li>No. 36 High way Road</li>
			<li> Colombo</li>
			<li>www.Pet-Care.com</li>
			</ul>
			</div>
				<div class="col-3">
                <h4 style="text-align:center;">Follow Us</h4>
		<div class="colo-3list">
        <a href="www.facebook.com">	<img src="images/FB.png" width="40px" height="40px" alt=""></a>
		<a href="www.twitter.com">	    <img src="images/TW.png" width="40px" height="40px" alt=""></a>
		<a href="www.instagram.com">	<img src="images/IG.png" width="40px" height="40px" alt=""></a>
		<a href="www.lindkin.com"> 	<img src="images/LK.png" width="40px" height="40px" alt=""></a>
        </div>
                </div>
			</div>
			<hr>
        <p class="copyright">- @All Right Reserved Pet Care Insuarance -</p>
		</div>
	</div>
</footer>

</body>
</html>