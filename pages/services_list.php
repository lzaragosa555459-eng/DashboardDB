<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Services</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Services</h2>
        <a href="services_add.php" class="btn btn-primary">+ Add Service</a>
    </div>

   
        

            <div class="table-responsive ">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['service_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                            <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
                            <td>
                                <?php if($row['is_active']) { ?>
                                    <span class="badge bg-success">Active</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" 
                                   class="btn btn-sm btn-warning">
                                   Edit
                                </a>
                            </td>
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