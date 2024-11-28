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



              <div class="col-xl-6">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Edit Profile</h5>

                    <form method="POST" action="../controllers/update_profile.php" enctype="multipart/form-data">
                      <div class="row mb-4">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Profile</label>
                        <div class="col-sm-10">
                          <input class="form-control" name="profile" type="file" id="formFile">
                        </div>
                      </div>
                      <div class="row mb-4">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" value="<?php echo $row_dentist['name']; ?>" class="form-control">
                          <input type="hidden" name="dentist_id" value="<?php echo $row_dentist['dentist_id']; ?>" required>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" value="<?php echo $row_dentist['email']; ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="number" name="phone" value="<?php echo $row_dentist['phone']; ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" value="<?php echo $row_dentist['address']; ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <input type="password" name="password" value="<?php echo $row_dentist['password']; ?>" class="form-control" required id="passwordInput">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                              <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                            </button>
                          </div>
                          <script>
                            document.getElementById('togglePassword').addEventListener('click', function() {
                              const passwordInput = document.getElementById('passwordInput');
                              const passwordIcon = document.getElementById('togglePasswordIcon');
                              const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                              passwordInput.setAttribute('type', type);
                              passwordIcon.classList.toggle('bi-eye');
                              passwordIcon.classList.toggle('bi-eye-slash');
                            });
                          </script>
                        </div>
                      </div>

                      <div class="social-links mt-2">
                        <button type="submit" name="update_profile" class="btn btn-outline-primary"><i class="ri-save-3-fill"></i> Save</button>
                      </div>
                    </form>
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