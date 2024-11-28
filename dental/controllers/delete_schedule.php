  <?php
  error_reporting(-1);
  include('../models/dbcon.php');

  $schedule_id = $_GET['id'];

  $query = mysqli_query($conn, "DELETE FROM schedules WHERE schedule_id = '$schedule_id'") or die(mysqli_error());


  ?>
  <script>
    alert('Schedule successfully Deleted');
    window.location.href = "../admin/schedule.php";
  </script>
  <?php



  ?>