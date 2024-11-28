 <!-- Login API -->
 <?php
	include('../models/dbcon.php');
	session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];
	/* client */
	$query = "SELECT * FROM clients WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $query) or die(mysqli_error());
	$row = mysqli_fetch_array($result);
	$num_row = mysqli_num_rows($result);

	/* dentist */
	$query_dentist = mysqli_query($conn, "SELECT * FROM dentists WHERE email='$email' AND password='$password'") or die(mysqli_error());
	$row_dentist = mysqli_fetch_array($query_dentist);
	$num_row_dentist = mysqli_num_rows($query_dentist);

	/* admin */
	$query_admin = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'") or die(mysqli_error());
	$row_admin = mysqli_fetch_array($query_admin);
	$num_row_admin = mysqli_num_rows($query_admin);

	if ($num_row > 0) {
		echo "<script> location.href='../index.php?msg=failed'; </script>";
		//$_SESSION['id'] = $row['client_id'];
		//echo "<script> location.href='../client/client_dashboard.php'; </script>";
		//exit();
	} else if ($num_row_dentist > 0) {
		$_SESSION['id'] = $row_dentist['dentist_id'];
		echo "<script> location.href='../dentist/home.php'; </script>";
		exit();
	} else if ($num_row_admin > 0) {
		$_SESSION['id'] = $row_admin['admin_id'];
		echo "<script> location.href='../admin/dashboard.php'; </script>";
		exit();
	} else {
		echo "<script> location.href='../index.php?msg=failed'; </script>";
	}

	?>