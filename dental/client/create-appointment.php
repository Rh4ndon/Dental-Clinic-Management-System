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
date_default_timezone_set('Asia/Manila');
$dateString = $data['date'];
$timestamp = strtotime($dateString);
$date = date('m/d/Y', $timestamp);

$dentist_id = $data['dentist_id'];
$time = $data['time'];
$client_id = $data['client_id'];


// Hash the password for storage
//$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insert the user data into the database
$query = "INSERT INTO appointments ( date, dentist_id, time, client_id, status) VALUES ('$date', '$dentist_id', '$time', '$client_id', 0)";

if (!isset($date) || !isset($dentist_id) || !isset($time) || !isset($client_id)) {
    $response = array('message' => 'Missing required fields');
} else {
    //Check if appointment has conflict with another appointment
    $query_check = "SELECT * FROM appointments WHERE dentist_id = '$dentist_id' AND date = '$date' AND time = '$time' AND status = 0";
    $result_check = mysqli_query($conn, $query_check) or die(mysqli_error($conn));
    $num_row_check = mysqli_num_rows($result_check);
    if ($num_row_check > 0) {
        $response = array('message' => 'Appointment has conflict with another appointment');
    } else {
        if (mysqli_query($conn, $query)) {
            $response = array('message' => 'Appointment created successful!');
        } else {
            $response = array('message' => 'Error: ' . mysqli_error($conn));
        }
    }
}




mysqli_close($conn);

// Set the content type to JSON and encode the response
header('Content-Type: application/json');
echo json_encode($response);
