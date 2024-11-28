  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">BrightBite</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">
          <?php
          include('../models/dbcon.php');
          $query_appointment = mysqli_query($conn, "select * from appointments where dentist_id = '$session_id' and status = 0") or die(mysqli_error());
          $num_row_appointment = mysqli_num_rows($query_appointment);


          ?>


          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?php echo $num_row_appointment; ?></span>
          </a><!-- End Notification Icon -->



          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?php echo $num_row_appointment; ?> notifications
            </li>

            <?php
            while ($row_appointment = mysqli_fetch_array($query_appointment)) {
              $appointment_id = $row_appointment['appointment_id'];

              $client_id = $row_appointment['client_id'];

              $query_client = mysqli_query($conn, "select * from clients where client_id = '$client_id'") or die(mysqli_error());
              $row_client = mysqli_fetch_array($query_client);





            ?>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4><u><?php echo $row_client['name']; ?></u> submitted an appointment</h4>

                </div>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

            <?php } ?>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->






        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/<?php echo $row_dentist['picture']; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row_dentist['name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $row_dentist['name']; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="dentist_profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../controllers/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>







    </nav><!-- End Icons Navigation -->




  </header>