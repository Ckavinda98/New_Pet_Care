
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>

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
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  text-align: center;
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
  align-items: center;
  text-align: center;
  margin: 20px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.glass img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
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

.price {
  font-weight: bold;
  color: red;
}

.btn-submit {
  display: inline-block;
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #45a049;
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
                    <li><a href="Allservice.php">All Service</a></li>
                    <li><a href="MyAppointments.php">My Appointments</a></li>
                   
                    <li><a href="MyPrescription.php">My Prescription</a></li>
                    
                
                    
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



<main class="second-main-product">
  <div class="card">
    <h2>All Veterinarian Service</h2>
  </div>

  <div class="product-container">
    <?php
    include 'connect.php';
    // Assuming you have a database connection $conn established

    // Fetch products from the database
    $query = "SELECT * FROM veterinarian";
    $result = mysqli_query($conn, $query);

    // Loop over the products and generate HTML
    while ($product = mysqli_fetch_assoc($result)) {
      $name = $product['vet_name'];
      $address = $product['address'];
      $city = $product['city'];
      $contact = $product['contact_number'];
      $email = $product['email'];
      $website = $product['website'];
      $description = $product['description'];

      ?>
      <section class="glass">
        <div class="Dashboard">
          <h2><?php echo $name; ?></h2>
          <img src="images/vet2.png" alt="<?php echo $name; ?>" />
          <p><?php echo $address; ?></p>
          <p><?php echo $city; ?></p>
          <p><?php echo $contact; ?></p>
          <p><?php echo $email; ?></p>
          <p><?php echo $website; ?></p>
          <p><?php echo $description; ?></p>
          <a href="Addapoitmnet.php?vet_id=<?php echo $product['vet_id']; ?>&vet_name=<?php echo $product['vet_name']; ?>" class="btn-submit">Make Appointment</a>

        </div>
      </section>
      <?php
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </div>
</main>




<main class="second-main-product">
  <div class="card">
    <h2>All Pharmacy Services</h2>
  </div>

  <div class="product-container">
  <?php
    include 'connect.php';
    // Assuming you have a database connection $conn established

    // Fetch products from the database
    $query = "SELECT * FROM pharmacist";
    $result = mysqli_query($conn, $query);

    // Loop over the products and generate HTML
    while ($product = mysqli_fetch_assoc($result)) {
      $name = $product['pharmacist_name'];
      $address = $product['address'];
      $city = $product['city'];
      $contact = $product['contact_number'];
      $email = $product['email'];
      $website = $product['website'];
      $description = $product['description'];

      ?>
      <section class="glass">
        <div class="Dashboard">
          <h2><?php echo $name; ?></h2>
          <img src="images/vet3.png" alt="<?php echo $name; ?>" />
          <p><?php echo $address; ?></p>
          <p><?php echo $city; ?></p>
          <p><?php echo $contact; ?></p>
          <p><?php echo $email; ?></p>
          <p><?php echo $website; ?></p>
          <p><?php echo $description; ?></p>
          <a href="Addprescription.php?pharmacist_id=<?php echo $product['pharmacist_id']; ?>&pharmacist_name=<?php echo $product['pharmacist_name']; ?>" class="btn-submit">Send Prescription</a>
        </div>
      </section>
      <?php
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </div>
</main>


<main class="second-main-product">
  <div class="card">
    <h2>All Grooming Services</h2>
  </div>

  <div class="product-container">
  <?php
    include 'connect.php';
    // Assuming you have a database connection $conn established

    // Fetch products from the database
    $query = "SELECT * FROM pharmacist";
    $result = mysqli_query($conn, $query);

    // Loop over the products and generate HTML
    while ($product = mysqli_fetch_assoc($result)) {
      $name = $product['pharmacist_name'];
      $address = $product['address'];
      $city = $product['city'];
      $contact = $product['contact_number'];
      $email = $product['email'];
      $website = $product['website'];
      $description = $product['description'];

      ?>
      <section class="glass">
        <div class="Dashboard">
          <h2><?php echo $name; ?></h2>
          <img src="images/vet3.png" alt="<?php echo $name; ?>" />
          <p><?php echo $address; ?></p>
          <p><?php echo $city; ?></p>
          <p><?php echo $contact; ?></p>
          <p><?php echo $email; ?></p>
          <p><?php echo $website; ?></p>
          <p><?php echo $description; ?></p>
          <a href="Addprescription.php?pharmacist_id=<?php echo $product['pharmacist_id']; ?>&pharmacist_name=<?php echo $product['pharmacist_name']; ?>" class="btn-submit">Send Prescription</a>
        </div>
      </section>
      <?php
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </div>
</main>

<main class="second-main-product">
  <div class="card">
    <h2>All Grooming Services</h2>
  </div>

  <div class="product-container">
  <?php
    include 'connect.php';
    // Assuming you have a database connection $conn established

    // Fetch products from the database
    $query = "SELECT * FROM pharmacist";
    $result = mysqli_query($conn, $query);

    // Loop over the products and generate HTML
    while ($product = mysqli_fetch_assoc($result)) {
      $name = $product['pharmacist_name'];
      $address = $product['address'];
      $city = $product['city'];
      $contact = $product['contact_number'];
      $email = $product['email'];
      $website = $product['website'];
      $description = $product['description'];

      ?>
      <section class="glass">
        <div class="Dashboard">
          <h2><?php echo $name; ?></h2>
          <img src="images/vet3.png" alt="<?php echo $name; ?>" />
          <p><?php echo $address; ?></p>
          <p><?php echo $city; ?></p>
          <p><?php echo $contact; ?></p>
          <p><?php echo $email; ?></p>
          <p><?php echo $website; ?></p>
          <p><?php echo $description; ?></p>
          <a href="Addprescription.php?pharmacist_id=<?php echo $product['pharmacist_id']; ?>&pharmacist_name=<?php echo $product['pharmacist_name']; ?>" class="btn-submit">Send Prescription</a>
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