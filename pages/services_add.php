<?php
include "../db.php";

$message = "";

if (isset($_POST['save'])) {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $hourly_rate = $_POST['hourly_rate'];
    $is_active = $_POST['is_active'];

    if ($service_name == "" || $hourly_rate == "") {
        $message = "Service name and hourly rate are required!";
    } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
        $message = "Hourly rate must be greater than 0.";
    } else {
        $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
                VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";
        mysqli_query($conn, $sql);
        header("Location: services_list.php");
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Service</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../nav.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="mb-4">Add Service</h2>

            <?php if($message != ""): ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Service Name*</label>
                    <input type="text" class="form-control" name="service_name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hourly Rate (₱)*</label>
                    <input type="number" step="0.01" class="form-control" name="hourly_rate" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Active</label>
                    <select class="form-select" name="is_active">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <button type="submit" name="save" class="btn btn-success">Save</button>
                <a href="services_list.php" class="btn btn-secondary ms-2">Cancel</a>

            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>