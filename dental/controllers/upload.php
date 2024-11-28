<?php
include '../models/dbcon.php';

if (isset($_POST['upload'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $total_points = $_POST['total_points'];
    $deadline = $_POST['deadline'];

    $allowedExtensions = ['pdf', 'docx', 'xlsx', 'xls', 'png', 'jpg', 'jpeg'];
    $targetDirectory = '../uploads/'; // Specify your desired directory

    $uploadedFile = $_FILES['document']['tmp_name'];
    $fileName = $_FILES['document']['name'];
    $fileExtension = strtolower(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION));

    // Verify that the uploaded file is valid and owned by the current user
    if (is_uploaded_file($uploadedFile)) {
        if (in_array($fileExtension, $allowedExtensions)) {

            move_uploaded_file($_FILES["document"]["tmp_name"], "../uploads/" . $_FILES["document"]["name"]);

            mysqli_query($conn,"insert into assignments (title,file_name,total_points,subject,deadline,category,status)
            values ('$title','$fileName','$total_points','$subject','$deadline','$category', 1)") or die(mysqli_error());
            
            $query_assign = "SELECT * FROM assignments WHERE title = '$title' AND file_name = '$fileName' AND subject = '$subject' ";
            $result_assign = mysqli_query($conn,$query_assign)or die(mysqli_error());
            $row_assign = mysqli_fetch_array($result_assign);

            $assign_id = $row_assign['assignment_id'];

            $query_student = "SELECT * FROM students";
			$result = mysqli_query($conn,$query_student)or die(mysqli_error());
            while($row = mysqli_fetch_array($result)){

                $student_id = $row['student_id'];
                
            mysqli_query($conn,"insert into assignment_notification (assignment_id,student_id,subject,notification_status)
            values ('$assign_id','$student_id','$subject', 1)") or die(mysqli_error());


            }
			
			


            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    File uploaded successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Sorry, only IMAGE, PDF, and DOCX files are allowed.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                An error occurred while uploading the file.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        
       ';
    }
}
?>