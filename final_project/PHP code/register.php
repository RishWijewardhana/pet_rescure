<?php
  session_start();
  include("db.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
   $email = $_POST["email"];
   $password = $_POST["password"];
   $c_password = $_POST["password-confirm"];
   $pet_name = $_POST["pet-name"];
   $pet_breed = $_POST["pet-breed"];
   $pet_age = $_POST["pet-age"];
   $owner_contact = $_POST["owner-contact"];
   $description = $_POST["description"];
   $image = $_FILES["pet-image"];
   $target = "../images/".$_FILES["pet-image"]["name"];

  /*if(isset($image)){
   echo "good"; 
   } else{
   echo "bad";
   }*/
  
   if(!empty($email) && !empty($password) && !is_numeric($email))
   { 
    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data into users table 
	$query = "INSERT INTO users(email, password, owner_contact)
	VALUES ('$email', '$password', '$owner_contact')";
	
	mysqli_query($conn, $query);

// Insert data into pets table 
	$query = "INSERT INTO pets(pet_name, pet_breed, pet_age, pet_image, Description)
	VALUES ('$pet_name', '$pet_breed', '$pet_age', '$target', '$description')";
	
	mysqli_query($conn, $query);


// Upload image
	// Move the uploaded image into the folder "images"
	if (move_uploaded_file($_FILES['pet-image']['tmp_name'], $target)) {
        // echo "Image uploaded successfully";
    } else {
        // echo "Failed to upload image";
    }


	echo "<script type = 'text/javascript'> alert('Successfully Register')</script>";
   }
   else
   {
	echo "<script type = 'text/javascript'> alert('Please enter some valid information')</script>";
   }  

  }

?>

