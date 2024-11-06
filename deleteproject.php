<?php require_once 'core/dbConfig.php'; ?> 
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Project</title>
	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/login.css">
</head>
<body class="bg-dark text-light">

	<div class="container mt-5">
		<?php 
		// Fetch project information using project ID
		$project_id = $_GET['project_id'];
		$getProjectByID = getProjectByID($pdo, $project_id); 
		?>
		
		<h1 class="mb-4" style="position: absolute; top: 0; left: 0;">Are you sure you want to delete this project?</h1>
		
		<div class="card shadow-sm bg-dark text-light">
			<div class="card-body">
				<?php if ($getProjectByID): ?>
					<h4 class="card-title">Project Name: <?php echo htmlspecialchars($getProjectByID['project_name']); ?></h4>
					<p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($getProjectByID['description']); ?></p>
					<p class="card-text"><strong>Barista ID:</strong> <?php echo htmlspecialchars($getProjectByID['barista_id']); ?></p>
					<p class="card-text"><strong>Date Added:</strong> <?php echo htmlspecialchars($getProjectByID['date_added']); ?></p>
					
					<form action="core/handleForms.php?project_id=<?php echo urlencode($project_id); ?>&barista_id=<?php echo urlencode($getProjectByID['barista_id']); ?>" method="POST">
						<div class="form-group text-center">
							<input type="submit" name="deleteProjectBtn" value="Delete Project" class="btn btn-danger btn-lg">
						</div>
					</form>
				<?php else: ?>
					<p class="text-danger">No project found with the provided ID.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
