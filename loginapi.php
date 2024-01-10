<?php
$dbHost = "localhost"; // Replace with your database host
$dbUser = "root"; // Replace with your database username
$dbPass = ""; // Replace with your database password
$dbName = "signupdb";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user_accounts WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login successful";
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
