<?php
error_reporting(-1);
include('../models/dbcon.php');

$schedule_id = $_POST['schedule_id'];
$schedule_day = $_POST['schedule_day'];
$schedule_time = $_POST['schedule_time'];

$query = mysqli_query($conn, "UPDATE schedules SET day='$schedule_day', time='$schedule_time' WHERE schedule_id = '$schedule_id'") or die(mysqli_error());


?>
<script>
    alert('Schedule Successfully Updated');
    window.location.href = "../admin/schedule.php";
</script>
<?php



?>