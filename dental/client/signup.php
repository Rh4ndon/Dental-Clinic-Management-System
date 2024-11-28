<?php

include '../models/dbcon.php';

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Read the raw input from the request body
$json = file_get_contents('php://input');

// Parse the JSON payload
$data = json_decode($json, true);

// Get the posted data
$email = $data['email'];
$password = $data['password'];
$phone = $data['phone'];
$name = $data['name'];
$address = $data['address'];

// Hash the password for storage
//$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insert the user data into the database
$query = "INSERT INTO clients ( password, name, email, phone, address, status) VALUES ('$password', '$name', '$email', '$phone', '$address', 1)";

if (!isset($email) || !isset($password) || !isset($name) || !isset($address)) {
    $response = array('message' => 'Missing required fields');
} else {
    if (mysqli_query($conn, $query)) {
        $response = array('message' => 'Signup successful!');
    } else {
        $response = array('message' => 'Error: ' . mysqli_error($conn));
    }
}




mysqli_close($conn);

// Set the content type to JSON and encode the response
header('Content-Type: application/json');
echo json_encode($response);
