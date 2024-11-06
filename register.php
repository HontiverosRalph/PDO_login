<?php
session_start();
require_once 'core/dbConfig.php';

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    try {
        $query = $pdo->prepare("INSERT INTO users (username, password, first_name, last_name, address, age) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([$username, $password, $first_name, $last_name, $address, $age]);
        
        // Redirect to login page or success message
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        // Check for duplicate entry error code
        if ($e->getCode() == 23000) {
            $error = 'Username already exists. Please choose another one.';
        } else {
            $error = 'Error registering user. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        width: 80%;
        max-width: 400px;
        color: black; /* Set text color to black */
    }

    .close-btn {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #f44336;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Create Account</header>
            <form action="register.php" method="POST">
                <!-- Username -->
                <div class="field">
                    <label>Username:</label>
                    <div class="input"><input type="text" name="username" required></div>
                </div>

                <!-- Password -->
                <div class="field">
                    <label>Password:</label>
                    <div class="input"><input type="password" name="password" required></div>
                </div>

                <!-- First Name -->
                <div class="field">
                    <label>First Name:</label>
                    <div class="input"><input type="text" name="first_name" required></div>
                </div>

                <!-- Last Name -->
                <div class="field">
                    <label>Last Name:</label>
                    <div class="input"><input type="text" name="last_name" required></div>
                </div>

                <!-- Address -->
                <div class="field">
                    <label>Address:</label>
                    <div class="input">
                        <textarea name="address" rows="4" cols="40" required></textarea>
                    </div>
                </div>

                <!-- Age -->
                <div class="field">
                    <label>Age:</label>
                    <div class="input"><input type="number" name="age" required></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn submit">Register</button>
            </form>
            <p class="links">Already have an account? <a href="login.php">Back to Login</a></p>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <p><?php echo htmlspecialchars($error); ?></p>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        // Display the modal if there is an error
        <?php if (!empty($error)): ?>
            document.getElementById("errorModal").style.display = "flex";
        <?php endif; ?>

        // Close modal function
        function closeModal() {
            document.getElementById("errorModal").style.display = "none";
        }
    </script>
</body>
</html>
