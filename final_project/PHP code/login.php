<?php
session_start();
include("db.php");

// Get username and password from POST request
$email = $_POST['email'];
$password = $_POST['pass'];

// Sanitize inputs
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Create SQL query
$sql = "SELECT * FROM users WHERE email = '$email'";

// Execute query and get result
$result = mysqli_query($conn, $sql);
print_r($result);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['password']) {
            // echo 'Login successful';
	    header("location: ../HTML Code/index.html");
	    die;
        } else {
            echo 'Invalid credentials';
        }
    }
} else {
    echo 'Invalid credentials';
}
?>