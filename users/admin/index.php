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

  public function GetUserDetails() {
    global $conn;
    // Retrieve the user details based on the stored user_id
    $userId = $_SESSION["user_id"];
    // Run the query to fetch user details
    $userQuery = "SELECT * FROM user WHERE user_id = '$userId'";
    $userResult = mysqli_query($conn, $userQuery);
    $user = mysqli_fetch_assoc($userResult);

    // Return the user details
    return $user;
  }

 

}

// Fetch user counts based on user_type
$query = "SELECT user_type, COUNT(*) AS user_count FROM user GROUP BY user_type";
$result = mysqli_query($conn, $query);

// Store user types and counts in arrays
$userTypes = array();
$userCounts = array();
while ($row = mysqli_fetch_assoc($result)) {
  $userTypes[] = $row['user_type'];
  $userCounts[] = $row['user_count'];
}


// Fetch the count of accepted appointments
$queryAcceptedAppointments = "SELECT COUNT(*) AS acceptedCount FROM appointments WHERE status = 'accepted'";
$resultAcceptedAppointments = mysqli_query($conn, $queryAcceptedAppointments);
$rowAcceptedAppointments = mysqli_fetch_assoc($resultAcceptedAppointments);
$acceptedCountAppointments = $rowAcceptedAppointments['acceptedCount'];

// Fetch the count of rejected appointments
$queryRejectedAppointments = "SELECT COUNT(*) AS rejectedCount FROM appointments WHERE status = 'pending'";
$resultRejectedAppointments = mysqli_query($conn, $queryRejectedAppointments);
$rowRejectedAppointments = mysqli_fetch_assoc($resultRejectedAppointments);
$rejectedCountAppointments = $rowRejectedAppointments['rejectedCount'];

// Fetch the count of accepted prescriptions
$queryAcceptedPrescriptions = "SELECT COUNT(*) AS acceptedCount FROM prescriptions WHERE status = 'accepted'";
$resultAcceptedPrescriptions = mysqli_query($conn, $queryAcceptedPrescriptions);
$rowAcceptedPrescriptions = mysqli_fetch_assoc($resultAcceptedPrescriptions);
$acceptedCountPrescriptions = $rowAcceptedPrescriptions['acceptedCount'];

// Fetch the count of rejected prescriptions
$queryRejectedPrescriptions = "SELECT COUNT(*) AS rejectedCount FROM prescriptions WHERE status = 'pending'";
$resultRejectedPrescriptions = mysqli_query($conn, $queryRejectedPrescriptions);
$rowRejectedPrescriptions = mysqli_fetch_assoc($resultRejectedPrescriptions);
$rejectedCountPrescriptions = $rowRejectedPrescriptions['rejectedCount'];


// Create an instance of the Login class
$login = new Login();

// Call the SessionCheck method to retrieve and store user_id and business_id
$login->SessionCheck();

// Call the GetUserDetails method to display the user details
$login->GetUserDetails();


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 

	<style>

body {
  background-color: #f8f8f8;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

    /* Main container styles */
.second-main {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  align-items: center;
  padding: 20px;
  
  
}

/* Glass styles */
.glass-3,
.glass-4,
 {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  text-align: center;
}

.glass-5{}

/* Dashboard styles */
.Dashboard {
  color: #333;
}

/* Heading styles */
.Dashboard h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

/* User details styles */
.glass-3 p {
  margin-bottom: 10px;
}

/* Business details styles */
.glass-4 p {
  margin-bottom: 10px;
}

/* Price styles */
.price {
  font-weight: bold;
}

/* Additional styles */
/* .container {
  max-width: 1200px;
  margin: 0 auto;
} */

    
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

  align-items: center;
  text-align: center;
  margin: 20px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.glass-userchart {
  
  
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
.glass-pie-chart{
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

.glass-user-dash{
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
  width: 100%;
  padding: 20px;
  margin: 10px;
  background-color: white;
}

.price {
  font-weight: bold;
  color: red;
}


#userChart {
    display: block;
    width: 100%;
    height: 400px;
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
<main class="second-main">
<section class="glass-user-dash"> 
  <div class="card">
    <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
  </div>

  <section class="glass-3">
    <div class="Dashboard">
      <!-- Display the user details here -->
      <?php
      // Call the GetUserDetails method only if the user is logged in
      if (isset($_SESSION['login'])) {
        $user = $login->GetUserDetails();
        // Display the user details
        echo "Username: " . $user["username"] . "<br>";
        echo "User Type: " . $user["user_type"] . "<br>";
        // Add any additional user details you want to display
      }
      ?>
    </div>
 
  </section>

 

  

</main>


<main class="second-main">
  
<section class="glass"> 

  <section class="glass-pie-chart">
  <div class="card">
    <h2>Appointments Status</h2>
  </div>
    <div class="Dashboard">
      <canvas id="appointmentChart"></canvas>
    </div>
  </section>

  <section class="glass-pie-chart">
  <div class="card">
    <h2>Prescriptions Status</h2>
  </div>
    <div class="Dashboard">
      <canvas id="prescriptionChart"></canvas>
    </div>
  </section>
  
</main>

<script>
  // JavaScript code for creating the appointment chart
  var acceptedCountAppointments = <?php echo $acceptedCountAppointments; ?>;
  var rejectedCountAppointments = <?php echo $rejectedCountAppointments; ?>;

  // Create the appointment bar chart
  var ctx1 = document.getElementById('appointmentChart').getContext('2d');
  var appointmentChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: ['Accepted', 'Pending'],
      datasets: [{
        label: 'Appointment Count',
        data: [acceptedCountAppointments, rejectedCountAppointments],
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',  // Blue for Accepted
          'rgba(255, 99, 132, 0.7)'   // Red for Rejected
        ],
      }]
    },
    options: {
        responsive: true,
        legend: {
          display: true,
          position: 'bottom'
        }
      }
  });

  // JavaScript code for creating the prescription chart
  var acceptedCountPrescriptions = <?php echo $acceptedCountPrescriptions; ?>;
  var rejectedCountPrescriptions = <?php echo $rejectedCountPrescriptions; ?>;

  // Create the prescription bar chart
  var ctx2 = document.getElementById('prescriptionChart').getContext('2d');
  var prescriptionChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Accepted', 'Pending'],
      datasets: [{
        label: 'Prescription Count',
        data: [acceptedCountPrescriptions, rejectedCountPrescriptions],
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',  // Blue for Accepted
          'rgba(255, 99, 132, 0.7)'   // Red for Rejected
        ],
      }]
    },
    options: {
        responsive: true,
        legend: {
          display: true,
          position: 'bottom'
        }
      }
    });
</script>
</section>
</main>

<main class="second-main">

<section class="glass-userchart">
<div class="card">
    <h2>User Status</h2>
  </div>
    <div class="Dashboard">
      
      <canvas id="userChart"></canvas>
    </div>
  </section>

  <script>
    // Get the user types and counts from PHP
    var userTypes = <?php echo json_encode($userTypes); ?>;
    var userCounts = <?php echo json_encode($userCounts); ?>;

    // Create the pie chart
    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: userTypes,
        datasets: [{
          data: userCounts,
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',   // Red
            'rgba(54, 162, 235, 0.7)',    // Blue
            'rgba(255, 206, 86, 0.7)',    // Yellow
            'rgba(75, 192, 192, 0.7)',    // Teal
            'rgba(153, 102, 255, 0.7)',   // Purple
            'rgba(255, 159, 64, 0.7)',    // Orange
            'rgba(0, 204, 102, 0.7)',     // Green
            'rgba(255, 0, 255, 0.7)'      // Magenta
          ],
        }]
      },

      options: {
        responsive: true,
        legend: {
          display: true,
          position: 'bottom'
        }
      }
    });
  </script>

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