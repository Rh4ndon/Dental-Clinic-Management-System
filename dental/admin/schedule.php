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
              <?php @include '../controllers/add_schedule.php'; ?>


              <div class="card info-card customers-card add">

                <div class="card-body">
                  <h5 class="card-title">Add Schedule</h5>

                  <div class="d-flex align-items-center">

                    <form method="post" enctype="multipart/form-data">



                      <div class="col-12">
                        <label for="day" class="form-label">Day</label>
                        <div class="input-group has-validation">
                          <input type="text" name="schedule_day" class="form-control" id="day" placeholder="Day ex:Mon-Fri or Mon,Wed,Fri" required style="width: 300px;">
                          <div class="invalid-feedback">Please input day.</div>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="time" class="form-label">Time</label>
                        <div class="input-group has-validation">
                          <input type="text" name="schedule_time" class="form-control" id="time" placeholder="Time ex:8:00 AM - 9:00 AM" required style="width: 300px;">
                          <div class="invalid-feedback">Please input time.</div>
                        </div>
                      </div>



                  </div>
                  <br>
                  <div class="align-items-center">
                    <button type="submit" name="add" class="btn btn-primary">Add</button>

                  </div>
                  </form>
                </div>
              </div>

            </div>
            <!-- End Bañaga Card -->



            <!-- Customers Card -->
            <div class="col-xxl-9 col-xl-12">


              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">List of Schedules <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></h5>

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>
                          ID No.
                        </th>
                        <th>
                          Day
                        </th>
                        <th>
                          Time
                        </th>
                        <th>
                          Action
                        </th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      @include '../models/dbcon.php';
                      $query = mysqli_query($conn, "select * from schedules") or die(mysqli_error());
                      while ($row = mysqli_fetch_array($query)) {
                        $id = $row['schedule_id'];
                      ?>
                        <tr>
                          <td><?php echo $row['schedule_id']; ?></td>
                          <td><?php echo $row['day']; ?></td>
                          <td><?php echo $row['time']; ?></td>
                          <td>
                            <a href="../controllers/delete_schedule.php?id=<?php echo $row['schedule_id']; ?>" class="btn btn-danger add"><i class="bi bi-trash-fill"></i> Delete</a>
                            <a href="edit_schedule.php?id=<?php echo $row['schedule_id']; ?>" class="btn btn-success add"><i class="bi bi-pencil-square"></i> Edit</a>
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