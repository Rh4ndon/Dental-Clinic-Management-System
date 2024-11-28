<?php
include '../models/dbcon.php';

if (isset($_POST['add'])) {


    $schedule_day = $_POST['schedule_day'];
    $schedule_time = $_POST['schedule_time'];



    $query = mysqli_query($conn, "select * from schedules where day = '$schedule_day' and time = '$schedule_time'") or die(mysqli_error());
    $count = mysqli_num_rows($query);

    if ($count > 0) { ?>
        <script>
            alert('Schedule Already Exist');
        </script>
<?php


    } else {

        mysqli_query($conn, "insert into schedules (day, time)
    values ('$schedule_day', '$schedule_time')") or die(mysqli_error());
    }
}



?>