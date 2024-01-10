<?php

header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "signupdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    $response = array('success' => false, 'message' => 'Connection failed: ' . $conn->connect_error);
    echo json_encode($response);
    die();
}

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["signupPassword"], PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO user_accounts (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'User registered successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error);
    }

    echo json_encode($response);
}

// Close connection
$conn->close();

?>
