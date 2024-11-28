<?php
error_reporting(-1);
include('../models/dbcon.php');

$appointment_id = $_GET['id'];

$query = mysqli_query($conn, "UPDATE appointments SET status=2 WHERE appointment_id = '$appointment_id'") or die(mysqli_error());


?>
<script>
    alert('Appointment Successfully Updated');
    window.location.href = "../admin/dashboard.php";
</script>
<?php



?>