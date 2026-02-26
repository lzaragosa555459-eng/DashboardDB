<?php
include "../db.php";

$sql = "
SELECT p.*, b.booking_date, c.full_name
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
JOIN clients c ON b.client_id = c.client_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Payments</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container mt-4">
  <h2>Payments</h2>

  <div class="table-responsive mt-3">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Client</th>
          <th>Booking ID</th>
          <th>Amount</th>
          <th>Method</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while($p = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $p['payment_id']; ?></td>
            <td><?php echo $p['full_name']; ?></td>
            <td><?php echo $p['booking_id']; ?></td>
            <td>₱<?php echo number_format($p['amount_paid'],2); ?></td>
            <td><?php echo $p['method']; ?></td>
            <td><?php echo $p['payment_date']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>