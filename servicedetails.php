<?php
include 'connect.php';

// Check if the groomer_id or vet_id is provided in the URL
if (isset($_GET['groomer_id'])) {
  $serviceType = 'groomer';
  $serviceId = $_GET['groomer_id'];
} elseif (isset($_GET['vet_id'])) {
  $serviceType = 'vet';
  $serviceId = $_GET['vet_id'];
} elseif (isset($_GET['pharmacist_id'])) {
  $serviceType = 'pharmacist';
  $serviceId = $_GET['pharmacist_id'];
} 
elseif (isset($_GET['day_care_id'])) {
  $serviceType = 'day_care';
  $serviceId = $_GET['day_care_id'];
} 
elseif (isset($_GET['shop_id'])) {
  $serviceType = 'shop';
  $serviceId = $_GET['shop_id'];
} else {
  echo "Service ID not provided.";
  exit();
}

// Define the table and column names based on the service type
$tableName = '';
$nameColumn = '';
$image = '';
switch ($serviceType) {
  case 'groomer':
    $tableName = 'pet_groomer';
    $nameColumn = 'groomer_name';
    $image = 'images/groomer1.png';
    break;
  case 'vet':
    $tableName = 'veterinarian';
    $nameColumn = 'vet_name';
    $image = 'images/vet2.png';
    break;
  case 'pharmacist':
      $tableName = 'pharmacist';
      $nameColumn = 'pharmacist_name';
      $image = 'images/vet3.png';
      break; 
  case 'day_care':
        $tableName = 'pet_day_care';
        $nameColumn = 'day_care_name';
        $image = 'images/daycare.png';
        break; 
        case 'shop':
          $tableName = 'pet_shop';
          $nameColumn = 'shop_name';
          $image = 'images/shop.png';
          break; 
  default:
    echo "Invalid service type.";
    exit();
}

// Retrieve the service details from the database
$query = "SELECT * FROM $tableName WHERE {$serviceType}_id = '$serviceId'";
$result = mysqli_query($conn, $query);

// Check if the service exists
if (mysqli_num_rows($result) > 0) {
  $service = mysqli_fetch_assoc($result);

  // Retrieve the service details
  $name = $service[$nameColumn];
  $address = $service['address'];
  $city = $service['city'];
  $contact = $service['contact_number'];
  $email = $service['email'];
  $website = $service['website'];
  $description = $service['description'];
  $longitude = $service['longitude'];
  $latitude = $service['latitude'];
  $Opening_time = $service['opening_time'];
  $Closing_time = $service['closing_time'];

  // Close the database connection
  mysqli_close($conn);
} else {
  echo "Service not found.";
  exit();
}
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

.product-container {
  display: flex;
  flex-wrap: wrap;
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
  align-items: right;
  text-align: center;
  margin: 20px;
  
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.glass img {
  width: 400px;
  height: 400px;
  object-fit: cover;
  margin-right: 200px;
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
                    <li><a href="register.php">Sign up</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
        </div>
    </div>
</header>



<main>
	
	<section class="glass">
		<div class="Dashboard">
       


    <main class="service-details">
  <div class="service-details-image">
    <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
  </div>
  <div class="service-details-container">
    <div class="card">
      <h2><?php echo $name; ?></h2>
    </div>
    <div class="service-details-container">
      <div class="service-details-item">
        <h3>Address:</h3>
        <p><?php echo $address; ?></p>
      </div>
      <div class="service-details-item">
        <h3>City:</h3>
        <p><?php echo $city; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Contact:</h3>
        <p><?php echo $contact; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Email:</h3>
        <p><?php echo $email; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Website:</h3>
        <p><?php echo $website; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Description:</h3>
        <p><?php echo $description; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Available Time:</h3>
        <p><?php echo $Opening_time; ?></p>
        <p><?php echo $Closing_time; ?></p>
      </div>
      <div class="service-details-item">
        <h3>Location:</h3>
        <div id="map"></div>
        <button class="map-button" onclick="openLocation(<?php echo $latitude; ?>, <?php echo $longitude; ?>)">Location</button>
      </div>
    </div>
  </div>
</main>
    

</script>

<!-- Include the Google Maps API script -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>


<script>
  // Open the location in Google Maps
  function openLocation(latitude, longitude) {
    var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
    window.open(url, "_blank");
  }

  // Initialize and display the map with the provided longitude and latitude
  function initMap() {
    var location = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12,
      center: location,
    });
    var marker = new google.maps.Marker({
      position: location,
      map: map,
    });
  }
</script>












     
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
    <a href="https://www.facebook.com"><img src="images/FB.png" width="40px" height="40px" alt=""></a>
<a href="https://www.twitter.com"><img src="images/TW.png" width="40px" height="40px" alt=""></a>
<a href="https://www.instagram.com"><img src="images/IG.png" width="40px" height="40px" alt=""></a>
<a href="https://www.linkedin.com"><img src="images/LK.png" width="40px" height="40px" alt=""></a>
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