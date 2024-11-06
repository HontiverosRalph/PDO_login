<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Workspace Booking</title>
	<!-- Include Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJfL5A7JfHgwGqzFZJ8hHtGzfgHsQ4IKuB9cuF8U6Xs1Ztqf7pJNSUkB69Z0" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<?php 
	$getBaristaByID = getBaristaByID($pdo, $_GET['barista_id']); 
	?>
	<div class="container py-5">
	<h1 class="mb-4" style="position: absolute; top: 0; left: 0;">Are you sure you want to delete this booking?</h1>
		
		<!-- Booking Details Container -->
		<div class="card shadow-sm border-primary mb-4">
			<div class="card-header bg-primary text-white">
				<h2 class="card-title mb-0">Booking Details</h2>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Booking ID:</strong> <?php echo $getBaristaByID['barista_id']; ?></li>
					<li class="list-group-item"><strong>Username:</strong> <?php echo $getBaristaByID['username']; ?></li>
					<li class="list-group-item"><strong>First Name:</strong> <?php echo $getBaristaByID['first_name']; ?></li>
					<li class="list-group-item"><strong>Last Name:</strong> <?php echo $getBaristaByID['last_name']; ?></li>
					<li class="list-group-item"><strong>Date Of Birth:</strong> <?php echo $getBaristaByID['date_of_birth']; ?></li>
					<li class="list-group-item"><strong>Specialty:</strong> <?php echo $getBaristaByID['specialty']; ?></li>
					<li class="list-group-item"><strong>Date Added:</strong> <?php echo $getBaristaByID['date_added']; ?></li>
				</ul>
			</div>
		</div>

		<!-- Delete Button Container -->
		<div class="d-flex justify-content-end">
			<form action="core/handleForms.php?barista_id=<?php echo $_GET['barista_id']; ?>" method="POST">
				<button type="submit" name="deleteBaristaBtn" class="btn btn-danger">Delete Booking</button>
			</form>			
		</div>
	</div>

	<!-- Include Bootstrap JS and dependencies -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBKu8Fq8AolV6Sb8B2Xg9Z9kxv59JPbb5phcD8RkWpB+3k9/9" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0w7cJdXzcd2u7U0v/3hTj5ftj6YlQ5Xr1xVPSuHdcA2dd9dX" crossorigin="anonymous"></script>
</body>
</html>
