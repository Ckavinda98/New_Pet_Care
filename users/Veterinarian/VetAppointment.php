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

// Function to display appointment data in a table with an Action column
function displayAppointments($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
            <tr>
              <th>ID</th>
              <th>Pet Owner Name</th>
              <th>Veterinarian Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>';

    while ($appointment = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $appointment["appointment_id"] . '</td>';
      echo '<td>' . $appointment["pet_owner_name"] . '</td>';
      echo '<td>' . $appointment["vet_name"] . '</td>';
      echo '<td><input type="date" id="date_' . $appointment["appointment_id"] . '" value="' . $appointment["appointment_date"] . '"></td>';
      echo '<td><input type="time" id="time_' . $appointment["appointment_id"] . '" value="' . $appointment["appointment_time"] . '"></td>';
      echo '<td>' . $appointment["status"] . '</td>';
      echo '<td>';
      
      // Display different buttons based on the status
      if ($appointment["status"] == "pending") {
        echo '<button class="green-button" onclick="updateStatus(' . $appointment["appointment_id"] . ', \'accepted\')">Accept</button>';
      } elseif ($appointment["status"] == "accepted") {
        echo '<button class="red-button" onclick="updateStatus(' . $appointment["appointment_id"] . ', \'pending\')">Revert</button>';
      }
      
      echo '<button class="green-button" onclick="updateDate(' . $appointment["appointment_id"] . ')">Update Date</button>';
      echo '<button class="green-button" onclick="updateTime(' . $appointment["appointment_id"] . ')">Update Time</button>';
      echo '</td>';
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
  background-color: white; /* Set a light background color for the body section */
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





.green-button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

/* Red button */
.red-button {
  background-color: #f44336;
  color: white;
  padding: 10px 20px;
  border: none;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

	</style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
  function updateStatus(appointmentId, newStatus) {
    // Send an AJAX request to update the appointment status
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {
        if (this.status == 200) {
          // Success message
          alert("Appointment status updated.");
          window.location.reload(true);
        } else {
          // Error message
          alert("Appointment status update failed.");
          window.location.reload(true);
        }
      }
    };
    xhttp.open("POST", "update_status.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("appointment_id=" + appointmentId + "&status=" + newStatus);
  }

  function updateDate(appointmentId) {
  var newDate = document.getElementById('date_' + appointmentId).value;

  // Send an AJAX request to update the Prescription Date
  $.ajax({
    type: "POST",
    url: "update_date.php",
    data: {
      appointment_id: appointmentId,
      date: newDate
    },
    success: function(response) {
      // Success message
      alert("Appointment Date updated.");
      window.location.reload(true);
    },
    error: function() {
      // Error message
      alert("Appointment Date update failed.");
      window.location.reload(true);
    }
  });
}

function updateTime(appointmentId) {
  var newTime = document.getElementById('time_' + appointmentId).value;

  // Send an AJAX request to update the Prescription Time
  $.ajax({
    type: "POST",
    url: "update_time.php",
    data: {
      appointment_id: appointmentId,
      time: newTime
    },
    success: function(response) {
      // Success message
      alert("Appointment Time updated.");
      window.location.reload(true);
    },
    error: function() {
      // Error message
      alert("Appointment Time update failed.");
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
                    <li><a href="AddVeterinarianDetails.php">Veterinarian Details</a></li>
                   
                    <li><a href="VetAppointment.php">Appointments</a></li>
                    
                    
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