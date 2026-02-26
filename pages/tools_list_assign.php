<?php
include "../db.php";

$message = "";

// ASSIGN TOOL
if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty = $_POST['qty_used'];

  $toolRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity_available FROM tools WHERE tool_id=$tool_id"));

  if ($qty > $toolRow['quantity_available']) {
    $message = "<div class='alert alert-danger'>Not enough available tools!</div>";
  } else {
    mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
      VALUES ($booking_id, $tool_id, $qty)");

    mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id=$tool_id");

    $message = "<div class='alert alert-success'>Tool assigned successfully!</div>";
  }
}

$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
$bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tools / Inventory</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container mt-4">
  <h2>Tools / Inventory</h2>
  <?php echo $message; ?>

  <h3 class="mt-4">Available Tools</h3>
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Total</th>
          <th>Available</th>
        </tr>
      </thead>
      <tbody>
        <?php while($t = mysqli_fetch_assoc($tools)) { ?>
          <tr>
            <td><?php echo $t['tool_name']; ?></td>
            <td><?php echo $t['quantity_total']; ?></td>
            <td>
              <?php 
                $avail = $t['quantity_available'];
                $badgeClass = $avail > 5 ? 'bg-success' : ($avail > 0 ? 'bg-warning text-dark' : 'bg-danger');
              ?>
              <span class="badge <?php echo $badgeClass; ?>"><?php echo $avail; ?></span>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <hr>

  <h3>Assign Tool to Booking</h3>
  <form method="post" class="mt-3">
    <div class="mb-3">
      <label for="booking_id" class="form-label">Booking ID</label>
      <select name="booking_id" id="booking_id" class="form-select" required>
        <option value="">-- Select Booking --</option>
        <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
          <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="tool_id" class="form-label">Tool</label>
      <select name="tool_id" id="tool_id" class="form-select" required>
        <option value="">-- Select Tool --</option>
        <?php
          $tools2 = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
          while($t2 = mysqli_fetch_assoc($tools2)) {
            $avail = $t2['quantity_available'];
            $badgeText = "Avail: $avail";
        ?>
          <option value="<?php echo $t2['tool_id']; ?>">
            <?php echo $t2['tool_name']; ?> (<?php echo $badgeText; ?>)
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="qty_used" class="form-label">Qty Used</label>
      <input type="number" name="qty_used" id="qty_used" class="form-control" min="1" value="1" required>
    </div>

    <button type="submit" name="assign" class="btn btn-primary">Assign Tool</button>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>