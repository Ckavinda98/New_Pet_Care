<?php
session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');

/* all the functions related to register and adding feedback */

// REGISTER USER
if (isset($_POST['submit'])) {
  // Receive all input values from the form
  $Shop_name = mysqli_real_escape_string($db, $_POST['groomer_name']);
  $Address = mysqli_real_escape_string($db, $_POST['address']);
  $Email = mysqli_real_escape_string($db, $_POST['email']);
  $Website = mysqli_real_escape_string($db, $_POST['website']);
  $City = mysqli_real_escape_string($db, $_POST['city']);
  $Postal_code = mysqli_real_escape_string($db, $_POST['postal_code']);
  $Contact_number = mysqli_real_escape_string($db, $_POST['contact_number']);
  $Latitude = mysqli_real_escape_string($db, $_POST['latitude']);
  $Longitude = mysqli_real_escape_string($db, $_POST['longitude']);
  $Description = mysqli_real_escape_string($db, $_POST['description']);
  // $Opening_hours = mysqli_real_escape_string($db, $_POST['opening_hours']);
  $businessId = mysqli_real_escape_string($db, $_POST['busniess_id']);
  $userId = mysqli_real_escape_string($db, $_POST['user_id']);


  // Check if the username already exists
  $check_query = "SELECT * FROM pet_groomer WHERE groomer_name='$Shop_name' LIMIT 1";
  $check_result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($check_result);
  
  if ($user) {
    
    echo '<script>alert("Shop Name already exists. Please choose a different Name.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit();
  }

  // Add the values using SQL query with POST method
  $sql = "INSERT INTO pet_groomer (groomer_name, address, city, postal_code, contact_number, 
  email, website, description, latitude, longitude, busniess_id, user_id)
          VALUES ('$Shop_name', '$Address', '$City', '$Postal_code', '$Contact_number', '$Email', 
          '$Website', '$Description', '$Latitude', ' $Longitude', ' $businessId', '$userId')";

if (mysqli_query($db, $sql)) {
 
  echo '<script>alert("Registration successful.");</script>';
  echo '<script>window.location.href = "index.php";</script>';
  exit();
} else {
  
  echo '<script>alert("Failed to register.");</script>';
  echo '<script>window.location.href = "register.php";</script>';
  
  exit();
}
}


if (isset($_POST['submit_p'])) {
  $Name = mysqli_real_escape_string($db, $_POST['name']);
  $Description = mysqli_real_escape_string($db, $_POST['description']);
  $Price = mysqli_real_escape_string($db, $_POST['price']);
  $ShopId = mysqli_real_escape_string($db, $_POST['shopId']);

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
  $sql = "INSERT INTO products (name, description, price, image, shop_id)
            VALUES ('$Name', '$Description', '$Price', '$filename', '$ShopId')";

  if (mysqli_query($db, $sql)) {
    echo '<script>alert("Added successfully.");</script>';
    echo '<script>window.location.href = "AddProduct.php";</script>';
  }
  else {
    echo '<script>alert("Failed to add Product.");</script>';
    echo '<script>window.location.href = "AddProduct.php";</script>';
  }
} else {
  // File upload failed
  echo '<script>alert("Failed to upload the image.");</script>';
  echo '<script>window.location.href = "AddProduct.php";</script>';
}
} 
}

// adding image to the gallery

if (isset($_POST['submit_img'])) {

  
  


  $userId = $_POST['user_id'];
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
} elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
echo "File too large!";
} else {
// move the uploaded (temporary) file to the specified destination
if (move_uploaded_file($file, $destination)) {
  $sql = "INSERT INTO gallery (user_id, images) VALUES ('$userId', '$filename')";



  if (mysqli_query($db, $sql)) {
    echo '<script>alert("Added successfully.");</script>';
    echo '<script>window.location.href = "addimage.php";</script>';
  }
  else {
    echo '<script>alert("Failed to add Image.");</script>';
    echo '<script>window.location.href = "addimage.php";</script>';
  }
} else {
  // File upload failed
  echo '<script>alert("Failed to upload the image.");</script>';
  echo '<script>window.location.href = "addimage.php";</script>';
}
} 
}


// delete product function

include 'connect.php';
// Check if the product ID is provided
if (isset($_GET['image_id'])) {
  $productId = $_GET['image_id'];

  // Perform the deletion query
  // Modify the query as per your table structure
  $query = "DELETE FROM gallery WHERE image_id = '$productId'";
  
  // Execute the query
  // Add your database connection code here
  // ...

  // Check if the deletion was successful
  if (mysqli_query($db, $query)) {
    // Deletion successful
    echo '<script>alert("Product deleted successfully.");</script>';
    echo '<script>window.location.href = "addimage.php";</script>';
    
  } else {
    // Deletion failed
    echo '<script>alert("Error deleting product: ' . mysqli_error($db) . '");</script>';
    echo '<script>window.location.href = "addimage.php";</script>';
  }

  // Close the database connection
  mysqli_close($db);
} 


?>

