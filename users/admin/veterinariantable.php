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



// Fetch user data for the logged user
$query = "SELECT * FROM veterinarian";
$result = mysqli_query($conn, $query);

// Function to display user data in a table
function displayUser($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
    <tr>
    <th>User ID</th>
   
      <th>Veterinarian Name</th>
      <th>Address</th>
      <th>City</th>
      <th>Postal Code</th>
      <th>Contact Number</th>
      <th>Email</th>
      <th>Website</th>
      <th>Description</th>
      <th>Lattitude</th>
      <th>Longitude</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>';

    while ($user = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $user["vet_id"] . '</td>';
      
      echo '<td><input type="text" name="username[' . $user["user_id"] . ']" value="' . $user["vet_name"] . '"></td>';
      echo '<td><input type="text" name="address[' . $user["user_id"] . ']" value="' . $user["address"] . '"></td>';
      echo '<td><input type="text" name="city[' . $user["user_id"] . ']" value="' . $user["city"] . '"></td>';
      echo '<td><input type="text" name="postal_code[' . $user["user_id"] . ']" value="' . $user["postal_code"] . '"></td>';
      echo '<td><input type="text" name="contact_number[' . $user["user_id"] . ']" value="' . $user["contact_number"] . '"></td>';
      echo '<td><input type="email" name="email[' . $user["user_id"] . ']" value="' . $user["email"] . '"></td>';
      echo '<td><input type="text" name="website[' . $user["user_id"] . ']" value="' . $user["website"] . '"></td>';
      echo '<td><input type="text" name="description[' . $user["user_id"] . ']" value="' . $user["description"] . '"></td>';
      echo '<td><input type="text" name="latitude[' . $user["user_id"] . ']" value="' . $user["latitude"] . '"></td>';
      echo '<td><input type="text" name="longitude[' . $user["user_id"] . ']" value="' . $user["longitude"] . '"></td>';

      echo '<td>';
      echo '<button class="edit-button" onclick="updateUser(' . $user["user_id"] . ')">Edit</button>';
      echo '</td>';
    
      echo '<td>';
      // echo '<form action="delete_user.php" method="post">';
      
      echo '<button class="delete-button" onclick="deleteUser(' . $user["user_id"] . ')">Delete</button>';
      echo '</form>';
      echo '</td>';
    
      echo '</tr>';
    }
    

echo '</table>';



  } else {
    echo 'No users found.';
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
 .glass-for-button-list{
  margin: 50px;
  /* background: white; */
  min-height: 10vh;
  width: 80%;
  background-color: white; /* Set a light background color for the body section */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4); /* Increased box shadow with larger values */
  border-radius: 0.5rem;
  z-index: 2;
  /* backdrop-filter: blur(2rem); */
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
 }	

.glass{
  
  margin: 50px;
  /* background: white; */
  min-height: 80vh;
  width: 100%;
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
      font-size: 10px;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      font-size: 10px;

    }

    th {
      background-color: purple;
      color: white;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
      font-size: 10px;
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

/* new input styles */

input[type="text"],
input[type="email"],
select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 100%;
  font-size: 10px;
  margin-bottom: 10px;
}

select {
  height: 38px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #45a049;
}


	</style>
<script>
 

 function updateUser(userId) {
  console.log('updateUser function called with userId:', userId);
  var username = document.getElementsByName('username[' + userId + ']')[0].value;
  var email = document.getElementsByName('email[' + userId + ']')[0].value;
  var address = document.getElementsByName('address[' + userId + ']')[0].value;
  var city = document.getElementsByName('city[' + userId + ']')[0].value;
  var postalCode = document.getElementsByName('postal_code[' + userId + ']')[0].value;
  var contactNumber = document.getElementsByName('contact_number[' + userId + ']')[0].value;
  var website = document.getElementsByName('website[' + userId + ']')[0].value;
  var description = document.getElementsByName('description[' + userId + ']')[0].value;
  var latitude = document.getElementsByName('latitude[' + userId + ']')[0].value;
  var longitude = document.getElementsByName('longitude[' + userId + ']')[0].value;

  // Perform the update using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'update_vet.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Handle the response from the server
      alert(xhr.responseText); // Display a success message or handle any errors
    }
  };

  var params =
    'user_id=' +
    userId +
    '&username=' +
    encodeURIComponent(username) +
    '&email=' +
    encodeURIComponent(email) +
    '&address=' +
    encodeURIComponent(address) +
    '&city=' +
    encodeURIComponent(city) +
    '&postal_code=' +
    encodeURIComponent(postalCode) +
    '&contact_number=' +
    encodeURIComponent(contactNumber) +
    '&website=' +
    encodeURIComponent(website) +
    '&description=' +
    encodeURIComponent(description) +
    '&latitude=' +
    encodeURIComponent(latitude) +
    '&longitude=' +
    encodeURIComponent(longitude);

  xhr.send(params);
}


function deleteUser(userId) {
  console.log('deleteUser function called with userId:', userId);

  // Perform the deletion using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'delete_vet.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Handle the successful response from the server
        alert(xhr.responseText); // Display a success message or handle any errors
        
        // Reload the page after a short delay (e.g., 2 seconds)
        setTimeout(function() {
          location.reload();
        }, 2000);
      } else {
        // Handle any errors that occurred during the deletion process
        alert('Error deleting user: ' + xhr.responseText);
      }
    }
  };
  xhr.send('user_id=' + userId);
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
<section class="glass-for-button-list">
    
<button class="explore-btn" onclick="location.href='usertable.php'">User Table</button>
<button class="explore-btn" onclick="location.href='petshoptable.php'">Pet Shop Table</button>
<button class="explore-btn" onclick="location.href='petgroomertable.php'">Pet Groomer Table</button>
<button class="explore-btn" onclick="location.href='petdaycaretable.php'">Pet Day Care Table</button>
<button class="explore-btn" onclick="location.href='pharmacytable.php'">Pharmacy Table</button>
<button class="explore-btn" onclick="location.href='veterinariantable.php'">Veterinarian Table</button>

  </section>
  
  <section class="glass">
    <div class="Dashboard">
    <div class="card">
    <h2>Veterinarian Table</h2>
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