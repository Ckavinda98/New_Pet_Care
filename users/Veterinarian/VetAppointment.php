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
$query = "SELECT * FROM appointments WHERE vet_user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Function to display appointment data in a table
function displayAppointments($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
            <tr>
              <th>Appointment ID</th>
              <th>Pet Owner Name</th>
              <th>Veterinarian Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>
            </tr>';

    while ($appointment = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $appointment["appointment_id"] . '</td>';
      echo '<td>' . $appointment["pet_owner_name"] . '</td>';
      echo '<td>' . $appointment["vet_name"] . '</td>';
      echo '<td>' . $appointment["appointment_date"] . '</td>';
      echo '<td>' . $appointment["appointment_time"] . '</td>';
      echo '<td>' . $appointment["status"] . '</td>';
      echo '</tr>';
    }

    echo '</table>';
  } else {
    echo 'No appointments found for the logged user.';
  }
}

// Display the appointment data
// displayAppointments($result);

// Close the database connection
mysqli_close($conn);
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



.table-container {
      background-color: white;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: purple;
      color: white;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
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
                    <li><a href="AddVeterinarianDetails.php">Veterinarian Details</a></li>
                   
                    <li><a href="VetAppointment.php">Appoimnets</a></li>
                    
                    
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
        <h1 style="margin-bottom: 30px;">My Appointments</h1>
      </center>
      <?php displayAppointments($result); ?>
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