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

// Query the user data into the database
$query = "SELECT * FROM clients WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$num_row = mysqli_num_rows($result);

$pin = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

$number = $row['phone'];
$message = 'Your PIN is: ' . $pin;

$url = 'https://semaphore.co/api/v4/messages';
$data = array(
    'apikey' => '7fecf9dbaf4acf5b35d55ae1f0b366fe', //Your API KEY
    'number' => $number,
    'message' => $message,
    'sendername' => 'PalayanRHS'
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo 'failed';
}

if ($num_row > 0) {
    if ($row['status'] == 0) {
        $response = array(
            'success' => false,
            'error' => 'Your account has been deactivated. Please contact the administrator.'
        );
    } else {
        session_start();
        $_SESSION['user_id'] = $row['client_id'];

        $response = array(
            'success' => true,
            'id' => $row['client_id'],
            'name' => $row['name'],
            'address' => $row['address'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'status' => $row['status'],
            'role' => 'client',
            'pin' => $pin
        );
    }
} else {
    $response = array(
        'success' => false,
        'error' => 'Invalid email or password'
    );
}

echo json_encode($response);





mysqli_close($conn);
