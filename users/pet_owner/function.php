<?php


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');

/* all the functions related to register and adding feedback */

//adding appointment function
if (isset($_POST['submit_app'])) {
  // Receive all input values from the form
  $vet_name = mysqli_real_escape_string($db, $_POST['vet_name']);
  $pet_owner_name = mysqli_real_escape_string($db, $_POST['pet_owner_name']);
  $appointment_date = mysqli_real_escape_string($db, $_POST['appointment_date']);
  $appointment_time = mysqli_real_escape_string($db, $_POST['appointment_time']);
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $vet_id = mysqli_real_escape_string($db, $_POST['vet_id']);
  $vet_user_id = mysqli_real_escape_string($db, $_POST['vet_user_id']);

  // Convert appointment_date to desired format (e.g., YYYY-MM-DD)
$appointment_date = date('Y-m-d', strtotime($appointment_date));

// Convert appointment_time to desired format (e.g., HH:MM:SS)
$appointment_time = date('H:i:s', strtotime($appointment_time));


  // Check if the username already exists
  $check_query = "SELECT * FROM appointments WHERE appointment_date='$appointment_date' && appointment_time='$appointment_time' LIMIT 1";
  $check_result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($check_result);
  
  if ($user) {
    
    echo '<script>alert("Time slot has Already bokked. Please choose a different time.");</script>';
    echo '<script>window.location.href = "Addapoitmnet.php";</script>';
    exit();
  }

  // Add the values using SQL query with POST method
  $sql = "INSERT INTO appointments (pet_owner_name, user_id, vet_id, vet_name, appointment_date, 
  appointment_time, vet_user_id)
          VALUES ('$pet_owner_name', '$user_id', '$vet_id', '$vet_name', '$appointment_date', 
          '$appointment_time', $vet_user_id)";

if (mysqli_query($db, $sql)) {
 
  echo '<script>alert("successfully add the appointment.");</script>';
  echo '<script>window.location.href = "AllService.php";</script>';
  exit();
} else {
  
  echo '<script>alert("Failed to add the appointment.");</script>';
  echo '<script>window.location.href = "register.php";</script>';
  
  exit();
}
}


if (isset($_POST['submit_prc'])) {
  $pharmacist_name = mysqli_real_escape_string($db, $_POST['pharmacist_name']);
  $pet_owner_name = mysqli_real_escape_string($db, $_POST['pet_owner_name']);
  $pharmacist_id = mysqli_real_escape_string($db, $_POST['pharmacist_id']);
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $pham_user_id = mysqli_real_escape_string($db, $_POST['pham_user_id']);

  $filename = $_FILES['file']['name'];
$destination = 'uploads/' . $filename;// name of the uploaded file
$extension = pathinfo($filename, PATHINFO_EXTENSION);

 // destination of the file on the server
 $file = $_FILES['file']['tmp_name'];
 $size = $_FILES['file']['size'];

 // get the file extension
 
 

 // the physical file on a temporary uploads directory on the server
 

 if (!in_array($extension, ['zip', 'pdf', 'docx','jpg','png','jpeg',])) {
echo "You file extension must be .zip, .pdf or .docx";
} elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
echo "File too large!";
} else {
// move the uploaded (temporary) file to the specified destination
if (move_uploaded_file($file, $destination)) {
  $sql = "INSERT INTO prescriptions (user_id, pharmacist_id,  image, pet_owner_name, pharmacist_name, pham_user_id)
            VALUES ('$user_id', '$pharmacist_id', '$filename',  '$pet_owner_name', '$pharmacist_name', '$pham_user_id')";

  if (mysqli_query($db, $sql)) {
    echo '<script>alert("Added successfully.");</script>';
    echo '<script>window.location.href = "Allservice.php";</script>';
  }
  else {
    echo '<script>alert("Failed to upload the image.");</script>';
    echo '<script>window.location.href = "AddProduct.php";</script>';
  }
} else {
  // File upload failed
  echo '<script>alert("Failed to upload the image.");</script>';
  echo '<script>window.location.href = "AddProduct.php";</script>';
}
} 
}






?>