<?php
session_start();

function SessionCheck() {
  include 'connect.php';
  
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
  
    // Retrieve the business_id from the business_details table
    $businessIdQuery = "SELECT busniess_id FROM busniess_details WHERE user_id = '{$_SESSION["user_id"]}'";
    $businessIdResult = mysqli_query($conn, $businessIdQuery);
    $businessIdRow = mysqli_fetch_assoc($businessIdResult);
    $businessId = $businessIdRow["busniess_id"];
  
    // Store the business_id in the session
    $_SESSION["busniess_id"] = $businessId;
  
    // Retrieve the shop_id from the pet_shop table
    $shopIdQuery = "SELECT shop_id FROM pet_shop WHERE busniess_id = '{$_SESSION["busniess_id"]}'";
    $shopIdResult = mysqli_query($conn, $shopIdQuery);
    $shopIdRow = mysqli_fetch_assoc($shopIdResult);
    @$shopId = $shopIdRow["shop_id"];
  
    // Store the shop_id in the session
    $_SESSION["shop_id"] = $shopId;
  
    // Use the retrieved user_id, business_id, and shop_id for further operations
    // Here you can perform any other required actions with the user_id, business_id, and shop_id
}

// Call the SessionCheck function to set the session variables
SessionCheck();

// Get the shop_id from the session
$shopId = $_SESSION["shop_id"];

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>
    
.first-main {
  position: relative;
  font-family: "Poppins", sans-serif;

  /* background-image: url(images/bgpattern.png); */
  background-repeat: no-repeat;
  background-size: cover;
  /* border: 2px solid black; */
  display: flex;
  align-items: center;
  justify-content: center;
}

.first-main::before {
  content: "";
  position: absolute;
  /* background: linear-gradient(to bottom, #9f2485 0%, #00a49a 60%); */
  top: 0%;
  bottom: 0%;
  left: 0%;
  right: 0%;

  opacity: 0.9;
}
	

.glass-3{
  /* margin-top: 50px; */
  /* margin-bottom: 50px; */
  
  margin-left: 50px;
  /* margin-right: 50px; */
  background: white;
  height: 10vh;
  width: 30%;
  background-color: #f6f6f6; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0); /* Increased box shadow with larger values */
  /* border-radius: 2rem; */
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
  /* margin-top: 50px; */
  /* margin-bottom: 50px; */
  
  /* margin-right: 50px; */
  background: white;
  height: 10vh;
  width: 30%;
  background-color: #f6f6f6; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0); /* Increased box shadow with larger values */
  /* border-radius: 2rem; */
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
  /* margin-top: 50px; */
  /* margin-bottom: 50px; */
  
  /* margin-right: 50px; */
  background: white;
  height: 10vh;
  width: 30%;
  background-color: #f6f6f6; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4); /* Increased box shadow with larger values */
  /* border-radius: 2rem; */
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
  
  /* margin-right: 50px; */
  background: white;
  height: 10vh;
  width: 30%;
  background-color: #f6f6f6; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0); /* Increased box shadow with larger values */
  /* border-radius: 2rem; */
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
  
  /* margin-right: 50px; */
  
  height: 40vh;
  width: 90%;
  
  /* border-radius: 2rem; */
  z-index: 2;
  /* background: rgba(255, 255, 255, 0);  */
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

.glass-7, glass-3, glass-4, glass-5, glass-6, h1 {
    padding: 3px;
    margin-top: 10px;
    font-weight: bold;
    color:  #67696b;
    font-size: 30px;
}

.glass-7 p {
    padding: 3px;
    font-weight: bold;
    color: white;
    line-height: 1.5;
    font-size: 20px; /* Adjust this value to increase or decrease the line spacing */
}

/* 
form input, select{

width: 200px;
height: 20px;
margin: 10px 0;
padding: 0 5px;
border: 1px solid #ccc;
display: inline-block;
border:2px solid rgba(0, 0, 0, 0.432);
} */


.glass{
  
  margin: 50px;
  /* background: white; */
  min-height: 80vh;
  width: 80%;
  background-color: #f6f6f6; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4); /* Increased box shadow with larger values */
  border-radius: 2rem;
  z-index: 2;
  /* backdrop-filter: blur(2rem); */
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  
}

/* label{
  
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-weight: bold;
  display: inline-block;
  width: 100px;
} */

.loginbtn, .Addbtn{
    display: inline-block;
    background: darkblue;
    color: #fff;
    padding: 5px 15px;
    margin-left: 150px;
    margin-top: 20px;
    transition: background 0.5s;
    
}

main {
  position: relative;
  font-family: "Poppins", sans-serif;
  min-height: 20vh;
  /* background: linear-gradient(to bottom, #faedf0 0%, #eec4cd 60%); */
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}


.modern-form {
      max-width: 600px;
      margin: 0 auto;
      display: flex;
      flex-wrap: wrap;
    }

    .modern-form .form-group {
      width: calc(50% - 10px);
      margin-bottom: 20px;
      margin-right: 20px; /* Add margin-right for the gap */
    }

    .modern-form .form-group:last-child {
      margin-right: 0; /* Remove margin-right for the last form group */
    }

    .modern-form .form-group.full-width {
      width: 100%;
    }

    .modern-form label {
      display: block;
      margin-bottom: 5px;
    }

    .modern-form input[type="text"],
    .modern-form input[type="email"],
    .modern-form textarea,
    .modern-form input[type="number"],
    .modern-form input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .modern-form .btn-submit {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      margin-top: 20px; /* Add margin-top to create space between the button and input fields */
    }

    /* Add your existing CSS styles here */
    .split-screen-container {
      display: flex;
    }

    .form-section {
      flex: 1;
      padding-right: 20px;
    }

    .preview-section {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      
    }

    #image-preview {
  max-width: 200px;
  max-height: 200px;
  margin-top: 10px;
  float: right;
}
	</style>
<script>
   function previewImage(event) {
  var reader = new FileReader();
  reader.onload = function() {
    var output = document.getElementById('image-preview');
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
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
                    <li><a href="aboutus.php">My Shop</a></li>
                   
                    <li><a href="AddShopDetails.php">Shop Details</a></li>
                    <li><a href="AddProduct.php">Product Details</a></li>
                    <li><a href="AddProfileDetails.php">Profile</a></li>
                    
                </ul>
            </nav>
            <div class="buttons">
            <ul class="navbar">
                    <!-- <li><a href="register.php">Sing up</a></li> -->
                    <li><a href="../../includes/logout.php">Log out</a></li>
                </ul>
        </div>
    </div>
</header>


<main class="second-main">
<section class="glass-3">
		<div class="Dashboard">
			
<h1>Add Shop Details</h1>


		</div>
		
	</section>

  <section class="glass-4">
		<div class="Dashboard">
			
			
        <h1>Add Profile Details</h1>


		</div>
		
	</section>
    <section class="glass-5">
		<div class="Dashboard">
        <h1>Add Product Details</h1>
       

        
		</div>
		
	</section>


	
</main>
<main>
	
	<section class="glass">
		<div class="Dashboard">
			<center>
				<h1 style="margin-bottom: 30px;  ">Add Product Details</h1>
			</center>
            <div class="split-screen-container">
          <div class="form-section">
            <form class="modern-form" action="function.php" method="POST" enctype="multipart/form-data">
              <!-- Rest of your form inputs -->
              <input type="hidden" name="shopId" value="<?php echo $shopId; ?>"><br>
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
              </div>
              <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
              </div>
              <div class="form-group">
              <label for="image">Image:</label>
            <input type="file" id="image" name="file" accept="image/*" onchange="previewImage(event)">
              </div>
              <div class="form-group full-width">
                <button type="submit" name="submit_p" class="btn-submit">Upload</button>
              </div>
            </form>
          </div>
          <div class="preview-section">
           
            <div class="form-group">
              <img id="image-preview" src="#" alt="" />
            </div>
          </div>
        </div>
      </div>






     
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
        <a href="www.facebook.com">	<img src="../../images/FB.png" width="40px" height="40px" alt=""></a>
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