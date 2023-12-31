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

// Create an instance of the Login class
$login = new Login();

// Call the SessionCheck method to retrieve and store user_id and business_id
$login->SessionCheck();

// Get the user_id from the session
$user_id = $_SESSION["user_id"];

// Fetch appointment data for the logged user
$query = "SELECT * FROM prescriptions WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Function to display appointment data in a table
function displayAppointments($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
            <tr>
              <th>Prescriptions ID</th>
              <th>Pharmacy Name</th>
              <th>Alocated Date</th>
              <th>Alocated Time</th>
              <th>Status</th>
            </tr>';

    while ($appointment = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $appointment["prescription_id"] . '</td>';
      echo '<td>' . $appointment["pharmacist_name"] . '</td>';
      echo '<td>' . $appointment["prescription_date"] . '</td>';
      echo '<td>' . $appointment["prescription_time"] . '</td>';

      $status = $appointment["status"];
      $statusColor = '';

      // Set the color based on the status value
      if ($status == 'pending') {
        $statusColor = 'blue';
      } elseif ($status == 'accepted') {
        $statusColor = 'green';
      }

      echo '<td style="color: ' . $statusColor . ';">' . $status . '</td>';
      echo '</tr>';
    }

    echo '</table>';
  } else {
    echo 'No appointments found for the logged user.';
  }
}


// Close the database connection
mysqli_close($conn);
?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Prescription</title>
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
.glass-6{
  margin-top: 50px;
  margin-bottom: 50px;
  
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


.glass{
  
  margin: 50px;
  /* background: white; */
  min-height: 80vh;
  width: 80%;
  background-color: #ffffff; /* Set a light background color for the body section */
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

/* Styles for the modern form */
.modern-form {
  max-width: 600px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
}

.modern-form .form-group {
  width: calc(50% - 10px);
  margin-bottom: 20px;
  margin-right: 10px; /* Add margin-right for the gap */
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
.modern-form textarea {
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
}

table {
    border-collapse: collapse;
    width: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  th {
    background-color: purple;
    color: white;
    font-weight: bold;
    padding: 12px;
    text-align: left;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  td {
    padding: 8px;
  }

  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

	</style>

</head>
<script>
document.addEventListener("click", function (e) {
    const dropdowns = document.querySelectorAll(".navbar .dropdown");
    for (const dropdown of dropdowns) {
        if (!dropdown.contains(e.target)) {
            const content = dropdown.querySelector(".dropdown-content");
            content.style.display = "none";
        }
    }
});

// Prevent the dropdown from closing when clicking on it
document.querySelectorAll(".navbar .dropdown-content").forEach(function (content) {
    content.addEventListener("click", function (e) {
        e.stopPropagation();
    });
});
</script>
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
        <li class="dropdown">
            <a href="#">All Service</a>
            <ul class="dropdown-content">
                <li><a href="petcare.php">Pet Care</a></li>
                <li><a href="pharmacy.php">Pharmacy</a></li>
                <li><a href="groomingshop.php">Pet Grooming Shop</a></li>
                <li><a href="vetservice.php">Vet Service</a></li>
            </ul>
        </li>
        <li><a href="products.php">Products</a></li>
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



<main>
	
	<section class="glass">
		<div class="Dashboard">
			<center>
				<h1 style="margin-bottom: 30px;  ">My Prescription</h1>
			</center>
            <?php
    include 'function.php';
    displayAppointments($result);
  ?>




     
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