<?php
error_reporting(-1);
include('../models/dbcon.php');

$dentist_id = $_GET['id'];

$query = mysqli_query($conn, "UPDATE dentists SET status=1 WHERE dentist_id = '$dentist_id'") or die(mysqli_error());


?>
<script>
    alert('Dentist Successfully Activated');
    window.location.href = "../admin/dentist.php";
</script>
<?php



?>