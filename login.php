<?php include 'settings.php'; //include settings ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>
main {
  position: relative;
  font-family: "Poppins", sans-serif;
  
  background-image: url(images/bgpattern.png);
  background-repeat: no-repeat;
  background-size: cover;
  /* border: 2px solid black; */
 display: flex;
  align-items: center;
  justify-content: center;
}

main::before {
 
    content:"";
  position: absolute;
  background: linear-gradient(to bottom, #9f2485  0%, #00a49a 60%);
  top: 0%;
  bottom: 0%;
  left: 0%;
  right: 0%;
  
  opacity: 0.75;
}
.hello-img{
  margin-bottom: 250px;
}


form input, select{

width: 200px;
height: 40px;
margin: 10px 0;
padding: 0 5px;
border: 1px solid #9f2485;
display: inline-block;
border-radius: 10px;
}


.glass-1{
  margin-top: 50px;
  margin-bottom: 50px;
  
  margin-right: 100px;
  background: white;
  height: 70vh;
  width: 30%;
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

.glass-2{
  margin-top: 50px;
  margin-bottom: 50px;
  margin-left: 300px;
  background: white;
  height: 70vh;
  width: 30%;
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
  width: 100px;
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
  margin-left: 190px;
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


	</style>
	<script type="text/javascript">
function validate()
{
var user_id = document.myform.user_id;
var password = document.myform.password;
if(Emptyfield(user_id,password,conpassword,user_type)){
	{
alert("Fields should not be empty ");
   
return false;
	}
}
}



function Emptyfield(user_id,password)
{ 
var user_id_len = user_id.value.length;
var password_len = password.value.length;


if (user_id_len == 0 || password_len == 0)
{
alert("Fields should not be empty ");
   
return false;
}
else
{
return true;
}
}// end of Emptyfield

</script>
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
                    
                    <li><a href="service.php">Service</a></li>
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


<main>
	
	<section class="glass-1">
		<div class="Dashboard">
			
		<img src="images/dogtr1.png" class="sing-dog-img" width="200px" height="300px" alt="">
    <img src="images/hi.png" class="hello-img" width="150px" height="full" alt="">
    
		</div>
		
	</section>

  <section class="glass-2">
		<div class="Dashboard">
			<center>
				<h1 style="margin-bottom: 30px;  border:2px solid #9f2485; border-radius:10px; width: 50%; ">Sing In</h1>
			</center>
			<form name="myform" method="POST" onsubmit="return validate()" action="includes/login.php" >
			

				<label>Username:</label>
				<input name="login" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus><br>
				<label>Password:</label>
				<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required><br>

        <?php if (isset($_GET['error'])) { ?>
     	<center><p class="error"><?php echo $_GET['error']; ?></p></center>	
     	<?php } ?>
				<button type="submit" class="loginbtn" name="submit">Log In</button>
				<button type="reset" class="clear-button">Clear</button>
			</form>
     
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