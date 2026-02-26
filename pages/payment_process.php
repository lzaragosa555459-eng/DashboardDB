<?php
include "../db.php";

$booking_id = $_GET['booking_id'];

$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];

$balance = $booking['total_cost'] - $total_paid;
$message = "";

if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];

  if ($amount <= 0) {
    $message = "Invalid amount!";
  } else if ($amount > $balance) {
    $message = "Amount exceeds balance!";
  } else {
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method) VALUES ($booking_id, $amount, '$method')");
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];
    $new_balance = $booking['total_cost'] - $total_paid2;

    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }

    header("Location: bookings_list.php");
    exit;
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Process Payment</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Process Payment (Booking #<?php echo $booking_id; ?>)</h2>

  <div class="mb-3">
    <p>Total Cost: <strong>₱<?php echo number_format($booking['total_cost'],2); ?></strong></p>
    <p>Total Paid: <strong>₱<?php echo number_format($total_paid,2); ?></strong></p>
    <p>Balance: <strong>₱<?php echo number_format($balance,2); ?></strong></p>
  </div>

  <?php if($message): ?>
    <div class="alert alert-danger"><?php echo $message; ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="amount_paid" class="form-label">Amount Paid</label>
      <input type="number" class="form-control" id="amount_paid" name="amount_paid" step="0.01" required>
    </div>

    <div class="mb-3">
      <label for="method" class="form-label">Payment Method</label>
      <select class="form-select" id="method" name="method">
        <option value="CASH">CASH</option>
        <option value="GCASH">GCASH</option>
        <option value="CARD">CARD</option>
      </select>
    </div>

    <button type="submit" name="pay" class="btn btn-primary">Save Payment</button>
    <a href="bookings_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>