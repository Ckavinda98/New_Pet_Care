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
$user_id = $_SESSION["user_id"];

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>
    body {
  background-color: #f8f8f8;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}


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
	

.glass{
  
    background-color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  margin: 20px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  
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
.form-group{
    display: flex;
    flex-direction: column;
    width: 100%;
}

.modern-form {
      max-width: 600px;
      
      display: flex;
      flex-wrap: wrap;
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

.product-container {
  display: flex;
  
  justify-content: center;
  
}

    .card {
  display: flex;
  margin-top: 30px;
  margin-bottom: 20px;
  justify-content: center;
  align-items: center;
  background-color: #9f2485;;
  padding: 10px;
 
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card h2 {
  font-size: 24px;
  margin: 0;
  color: white;
}




	.glass {
  
  
    background-color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  margin: 20px;
  padding: 20px;
  /* border-radius: 10px;/ */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.glass img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  /* border-radius: 50%; */
  margin-bottom: 10px;
}

.glass h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.glass p {
  font-size: 14px;
  margin-bottom: 5px;
}

.glass p.price {
  font-weight: bold;
}

/* Additional styling for the container */

.Dashboard {
  width: 300px;
  padding: 20px;
  margin: 10px;
  background-color: white;
}

.second-main-product{
  position: relative;
  font-family: "Poppins", sans-serif;

  /* background-image: url(images/bgpattern.png);
  background-repeat: no-repeat;
  background-size: cover; */
  /* border: 2px solid black; */
  display: flex;
  align-items: center;
  justify-content: center;
 
  flex-direction: column;
 
}

.glass {
  
  
  background-color: white;
display: flex;
flex-direction: column;
align-items: center;
text-align: center;
margin: 20px;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

function deleteProduct(product_id) {
    if (confirm("Are you sure you want to delete this product?")) {
      // Redirect to delete.php passing the product_id
      window.location.href = "function.php?image_id=" + product_id;
    }
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
                    
                   
                    <li><a href="AddDayCareDetails.php">Add Day Care Details</a></li>
                    <li><a href="addimage.php">Add Image</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    
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



<main>
	
	<section class="glass">
		<div class="Dashboard">
			<center>
				<h1 style="margin-bottom: 30px;  ">Add Image</h1>
			</center>
            <div class="split-screen-container">
          <div class="form-section">
            <form class="modern-form" action="function.php" method="POST" enctype="multipart/form-data">
              <!-- Rest of your form inputs -->
              <input type="hidden" name="shopId" value="<?php echo $shopId; ?>"><br>
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"><br>
             
              <div class="form-group">
              <label for="image">Image:</label>
            <input type="file" id="image" name="file" accept="image/*" onchange="previewImage(event)" required>
              </div>
              <div class="form-group full-width">
                <button type="submit" name="submit_img" class="btn-submit">Upload</button>
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



<main class="second-main-product">
  <div class="card">
    <h2>Gallery Preview</h2>
  </div>

  <div class="product-container">
    <?php
    include 'connect.php';

    // Retrieve the shop_id from the session
    @$shopId = $_SESSION["user_id"];

    // Fetch products from the database based on the shop_id
    $query = "SELECT * FROM gallery WHERE user_id = '$user_id'";
    $result = @mysqli_query($conn, $query); // Apply error suppression with @

    // Variable to track if any images were displayed
    $imageDisplayed = false;

    // Loop over the products and generate HTML
    while ($product = mysqli_fetch_assoc($result)) {
      $product_id = $product['image_id']; // Fetch the product ID
      $image = 'uploads/' . $product['images'];

      // Check if the image file exists
      if (file_exists($image)) {
        $imageDisplayed = true;
        ?>
        <section class="glass">
          <div class="Dashboard">
            <img src="<?php echo $image; ?>" alt="" />
            <p></p>
            <p></p>
            <button class="delete-button" onclick="deleteProduct(<?php echo $product['image_id']; ?>)">Delete</button>
          </div>
        </section>
        <?php
      }
    }

    // Check if any images were displayed
    if (!$imageDisplayed) {
      ?>
      <section class="glass">
        <div class="Dashboard">
          <p>No images available.</p>
        </div>
      </section>
      <?php
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </div>
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