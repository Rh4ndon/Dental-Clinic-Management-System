<?php
include '../models/dbcon.php';

if (isset($_POST['update_profile'])) {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $name = $_POST['name'];
    $dentist_id = $_POST['dentist_id'];
    $password = $_POST['password'];

    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $targetDirectory = '../assets/img/'; // Specify your desired directory

    $uploadedFile = $_FILES['profile']['tmp_name'];
    $fileName = $_FILES['profile']['name'];
    $fileExtension = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));

    // Verify that the uploaded file is valid and owned by the current user
    if (is_uploaded_file($uploadedFile)) {
        if (in_array($fileExtension, $allowedExtensions)) {

            move_uploaded_file($_FILES["profile"]["tmp_name"], "../assets/img/" . $_FILES["profile"]["name"]);

            $query = mysqli_query($conn, "UPDATE dentists SET email='$email', phone='$phone', address='$address', name='$name', password='$password', picture='$fileName' WHERE dentist_id = '$dentist_id'") or die(mysqli_error());


            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    File uploaded successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';


            header('Location: ../dentist/dentist_profile.php');
            exit();
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Sorry, only IMAGE files are allowed.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    } else {

        $query = mysqli_query($conn, "UPDATE dentists SET email='$email', phone='$phone', address='$address', name='$name', password='$password' WHERE dentist_id = '$dentist_id'") or die(mysqli_error());

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                An error occurred while uploading the file.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        
       ';

        header('Location: ../dentist/dentist_profile.php');
        exit();
    }
}
