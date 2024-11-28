<?php @include '../controllers/session.php'; ?>
<?php
include('../models/dbcon.php');
$query_admin = mysqli_query($conn, "select * from admin where admin_id = '$session_id'") or die(mysqli_error());
$row_admin = mysqli_fetch_array($query_admin);
?>
<?php @include 'head.php'; ?>

</head>

<body>
  <!-- ======= Header ======= -->
  <?php @include 'header.php'; ?>
  <!-- End Header -->


  <!-- ======= Sidebar ======= -->
  <?php @include 'sidebar.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Customers Card -->
            <!--div class="col-xxl-3 col-xl-12">
              <!?php @include '../controllers/add_section.php'; ?>


              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Add </h5>

                  <div class="d-flex align-items-center">

                    <form method="post" enctype="multipart/form-data">


                      <input class="form-control" type="text" name="section_name" placeholder="YearLevel-Section" required>


                  </div>
                  <br>
                  <div class="align-items-center">
                    <button type="submit" name="add" class="btn btn-primary">Add</button>

                  </div>
                  </form>
                </div>
              </div>

            </div -->
            <!-- End Card -->



            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-12">


              <div class="card info-card customers-card" style=" overflow-x: auto;">

                <div class="card-body">
                  <h5 class="card-title">List of Appointments <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></h5>

                  <table class="table table-bordered table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th style="width: 15%">
                          Date and Time
                        </th>
                        <th style="width: 15%">
                          Client Name
                        </th>
                        <th style="width: 10%">
                          Client Cp No.
                        </th>
                        <th style="width: 15%">
                          Dentist Name
                        </th>
                        <th style="width: 10%">
                          Dentist Cp No.
                        </th>
                        <th style="width: 10%">
                          Status
                        </th>
                        <th class="add" style="width: 20%">
                          Action
                        </th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      @include '../models/dbcon.php';
                      $query = mysqli_query($conn, "select * from appointments") or die(mysqli_error());
                      while ($row = mysqli_fetch_array($query)) {
                        $row_client = mysqli_fetch_array(mysqli_query($conn, "select * from clients where client_id = '$row[client_id]'"));
                        $row_dentist = mysqli_fetch_array(mysqli_query($conn, "select * from dentists where dentist_id = '$row[dentist_id]'"));
                      ?>
                        <tr>
                          <td style="background-color:<?php if ($row['date'] == date('Y-m-d')) {
                                                        echo 'red';
                                                      } else {
                                                        echo '#fff';
                                                      } ?>;">
                            <?php echo $row['date'] . ',   ' . $row['time']; ?>
                          </td>
                          <td>
                            <?php echo $row_client['name']; ?>
                          </td>
                          <td>
                            <?php echo $row_client['phone']; ?>
                          </td>
                          <td>
                            <?php echo $row_dentist['name']; ?>
                          </td>
                          <td>
                            <?php echo $row_dentist['phone']; ?>
                          </td>


                          <td>
                            <?php
                            if ($row['status'] == 0) { ?>
                              <span class="badge rounded-pill bg-warning text-dark">Not Yet Done</span>
                            <?php
                            } else if ($row['status'] == 1) { ?>
                              <span class="badge rounded-pill bg-success">Done</span>
                            <?php  } else if ($row['status'] == 2) { ?>
                              <span class="badge rounded-pill bg-danger">Canceled</span>
                            <?php } ?>
                          </td>



                          <td class="add">
                            <?php
                            if ($row['status'] == 0) { ?>
                              <a href="../controllers/cancel.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-secondary"><i class="bx bx-message-square-check"></i> Cancel</a>
                              <a href="../controllers/done.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-success"><i class="bx bx-message-square-check"></i> Done</a>
                            <?php
                            } else {
                              echo 'No Action Needed';
                            } ?>
                          </td>



                        </tr>


                      <?php } ?>
                    </tbody>
                  </table>


                </div>
              </div>




            </div>


          </div><!-- End Left side columns -->

          <!-- Right side columns -->
          <div class="col-lg-4">










          </div><!-- End Right side columns -->

        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php @include 'footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php @include 'script.php'; ?>

</body>

</html>