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
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);

// Function to display appointment data in a table
function displayUser($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
            <tr>
              <th>User ID</th>
              <th>User Name</th>
              <th>Email</th>
              <th>User Type</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>';

    while ($appointment = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $appointment["user_id"] . '</td>';
      echo '<td><input type="text" name="username" value="' . $appointment["username"] . '"></td>';
      echo '<td><input type="email" name="email" value="' . $appointment["email"] . '"></td>';
      echo '<td>
              <select name="user_type">
                <option value="admin" ' . ($appointment["user_type"] === "admin" ? "selected" : "") . '>Admin</option>
                <option value="Pet Owner" ' . ($appointment["user_type"] === "Pet Owner" ? "selected" : "") . '>Pet Owner</option>
                <option value="Pet Shop" ' . ($appointment["user_type"] === "Pet Shop" ? "selected" : "") . '>Pet Shop</option>
                <option value="Veterinarian" ' . ($appointment["user_type"] === "Veterinarian" ? "selected" : "") . '>Veterinarian</option>
                <option value="Pharmacistr" ' . ($appointment["user_type"] === "Pharmacist" ? "selected" : "") . '>Pharmacist</option>
                <option value="Pet Grooming" ' . ($appointment["user_type"] === "Pet Owner" ? "selected" : "") . '>Pet Grooming</option>
                <option value="Pet DayCare" ' . ($appointment["user_type"] === "Pet DayCare" ? "selected" : "") . '>Pet Day Care</option>
                <option value="Serivce Provider" ' . ($appointment["user_type"] === "Serivce Provider" ? "selected" : "") . '>Serivce Provider</option>
              </select>
            </td>';
      

      
      
      echo '<td>';
echo '<button class="edit-button" onclick="location.href=\'UpdateUser.php?user_id=' . $appointment["user_id"] . '&username=' . $appointment["username"] . '&email=' . $appointment["email"] . '&user_type=' . $appointment["user_type"] . '\'">Edit</button>';
echo '</td>';
      echo '<td><button class="delete-button" onclick="deleteAppointment(' . $appointment["user_id"] . ')">Delete</button></td>';
      
      
      
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
    /* Green button */
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


	</style>
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

  // Add this code to your JavaScript section

// Function to delete an appointment
function deleteAppointment(appointmentId) {
  // You can perform an AJAX request here to call a PHP function to delete the appointment
  // Alternatively, you can redirect the user to a PHP file that handles the deletion

  // Example AJAX request using jQuery:
  $.ajax({
    url: 'delete_appointment.php', // Replace with your PHP file that handles deletion
    type: 'POST',
    data: { appointment_id: appointmentId },
    success: function(response) {
      // Handle the response from the server after deletion
      console.log(response);
      // Refresh the table or perform any other necessary actions
      // For example, you can reload the page to update the table
      location.reload();
    },
    error: function(xhr, status, error) {
      console.error(error);
      // Handle the error case if the deletion request fails
    }
  });
}

// Function to update the status of an appointment
function updateStatus(appointmentId, newStatus) {
  // You can perform an AJAX request here to call a PHP function to update the status
  // Alternatively, you can redirect the user to a PHP file that handles the status update

  // Example AJAX request using jQuery:
  $.ajax({
    url: 'update_status.php', // Replace with your PHP file that handles status update
    type: 'POST',
    data: { appointment_id: appointmentId, status: newStatus },
    success: function(response) {
      // Handle the response from the server after status update
      console.log(response);
      // Refresh the table or perform any other necessary actions
      // For example, you can reload the page to update the table
      location.reload();
    },
    error: function(xhr, status, error) {
      console.error(error);
      // Handle the error case if the status update request fails
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
                    
                   
                    <li><a href="allAoppiment.php">Recordes Tabels</a></li>
                    <li><a href="usertable.php">User Tabels</a></li>
                    
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
    <div class="card">
    <h2>User Table</h2>
  </div>
      <?php displayUser($result); ?>
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