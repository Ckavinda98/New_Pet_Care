<?php
session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');

/* all the functions related to register and adding feedback */

// REGISTER USER
if (isset($_POST['submit'])) {
  // Receive all input values from the form
  $Shop_name = mysqli_real_escape_string($db, $_POST['shop_name']);
  $Address = mysqli_real_escape_string($db, $_POST['address']);
  $Email = mysqli_real_escape_string($db, $_POST['email']);
  $Website = mysqli_real_escape_string($db, $_POST['website']);
  $City = mysqli_real_escape_string($db, $_POST['city']);
  $Postal_code = mysqli_real_escape_string($db, $_POST['postal_code']);
  $Contact_number = mysqli_real_escape_string($db, $_POST['contact_number']);
  $Latitude = mysqli_real_escape_string($db, $_POST['latitude']);
  $Longitude = mysqli_real_escape_string($db, $_POST['longitude']);
  $Description = mysqli_real_escape_string($db, $_POST['description']);
  $Opening_time = mysqli_real_escape_string($db, $_POST['opening_time']);
  $Closing_time = mysqli_real_escape_string($db, $_POST['closing_time']);
  $businessId = mysqli_real_escape_string($db, $_POST['busniess_id']);
  $userId = mysqli_real_escape_string($db, $_POST['user_id']);


  // Check if the username already exists
  $check_query = "SELECT * FROM pet_shop WHERE shop_name='$Shop_name' LIMIT 1";
  $check_result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($check_result);
  
  if ($user) {
    
    echo '<script>alert("Shop Name already exists. Please choose a different Name.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit();
  }

  // Add the values using SQL query with POST method
  $sql = "INSERT INTO pet_shop (shop_name, address, city, postal_code, contact_number, 
  email, website, description, latitude, longitude, busniess_id, user_id, opening_time, closing_time)
          VALUES ('$Shop_name', '$Address', '$City', '$Postal_code', '$Contact_number', '$Email', 
          '$Website', '$Description', '$Latitude', ' $Longitude', ' $businessId', '$userId', '$Opening_time', '  $Closing_time')";

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
  $UserId = mysqli_real_escape_string($db, $_POST['user_id']);

  $filename = $_FILES['file']['name'];
  $destination = 'uploads/' . $filename; // Name of the uploaded file
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  // Destination of the file on the server
  $file = $_FILES['file']['tmp_name'];
  $size = $_FILES['file']['size'];

  // Get the file extension

  // The physical file on a temporary uploads directory on the server

  if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'png', 'jpeg'])) {
    echo "You file extension must be .zip, .pdf, .docx, .jpg, .png, or .jpeg";
  } elseif ($_FILES['file']['size'] > 1000000) { // File shouldn't be larger than 1 Megabyte
    echo "File is too large!";
  } else {
    // Move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, $destination)) {
      $sql = "INSERT INTO products (name, description, price, image, shop_id, user_id)
            VALUES ('$Name', '$Description', '$Price', '$filename', '$ShopId', '$UserId')";

      if (mysqli_query($db, $sql)) {
        echo '<script>alert("Added successfully.");</script>';
        echo '<script>window.location.href = "AddProduct.php";</script>';
      } else {
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



// delete product function

include 'connect.php';
// Check if the product ID is provided
if (isset($_GET['id'])) {
  $productId = $_GET['id'];

  // Perform the deletion query
  // Modify the query as per your table structure
  $query = "DELETE FROM products WHERE id = '$productId'";
  
  // Execute the query
  // Add your database connection code here
  // ...

  // Check if the deletion was successful
  if (mysqli_query($conn, $query)) {
    // Deletion successful
    echo '<script>alert("Product deleted successfully.");</script>';
    echo '<script>window.location.href = "Myshop.php";</script>';
    
  } else {
    // Deletion failed
    echo '<script>alert("Error deleting product: ' . mysqli_error($conn) . '");</script>';
    echo '<script>window.location.href = "Myshop.php";</script>';
  }

  // Close the database connection
  mysqli_close($conn);
} 

// update product details 




// Check if the form is submitted
if (isset($_POST['update_p'])) {
    // Get the product ID from the form
    $productId = $_POST['product_id'];

    // Retrieve the existing product details from the database
    $query = "SELECT * FROM products WHERE id = '$productId'";
    $result = mysqli_query($conn, $query);

    // Check if the product exists
    if (mysqli_num_rows($result) > 0) {
        // Retrieve the product details
        $product = mysqli_fetch_assoc($result);
        $name = $product['name'];
        $description = $product['description'];
        $price = $product['price'];
        $image = $product['image'];

        // Get the updated values from the form inputs
        $updatedName = $_POST['name'];
        $updatedDescription = $_POST['description'];
        $updatedPrice = $_POST['price'];

        // Check if a new image file is uploaded
        if ($_FILES['file']['name'] != '') {
            // Process the uploaded image file
            $targetDir = "uploads/";
            $fileName = basename($_FILES['file']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow only specific file types (e.g., jpeg, png)
            $allowedTypes = array('jpg', 'jpeg', 'png');
            if (in_array($fileType, $allowedTypes)) {
               // Check if the image file exists
if ($image != '' && file_exists($image)) {
  // Attempt to delete the file
  try {
      if (unlink($image)) {
          echo "File deleted successfully.";
      } else {
          echo "Failed to delete the file.";
      }
  } catch (Exception $e) {
      echo "Error deleting the file: " . $e->getMessage();
  }
}


                // Upload the new image file
                move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);

                // Update the image path in the database
                $image = $targetFilePath;
            }
        }

        // Update the product details in the database
        $query = "UPDATE products SET name = '$updatedName', description = '$updatedDescription', price = '$updatedPrice', image = '$fileName' WHERE id = '$productId'";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Product details updated successfully.");</script>';
            echo '<script>window.location.href = "Myshop.php";</script>';
        } else {
            echo '<script>alert("Error updating product details: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("Product not found.");</script>';
    }
} else {
    echo '<script>alert("Form not submitted.");</script>';
}

// Close the database connection
mysqli_close($conn);
?>


