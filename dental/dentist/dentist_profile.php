<?php @include '../controllers/session.php'; ?>
<?php
include('../models/dbcon.php');
$query_dentist = mysqli_query($conn, "select * from dentists where dentist_id = '$session_id'") or die(mysqli_error());
$row_dentist = mysqli_fetch_array($query_dentist);
$status = $row_dentist['status'];


?>
<?php @include 'head.php'; ?>

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
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            <?php

            if ($status == 0) { ?>

              <!-- Calara Card -->
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
              <!-- End Calara Card -->

            <?php } else { ?>





              <!-- Profile Card -->



              <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="../assets/img/<?php echo $row_dentist['picture']; ?>" style="width: 50%;" alt="Profile" class="rounded-circle">
                    <h2><?php echo $row_dentist['name']; ?></h2>
                    <h3><?php echo $row_dentist['email']; ?></h3>
                    <h3><?php echo $row_dentist['phone']; ?></h3>
                    <h4><?php echo $row_dentist['address']; ?></h4>
                    <div class="social-links mt-2">
                      <a href="edit_profile.php"><i class="ri-file-user-fill"></i> Edit</a>
                    </div>
                  </div>
                </div>

              </div>
              <!-- End Profile Card -->







































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

  <!-- ======= Footer ======= -->
  <?php @include 'footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php @include 'script.php'; ?>

</body>

</html>