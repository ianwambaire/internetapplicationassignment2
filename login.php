<?php
session_start(); // Start the session
include_once 'db_connection.php';
include_once 'users.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database(); 
    $db = $database->getConnection(); 

    if ($db === null) {
        die('Database connection failed');
    }

    $user = new User($db); 

    
    $user->email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));

    // Read user by email
    $stmt = $user->readByEmail(); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Check if the email is verified
            if ($row['is_verified'] == 1) {
                // Login successful, set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];

                
                header("Location: dashboard.php");
                exit;
            } else {
                echo 'Please verify your email address before logging in.';
            }
        } else {
            echo 'Invalid email or password.';
        }
    } else {
        echo 'Invalid email or password.';
    }
}
?>

!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>