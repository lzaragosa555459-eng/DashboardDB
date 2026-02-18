 
<?php // nav.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigation Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation using your links -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container-fluid">
    <div class="collapse navbar-collapse">
      <div class="navigation d-flex flex-wrap gap-2">
        <a class="nav-link " href="/assessment_beginner/index.php">Dashboard</a>
        <a class="nav-link" href="/assessment_beginner/pages/clients_list.php">Clients</a>
        <a class="nav-link" href="/assessment_beginner/pages/services_list.php">Services</a>
        <a class="nav-link" href="/assessment_beginner/pages/bookings_list.php">Bookings</a>
        <a class="nav-link" href="/assessment_beginner/pages/tools_list_assign.php">Tools</a>
        <a class="nav-link" href="/assessment_beginner/pages/payments_list.php">Payments</a>
      </div>
    </div>
  </div>
</nav>

<hr>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>