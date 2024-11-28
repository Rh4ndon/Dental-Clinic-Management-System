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
            <div class="col-xxl-3 col-xl-12">
              <?php @include '../controllers/register.php'; ?>


              <div class="card info-card customers-card add">

                <div class="card-body">
                  <h5 class="card-title">Add Dentist</h5>

                  <div class="d-flex align-items-center">

                    <form method="post" enctype="multipart/form-data">

                      <div class="col-12">
                        <label for="yourName" class="form-label">First Name</label>
                        <input type="text" name="name" class="form-control" id="yourName" required>
                        <div class="invalid-feedback">Please, enter your first name!</div>
                      </div>

                      <div class="col-12">
                        <label for="yourName" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="yourName" required>
                        <div class="invalid-feedback">Please, enter your last name!</div>
                      </div>


                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="email" name="email" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please choose a username.</div>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="yourPhone" class="form-label">Phone</label>
                        <div class="input-group has-validation">
                          <input type="number" name="phone" class="form-control" id="yourPhone" required>
                          <div class="invalid-feedback">Please input phone number.</div>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="yourAddress" class="form-label">Address</label>
                        <div class="input-group has-validation">
                          <input type="text" name="address" class="form-control" id="yourAddress" required>
                          <div class="invalid-feedback">Please, enter your address!</div>
                        </div>
                      </div>





                  </div>
                  <br>
                  <div class="align-items-center">
                    <button type="submit" name="register_dentist" class="btn btn-primary">Register</button>

                  </div>
                  </form>
                </div>
              </div>

            </div>
            <!-- End Card -->





            <!-- Customers Card -->
            <div class="col-xxl-9 col-xl-12">


              <div class="card info-card customers-card" style=" overflow-x: auto;">

                <div class="card-body">
                  <h5 class="card-title">List of Dentists <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></h5>

                  <table class="table datatable">

                    <thead>
                      <tr>
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          Schedule
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Action
                        </th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      @include '../models/dbcon.php';
                      $query = mysqli_query($conn, "select * from dentists") or die(mysqli_error());
                      while ($row = mysqli_fetch_array($query)) {

                      ?>
                        <tr>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php
                              if ($row['schedule_id'] == 0) {
                                echo 'No Schedule Assign Yet';
                              } else {
                                $query_schedule = mysqli_query($conn, "select * from schedules where schedule_id = '$row[schedule_id]'");
                                $row_schedule = mysqli_fetch_array($query_schedule);
                                echo $row_schedule['day'] . ' ' . $row_schedule['time'];
                              }
                              ?></td>
                          <td><?php
                              if ($row['status'] == 0) {
                                echo 'Inactive';
                              } else {
                                echo 'Active';
                              }
                              ?></td>
                          <td>
                            <?php
                            if ($row['status'] == 0) { ?>
                              <a href="../controllers/activate.php?id=<?php echo $row['dentist_id']; ?>" class="btn btn-success add"><i class="bx bx-message-square-check"></i> Activate</a>

                            <?php
                            } else { ?>
                              <a href="../controllers/deactivate.php?id=<?php echo $row['dentist_id']; ?>" class="btn btn-info add"><i class="bx bx-message-square-check"></i> Deactivate</a>
                            <?php  } ?>
                            <a href="edit_dentist.php?id=<?php echo $row['dentist_id']; ?>" class="btn btn-warning add"><i class="bx bx-message-square-check"></i> Edit</a>
                          </td>

                        </tr>


                      <?php } ?>
                    </tbody>
                  </table>


                </div>
              </div>

            </div>
            <!-- End Bañaga Card -->




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