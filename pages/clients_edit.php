<?php
include "../db.php";

$id = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);

$message = "";

if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($full_name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
        $sql = "UPDATE clients
                SET full_name='$full_name', email='$email', phone='$phone', address='$address'
                WHERE client_id=$id";
        mysqli_query($conn, $sql);
        header("Location: clients_list.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Client</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Edit Client</h2>

            <?php if($message != ""): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Full Name*</label>
                    <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($client['full_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email*</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($client['address']); ?>">
                </div>

                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="clients_list.php" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>