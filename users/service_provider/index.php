
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>
	.glass-1 {
  margin-top: 50px;
  margin-bottom: 50px;
  background: rgba(255, 255, 255, 0);
  /* margin-right: 50px; */

  height: 70vh;
  width: 50%;

  border-radius: 2rem;
  z-index: 2;

  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: left;
}	

.glass-2 {
  margin-top: 50px;
  margin-bottom: 50px;
  margin-left: 50px;
  background: rgba(255, 255, 255, 0); /* Transparent background */
  height: 70vh;
  width: 30%;
  
  z-index: 2;
  
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  
}

.glass-3{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-left: 50px;
  margin-right: 50px;
  background: white;
  height: 40vh;
  width: 30%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #67696b;
  text-align: center;
  
}
.glass-4{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 50px;
  background: white;
  height: 40vh;
  width: 30%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #67696b;
  text-align: center;
  
}
.glass-5{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 50px;
  background: white;
  height: 40vh;
  width: 30%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #67696b;
  text-align: center;
  
}
.glass-6{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 50px;
  background: white;
  height: 40vh;
  width: 30%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #67696b;
  text-align: center;
  
}

.glass-7{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 50px;
  
  height: 40vh;
  width: 90%;
  
  border-radius: 2rem;
  z-index: 2;
  background: rgba(255, 255, 255, 0); /* Transparent background */
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  
  text-align: center;
  
}
.glass-3, glass-4, glass-5, glass-6, p{
    color:  #9f2485;
    font-weight: bold;
    padding: 2px;
}

.glass-7 h1 {
    padding: 3px;
    font-weight: bold;
    color: white;
    font-size: 30px;
}

.glass-7 p {
    padding: 3px;
    font-weight: bold;
    color: white;
    line-height: 1.5;
    font-size: 20px; /* Adjust this value to increase or decrease the line spacing */
}
	</style>
<script>
function redirectToRegister() {
  window.location.href = "register.php";
}
</script>
</head>
<body>
<header>
    <div class="header">
        <div class="logo-container">
            <img src="../../images/logo2.png" class="logoimg" width="125px" height="70px" alt="">
        </div>
        <div class="navbar-buttons">
            <nav>
            <ul class="navbar">
                    <li><a href="index.php">Home</a></li>
                    
                    <li><a href="register.php">Register</a></li>
              
                    
                </ul>
            </nav>
            <div class="buttons">
            <ul class="navbar">
                    <!-- <li><a href="..//profile.php">Profile</a></li> -->
                    <li><a href="../../includes/logout.php">Log out</a></li>
                </ul>
                
        </div>
    </div>
</header>


<main class="first-main">
<section class="glass-1">
		<div class="Dashboard">
			
		<h1>Register Your Business</h1>
    <p>
Choose Your Business type and provide the valid details of your business.</p>
        <button type="submit" class="explore-btn" name="submit" onclick="redirectToRegister()">Register</button>
		</div>
		
	</section>

  
	
</main>
<main class="second-main">
<section class="glass-3">
		<div class="Dashboard">
			
<h1>Pet Groomer</h1>
<a href="register.php">	<img src="../../images/register.png" width="200px" height="60px" alt=""></a>


		</div>
		
	</section>

  <section class="glass-4">
		<div class="Dashboard">
			
			
        <h1>Veterinarian</h1>
        <a href="register.php">	<img src="../../images/register.png" width="200px" height="60px" alt=""></a>

		</div>
		
	</section>
    <section class="glass-5">
		<div class="Dashboard">
        <h1>Pharmacist</h1>
        <a href="register.php">	<img src="../../images/register.png" width="200px" height="60px" alt=""></a>


        
		</div>
		
	</section>

  <section class="glass-6">
		<div class="Dashboard">
			
			
        <h1>Pet Shop</h1>
        <a href="register.php">	<img src="../../images/register.png" width="200px" height="60px" alt=""></a>

		</div>
		
	</section>
	
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
    <a href="https://www.facebook.com"><img src="../../images/FB.png" width="40px" height="40px" alt=""></a>
<a href="https://www.twitter.com"><img src="../../images/TW.png" width="40px" height="40px" alt=""></a>
<a href="https://www.instagram.com"><img src="../../images/IG.png" width="40px" height="40px" alt=""></a>
<a href="https://www.linkedin.com"><img src="../../images/LK.png" width="40px" height="40px" alt=""></a>

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