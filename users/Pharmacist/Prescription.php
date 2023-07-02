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
$query = "SELECT * FROM prescriptions WHERE pham_user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Function to display appointment data in a table
function displayPrescriptions($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
            <tr>
              <th>Prescription ID</th>
              <th>Pet Owner Name</th>
              <th>Prescription Date</th>
              <th>Prescription Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>';

    while ($appointment = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $appointment["prescription_id"] . '</td>';
      echo '<td>' . $appointment["pet_owner_name"] . '</td>';

      // Display the Prescription Date input field
      echo '<td><input type="date" id="date_' . $appointment["prescription_id"] . '" value="' . $appointment["prescription_date"] . '"></td>';

      // Display the Prescription Time input field
      echo '<td><input type="time" id="time_' . $appointment["prescription_id"] . '" value="' . $appointment["prescription_time"] . '"></td>';

      echo '<td>' . $appointment["status"] . '</td>';
      echo '<td>';

      // Display different buttons based on the status
      if ($appointment["status"] == "pending") {
        echo '<button class="green-button" onclick="updateStatus(' . $appointment["prescription_id"] . ', \'accepted\')">Accept</button>';
      } elseif ($appointment["status"] == "accepted") {
        echo '<button class="red-button" onclick="updateStatus(' . $appointment["prescription_id"] . ', \'pending\')">Undo</button>';
      }

      // Add separate buttons to update Prescription Date and Prescription Time
      echo '<button class="green-button" onclick="updateDate(' . $appointment["prescription_id"] . ')">Update Date</button>';
      echo '<button class="green-button" onclick="updateTime(' . $appointment["prescription_id"] . ')">Update Time</button>';

      echo '</td>';

      echo '</tr>';
    }

    echo '</table>';
  } else {
    echo 'No prescriptions found for the logged user.';
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




	</style>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateStatus(prescriptionId, newStatus) {
    // Send an AJAX request to update the prescription status
    $.ajax({
      type: "POST",
      url: "update_status.php",
      data: {
        prescription_id: prescriptionId,
        status: newStatus
      },
      success: function(response) {
        // Success message
        alert("Prescription status updated.");
        window.location.reload(true);
      },
      error: function() {
        // Error message
        alert("Prescription status update failed.");
        window.location.reload(true);
      }
    });
  }


  function updateDate(prescriptionId) {
  var newDate = document.getElementById('date_' + prescriptionId).value;

  // Send an AJAX request to update the Prescription Date
  $.ajax({
    type: "POST",
    url: "update_date.php",
    data: {
      prescription_id: prescriptionId,
      date: newDate
    },
    success: function(response) {
      // Success message
      alert("Prescription Date updated.");
      window.location.reload(true);
    },
    error: function() {
      // Error message
      alert("Prescription Date update failed.");
      window.location.reload(true);
    }
  });
}

function updateTime(prescriptionId) {
  var newTime = document.getElementById('time_' + prescriptionId).value;

  // Send an AJAX request to update the Prescription Time
  $.ajax({
    type: "POST",
    url: "update_time.php",
    data: {
      prescription_id: prescriptionId,
      time: newTime
    },
    success: function(response) {
      // Success message
      alert("Prescription Time updated.");
      window.location.reload(true);
    },
    error: function() {
      // Error message
      alert("Prescription Time update failed.");
      window.location.reload(true);
    }
  });
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
                    <li><a href="AddPharmacyDetails.php">Add Pharmacy</a></li>
                   
                    <li><a href="Prescription.php"> Prescription</a></li>
                    
                    
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
        <h1 style="margin-bottom: 30px;">My Prescription</h1>
      </center>
      <?php displayPrescriptions($result); ?>
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