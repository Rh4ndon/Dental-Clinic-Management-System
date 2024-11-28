<?php

include '../models/dbcon.php';

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Start the session
session_start();



// Query the user data from the database
$query = "SELECT * FROM dentists WHERE status = 1";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$response = array('success' => true, 'data' => array());

while ($row = mysqli_fetch_array($result)) {
    $query_schedule = "SELECT * FROM schedules WHERE schedule_id = '$row[schedule_id]'";
    $result_schedule = mysqli_query($conn, $query_schedule) or die(mysqli_error($conn));
    $row_schedule = mysqli_fetch_array($result_schedule);
    $num_row_schedule = mysqli_num_rows($result_schedule);

    if ($num_row_schedule > 0) {
        $schedule = $row_schedule['day'] . ' ' . $row_schedule['time'];
    } else {
        $schedule = 'No Schedule Assigned';
    }

    $response['data'][] = array(
        'id' => $row['dentist_id'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'name' => $row['name'],
        'address' => $row['address'],
        'status' => $row['status'],
        'schedule' => $schedule
    );
}

if (count($response['data']) == 0) {
    $response = array(
        'success' => false,
        'error' => 'nothing found'
    );
}

echo json_encode($response);

mysqli_close($conn);
