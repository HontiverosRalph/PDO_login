<?php
session_start();
require_once 'core/dbConfig.php';
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    } else {
        // If login fails, set an error message to display in a popup
        $errorMessage = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            padding: 30px 20px; /* Increase padding for better spacing */
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 400px;
            color: black; /* Set text color to black */
            font-size: 18px; /* Increase font size */
            font-weight: bold; /* Make text bold */
            border: 2px solid #f44336; /* Add border to make the modal stand out */
        }

        .close-btn {
            margin-top: 15px; /* Adjust top margin */
            padding: 8px 15px; /* Smaller padding for a smaller button */
            background-color: #f44336;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 14px; /* Smaller font size */
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="form-box">
                <header>Login</header>
                <form action="" method="POST">
                    <div class="field">
                        <label>Username</label>
                        <div class="input">
                            <input type="text" name="username" required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="input">
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn submit">Login</button>
                </form>

                <div class="links">
                    <p>Don't have an account? <a href="register.php">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for error message -->
    <div id="errorModal" class="modal" style="display: none;">
        <div class="modal-content">
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
            <span class="close-btn" onclick="closeModal()">Close</span>
        </div>
    </div>

    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById("errorModal").style.display = "flex";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("errorModal").style.display = "none";
        }

        // Automatically open the modal if there's an error
        <?php if ($errorMessage): ?>
            openModal();
        <?php endif; ?>
    </script>
</body>
</html>
