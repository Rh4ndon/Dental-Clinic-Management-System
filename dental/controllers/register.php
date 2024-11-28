<?php
include '../models/dbcon.php';


if (isset($_POST['register_dentist'])) {

  $email = $_POST['email'];
  $firstname = $_POST['name'];
  $lastname = $_POST['lname'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];


  $query = mysqli_query($conn, "select * from dentists where email = '$email' && name = '$firstname $lastname'") or die(mysqli_error());
  $count = mysqli_num_rows($query);

  if ($count > 0) { ?>
    <script>
      alert('User Already Exist');
    </script>
  <?php
  } else {

    mysqli_query($conn, "insert into dentists (email,password,name,address,phone,picture,schedule_id, status)
      values ('$email','brightbite2024','$firstname $lastname','$address','$phone','profile-img.jpg', 0, 0)") or die(mysqli_error());
  ?>
    <script>
      alert('Dentist Registered');
    </script>

<?php
  }
}




?>