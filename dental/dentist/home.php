<?php @include '../controllers/session.php'; ?>
<?php
include('../models/dbcon.php');
$query_dentist = mysqli_query($conn, "select * from dentists where dentist_id = '$session_id'") or die(mysqli_error());
$row_dentist = mysqli_fetch_array($query_dentist);
$status = $row_dentist['status'];

?>
<?php @include 'head.php';
?>

</head>

<body>


  <!-- ======= Header ======= -->
  <?php @include 'header.php'; ?>
  <!-- End Header -->

  <?php

  if ($status == 0) { ?>


  <?php } else { ?>

    <!-- ======= Sidebar ======= -->
    <?php @include 'sidebar.php'; ?>
    <!-- End Sidebar-->


  <?php } ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            <?php

            if ($status == 0) { ?>

              <!-- Start Card -->
              <div class="col-xxl-12 col-md-6">
                <div class="card info-card sales-card">



                  <div class="card-body">
                    <h5 class="card-title">Notice!</h5>

                    <div class="d-flex align-items-center">

                      <div class="ps-3">
                        <h6>Sorry</h6>
                        <span class="text-muted small pt-2 ps-1">You are not yet Activated </span>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- End Card -->

            <?php } else { ?>







              <!-- Schedule Table -->
              <div class="col-xxl-12 col-xl-12">


                <div class="card info-card customers-card" style=" overflow-x: auto;">

                  <div class="card-body">
                    <h5 class="card-title">List of Schedules <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></h5>

                    <table class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th style="width: 20%">
                            Date and Time
                          </th>
                          <th style="width: 20%">
                            Client Name
                          </th>
                          <th style="width: 20%">
                            Client Contact No.
                          </th>
                          <th style="width: 20%">
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
                        $query = mysqli_query($conn, "select * from appointments where dentist_id = '$session_id' ") or die(mysqli_error());
                        while ($row = mysqli_fetch_array($query)) {
                          $row_client = mysqli_fetch_array(mysqli_query($conn, "select * from clients where client_id = '$row[client_id]'"));
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
                                <a href="../controllers/cancel_dentist.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-secondary"><i class="bx bx-message-square-check"></i> Cancel</a>
                                <a href="../controllers/done_dentist.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-success"><i class="bx bx-message-square-check"></i> Done</a>
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

































              <?php }


              ?>



              </div>


          </div><!-- End Left side columns -->

          <!-- Right side columns -->
          <div class="col-lg-4">










          </div><!-- End Right side columns -->

        </div>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php @include 'script.php'; ?>

</body>

</html>