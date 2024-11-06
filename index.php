<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once 'core/dbConfig.php';
require_once 'core/models.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barista Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #121212;
        color: white;
    }
    .header {
        background-color: #343a40;
        color: white;
    }
    .form-control, .btn {
        background-color: #2d2d2d;
        color: white;
    }
    .form-control:focus, .btn:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
    }
    /* Customize the table styling */
    .table-dark {
        background-color: #343a40; /* Dark background for the table */
        color: white; /* White text for the table */
    }
    .table-dark th, .table-dark td {
        color: white; /* Ensures the text remains white */
    }
    .table-dark tbody tr:nth-child(odd) {
        background-color: #23272b; /* Slightly different shade for odd rows */
    }
    .btn-info, .btn-warning, .btn-danger {
        border-radius: 0.2rem;
    }
</style>

</head>
<body>
    <div class="header py-3 text-center">
        <h1>Welcome To Coffee Shop Barista Management System. Add new Baristas!</h1>
    </div>

    <div class="p-3">
        <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
        
        <!-- Form to add new barista -->
        <form action="core/handleForms.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label> 
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label> 
                <input type="text" name="firstName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label> 
                <input type="text" name="lastName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dateOfBirth" class="form-label">Date of Birth</label> 
                <input type="date" name="dateOfBirth" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label> 
                <textarea name="specialty" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" name="insertBaristaBtn" class="btn btn-success" value="Add Barista">
            </div>
        </form>

        <!-- Table to display all baristas -->
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Specialty</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Fetch and display all baristas
                $getAllBaristas = getAllBaristas($pdo);
                foreach ($getAllBaristas as $row) { 
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['specialty']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                        <td>
                            <a href="viewprojects.php?barista_id=<?php echo $row['barista_id']; ?>" class="btn btn-info btn-sm">View Projects</a>
                            <a href="editbarista.php?barista_id=<?php echo $row['barista_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="deletebarista.php?barista_id=<?php echo $row['barista_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
