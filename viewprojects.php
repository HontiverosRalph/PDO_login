<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barista Project Management</title>
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
        .card {
            background-color: #2c2f36;
        }
        .card-body {
            background-color: #2c2f36;
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
        .table-dark {
            background-color: #343a40;
            color: white;
        }
        .table-dark th, .table-dark td {
            color: white;
        }
        .table-dark tbody tr:nth-child(odd) {
            background-color: #23272b;
        }
        .btn-info, .btn-warning, .btn-danger, .btn-primary, .btn-success {
            border-radius: 0.2rem;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .alert {
            background-color: #343a40;
            color: white;
            border-color: #6c757d;
        }
        .card-header, .card-footer {
            background-color: #343a40;
            color: white;
        }
        .text-light {
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <a href="index.php" class="btn btn-primary mb-4">Return to Home</a>
        <?php 
        // Get the barista ID from the URL parameter
        $barista_id = $_GET['barista_id']; 
        $getAllInfoByBaristaID = getAllInfoByBaristaID($pdo, $barista_id); 
        ?>

        <?php if ($getAllInfoByBaristaID): ?>
            <div class="card">
                <div class="card-header">
                    <h1 class="display-4 text-uppercase mb-0">Username: <?php echo htmlspecialchars($getAllInfoByBaristaID['username']); ?></h1>
                </div>
                <div class="card-body">
                    <h2 class="mb-4 text-light">Add New Project</h2>
                    <form action="core/handleForms.php?barista_id=<?php echo $barista_id; ?>" method="POST" class="mb-5">
                        <div class="form-group">
                            <label for="projectName" class="text-light">Project Name</label>
                            <input type="text" name="projectName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="text-light">Project Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <button type="submit" name="insertNewProjectBtn" class="btn btn-success">Add Project</button>
                    </form>

                    <h3 class="mb-4 text-light">Projects List</h3>
                    <table class="table table-striped table-bordered table-dark">
                        <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $getProjectsByBarista = getProjectsByBarista($pdo, $barista_id); 
                            ?>
                            <?php foreach ($getProjectsByBarista as $row): ?>
                                <tr class="new-entry">
                                    <td><?php echo htmlspecialchars($row['project_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                                    <td>
                                        <a href="editproject.php?project_id=<?php echo $row['project_id']; ?>&barista_id=<?php echo $barista_id; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="deleteproject.php?project_id=<?php echo $row['project_id']; ?>&barista_id=<?php echo $barista_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">&copy; 2024 Barista Project Management</p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                <h4>No barista found with the provided ID.</h4>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
