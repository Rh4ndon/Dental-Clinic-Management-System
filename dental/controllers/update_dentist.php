<?php
error_reporting(-1);
include('../models/dbcon.php');

$dentist_id = $_POST['dentist_id'];
$schedule_id = $_POST['schedule_id'];
$email = $_POST['email'];
$name = $_POST['name'];

$query = mysqli_query($conn, "UPDATE dentists SET schedule_id='$schedule_id', email='$email', name='$name' WHERE dentist_id = '$dentist_id'") or die(mysqli_error());


?>
<script>
    alert('Dentist Successfully Updated');
    window.location.href = "../admin/dentist.php";
</script>
<?php



?>