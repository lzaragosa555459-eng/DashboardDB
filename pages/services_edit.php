<?php
include "../db.php";

$id = (int)$_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);

if (isset($_POST['update'])) {

  $name = mysqli_real_escape_string($conn, $_POST['service_name']);
  $desc = mysqli_real_escape_string($conn, $_POST['description']);
  $rate = mysqli_real_escape_string($conn, $_POST['hourly_rate']);
  $active = mysqli_real_escape_string($conn, $_POST['is_active']);

  mysqli_query($conn, "UPDATE services
    SET service_name='$name',
        description='$desc',
        hourly_rate='$rate',
        is_active='$active'
    WHERE service_id=$id");

  header("Location: services_list.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Service</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../nav.php"; ?>

<div class="container my-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Service</h2>
    <a href="services_list.php" class="btn btn-secondary">Back</a>
  </div>

  <form method="post">

    <div class="mb-3">
      <label class="form-label">Service Name</label>
      <input type="text"
             name="service_name"
             class="form-control"
             value="<?php echo htmlspecialchars($service['service_name']); ?>"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description"
                class="form-control"
                rows="4"
                required><?php echo htmlspecialchars($service['description']); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Hourly Rate (₱)</label>
      <input type="number"
             step="0.01"
             name="hourly_rate"
             class="form-control"
             value="<?php echo htmlspecialchars($service['hourly_rate']); ?>"
             required>
    </div>

    <div class="mb-4">
      <label class="form-label">Status</label>
      <select name="is_active" class="form-select" required>
        <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Active</option>
        <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>Inactive</option>
      </select>
    </div>

    <button type="submit" name="update" class="btn btn-warning">
      Update Service
    </button>

  </form>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>