<?php

include '../models/dbcon.php';

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Start the session
session_start();

$user_id = $_GET['user_id'];

// Query the user data from the database
$query = "SELECT * FROM appointments WHERE client_id = '$user_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$response = array('success' => true, 'data' => array());

while ($row = mysqli_fetch_array($result)) {

    $query_dentist = "SELECT * FROM dentists WHERE dentist_id = '$row[dentist_id]'";
    $result_dentist = mysqli_query($conn, $query_dentist) or die(mysqli_error($conn));
    $row_dentist = mysqli_fetch_array($result_dentist);
    $num_row_dentist = mysqli_num_rows($result_dentist);

    if ($num_row_dentist > 0) {
        $response['data'][] = array(
            'client_id' => $row['client_id'],
            'appointment_id' => $row['appointment_id'],
            'dentist_id' => $row['dentist_id'],
            'dentist_name' => $row_dentist['name'],
            'dentist_email' => $row_dentist['email'],
            'dentist_phone' => $row_dentist['phone'],
            'date' => $row['date'],
            'time' => $row['time'],
            'status' => $row['status']
        );
    }
}

if (count($response['data']) == 0) {
    $response = array(
        'success' => false,
        'error' => 'no appointments found'
    );
}

echo json_encode($response);

mysqli_close($conn);
