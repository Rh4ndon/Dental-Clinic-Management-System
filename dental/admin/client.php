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
            <div class="col-xxl-16 col-xl-12">


              <div class="card info-card customers-card">

                <div class="card-body" style=" overflow-x: auto;">
                  <h5 class="card-title">List of Clients <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></h5>

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
                      $query = mysqli_query($conn, "select * from clients") or die(mysqli_error());
                      while ($row = mysqli_fetch_array($query)) {

                      ?>
                        <tr>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
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
                              <a href="../controllers/activate_client.php?id=<?php echo $row['client_id']; ?>" class="btn btn-success add"><i class="bx bx-message-square-check"></i> Activate</a>

                            <?php
                            } else { ?>
                              <a href="../controllers/deactivate_client.php?id=<?php echo $row['client_id']; ?>" class="btn btn-info add"><i class="bx bx-message-square-check"></i> Deactivate</a>
                            <?php  } ?>
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