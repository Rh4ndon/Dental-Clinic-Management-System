<!-- Database connection API -->
<?php
error_reporting(0);

ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$conn = mysqli_connect('localhost', 'root', '', 'dental') or die(mysqli_error());

?>