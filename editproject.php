<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Project</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/login.css">
</head>
<body class="bg-dark text-light">
	<div class="container my-5" style="position: relative;">
		<h1 class="mb-4" style="position: absolute; top: 0; left: 0;">Edit the Project</h1>

		<?php $getProjectByID = getProjectByID($pdo, $_GET['project_id']); ?>

		<form action="core/handleForms.php?project_id=<?php echo urlencode($_GET['project_id']); ?>&barista_id=<?php echo urlencode($_GET['barista_id']); ?>" method="POST" class="bg-dark p-5 rounded shadow-sm mt-5">
			<div class="form-group">
				<label for="projectName">Project Name</label>
				<input type="text" name="projectName" class="form-control bg-white text-dark" value="<?php echo htmlspecialchars($getProjectByID['project_name']); ?>" required>
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" class="form-control bg-white text-dark" rows="5" required><?php echo htmlspecialchars($getProjectByID['description']); ?></textarea>
			</div>

			<button type="submit" name="editProjectBtn" class="btn btn-success btn-block">Update Project</button>
		</form>

		<a href="viewprojects.php?barista_id=<?php echo urlencode($_GET['barista_id']); ?>" class="btn btn-outline-light" style="position: absolute; top: 60px; left: 0;">
			<i class="fas fa-arrow-left"></i> View The Projects
		</a>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
