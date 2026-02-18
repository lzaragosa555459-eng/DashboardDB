<?php
include "db.php";
 
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>
<!doctype html>
<html>
<head>
   <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-xxxxxxxxxxxx" crossorigin="anonymous"> 
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <title>Dashboard</title>
</head>
<body class="bg-light">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-yyyyyyyyyyyy" crossorigin="anonymous"></script>

<?php include "nav.php"; ?>
 <div class="container">
  <div class="row">
    <div class="col-12">
          </div>
                  <h2 class="text-center">Dashboard</h2>
                  
                 <div class="container my-4">
                  <div class="row g-3">
                    <!-- Total Clients Card -->
                    <div class="col-6 col-md-3">
                      <div class="card border shadow-sm text-center" style="width: 100%; aspect-ratio: 1 / 1;">
                        <div class="card-body d-flex flex-column justify-content-center">
                          <i class="bi bi-people-fill fs-1 mb-2"></i>
                          <h6 class="card-title">Total Clients</h6>
                          <h3 class="card-text"><?php echo $clients; ?></h3>
                        </div>
                      </div>
                    </div>

                    <!-- Total Services Card -->
                    <div class="col-6 col-md-3">
                      <div class="card border shadow-sm text-center" style="width: 100%; aspect-ratio: 1 / 1;">
                        <div class="card-body d-flex flex-column justify-content-center">
                          <i class="bi bi-gear-fill fs-1 mb-2"></i>
                          <h6 class="card-title">Total Services</h6>
                          <h3 class="card-text"><?php echo $services; ?></h3>
                        </div>
                      </div>
                    </div>

                    <!-- Total Bookings Card -->
                    <div class="col-6 col-md-3">
                      <div class="card border shadow-sm text-center" style="width: 100%; aspect-ratio: 1 / 1;">
                        <div class="card-body d-flex flex-column justify-content-center">
                          <i class="bi bi-calendar-check-fill fs-1 mb-2"></i>
                          <h6 class="card-title">Total Bookings</h6>
                          <h3 class="card-text"><?php echo $bookings; ?></h3>
                        </div>
                      </div>
                    </div>

                    <!-- Total Revenue Card -->
                    <div class="col-6 col-md-3">
                      <div class="card border shadow-sm text-center" style="width: 100%; aspect-ratio: 1 / 1;">
                        <div class="card-body d-flex flex-column justify-content-center">
                          <i class="bi bi-currency-dollar fs-1 mb-2"></i>
                          <h6 class="card-title">Total Revenue</h6>
                          <h3 class="card-text">₱<?php echo number_format($revenue,2); ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                  
                <p class="mb-3">
              <strong>Quick links:</strong>
              <a href="/assessment_beginner/pages/clients_add.php" class="btn btn-sm btn-outline-primary ms-2">Add Client</a>
              <a href="/assessment_beginner/pages/bookings_create.php" class="btn btn-sm btn-outline-success ms-2">Create Booking</a>
            </p>

    </div>
  
 </div>

 
</body>
</html>