<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barista</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* Custom CSS to move the title to the top-left */
        .custom-title {
            text-align: left;
            margin-top: 0;  /* Remove any top margin */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php $getBaristaByID = getBaristaByID($pdo, $_GET['barista_id']); ?>
        
        <!-- Move the title to the upper-left -->
        <h1 class="mb-4" style="position: absolute; top: 0; left: 0;">Edit the Barista</h1>

        <!-- Success/Failure Message (Example) -->
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($successMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($errorMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Edit Barista Form -->
        <form action="core/handleForms.php?barista_id=<?php echo urlencode($_GET['barista_id']); ?>" method="POST">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($getBaristaByID['username']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="firstName" class="form-control" value="<?php echo htmlspecialchars($getBaristaByID['first_name']); ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="lastName" class="form-control" value="<?php echo htmlspecialchars($getBaristaByID['last_name']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                    <input type="date" name="dateOfBirth" class="form-control" value="<?php echo htmlspecialchars($getBaristaByID['date_of_birth']); ?>" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="specialty" class="form-label">Specialty</label>
                <textarea name="specialty" class="form-control" rows="3" required><?php echo htmlspecialchars($getBaristaByID['specialty']); ?></textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" name="editBaristaBtn" class="btn btn-primary btn-lg w-50">Update Barista</button>
            </div>
        </form>
    </div>

    <!-- Link to Bootstrap JS and Popper (for responsive behavior) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
