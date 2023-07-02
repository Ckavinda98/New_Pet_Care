<?php 
  session_start();
  include 'connect.php';
  
  class Login {
    // ...
  
    public function SessionCheck() {
      global $conn;
      
      // Storing Session
      $user_check = $_SESSION['login'];
  
      // SQL Query To Fetch Complete Information Of User
      $query = "SELECT * FROM user WHERE username = '$user_check'";
      $ses_sql = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($ses_sql);
      $_SESSION["user_id"] = $row["user_id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["user_type"] = $row["user_type"];
      $_SESSION["password"] = $row["password"];
    }
  }
  
  // ...
  
  // Get the user_id from the session
  $user_id = $_SESSION["user_id"];    
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>

.glass-1{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 100px;
  background: white;
  height: 95vh;
  width: 40%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #9f2485;
  color: #9f2485;
  
}

.glass-2{
  margin-top: 50px;
  margin-bottom: 50px;
  margin-left: 100px;
  background: white;
  height: 95vh;
  width: 40%;
  background-color: white;
  border-radius: 2rem;
  z-index: 2;
  backdrop-filter: blur(2rem);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border: 2px solid #9f2485;

  
}

label{
  
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-weight: bold;
  display: inline-block;
  width: 200px;
  color: #9f2485;
}

.loginbtn {
  display: inline-block;
  padding: 8px 10px;
  font-size: 12px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  color: #fff;
  background-color: #9f2485;
  border: none;
  border-radius: 4px;
  transition: background-color 0.3s ease;
  cursor: pointer;
  margin-left: 280px;
  margin-top: 5px;
    
}

.loginbtn:hover {
  background-color: #e442c1;
}


.loginbtn:active {
  background-color: #e77fd1;
}

h1 {
  color: #9f2485;
  margin-top: 10px;

  margin-bottom: 600px;
  /* display: flex; */
  /* align-items: center;
  justify-content: center; */
}


form input, select, textarea{

width: 200px;
height: 40px;
margin: 10px 0;
padding: 0 5px;
border: 1px solid #9f2485;
display: inline-block;
border-radius: 10px;
}



	</style>

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
                    <!-- <li><a href="index.php">Profile</a></li> -->
                    <li><a href="../../includes/logout.php">Log out</a></li>
                </ul>
        </div>
    </div>
</header>


<main class="first-main">


    <section class="glass-1">
		<div class="Dashboard">
        <center>
				<h1 style="margin-bottom: 30px;  border:2px solid #9f2485;; border-radius:10px; width: 90%; color: #9f2485;">Notice</h1>
			</center>
		<ul>
            <li>Use Your Registration Number</li>
            <li>Use Your Address as Busniess Location</li>
            <li>Use Goverment Regostration Name in your busniess</li>
            <li>Use Your Registration Number</li>
            <li>Use Your Address as Busniess Location</li>
            <li>Use Goverment Regostration Name in your busniess</li>
        </ul>
		</div>
		
	</section>

  <section class="glass-2">
		<div class="Dashboard">
			<center>
				<h1 style="margin-bottom: 30px;  border:2px solid #9f2485; border-radius:10px; width: 90%; ">Register Busniess</h1>
			</center>
			<form name="myform" method="POST" onsubmit="return validate()"  action="functions.php">
     
			
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"><br>

				<label>Register ID:</label>
				<input name="registerid" type="text"  placeholder="Registration Number" required autofocus><br>
				<label>Busniess Name:</label>
				<input name="name" type="text"  placeholder="Name" required><br>
                <label>Busniess Type:</label>
				<select name="user_type" class="user_type" >
                    <option value="Pet Grooming">Pet Grooming</option>
                    <option value="Veterinarian">Veterinarian</option>
                    <option value="Pharmacist">Pharmacist</option>
                    <option value="Pet Shop">Pet Shop</option>
                    <option value="Pet DayCare">Pet DayCare</option>
                    </select><br>
                <label>Contact Number:</label>
				<input name="con_num" type="text" placeholder="Contact Number" required autofocus><br>
				<label>Official Email:</label>
				<input name="email" type="email" placeholder="Email" required><br>
                <label>address:</label>
				
                 <input type="text" name="address" placeholder="Address"><br>
               

				
				<button type="submit" class="loginbtn" name="register_b">Register</button>
				<button type="reset" class="clear-button">Clear</button>
			</form>
     
		</div>
		
	</section>

  
	
</main>
<main class="second-main">

	
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
        <a href="https://www.facebook.com">	<img src="../../images/FB.png" width="40px" height="40px" alt=""></a>
		<a href="www.twitter.com">	    <img src="../../images/TW.png" width="40px" height="40px" alt=""></a>
		<a href="www.instagram.com">	<img src="../../images/IG.png" width="40px" height="40px" alt=""></a>
		<a href="www.lindkin.com"> 	<img src="../../images/LK.png" width="40px" height="40px" alt=""></a>
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