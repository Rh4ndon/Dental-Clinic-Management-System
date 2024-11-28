<?php
error_reporting(-1);
include('../models/dbcon.php');

$client_id = $_GET['id'];

$query = mysqli_query($conn, "UPDATE clients SET status=0 WHERE client_id = '$client_id'") or die(mysqli_error());


?>
<script>
    alert('Client Successfully Deactivated');
    window.location.href = "../admin/client.php";
</script>
<?php



?>