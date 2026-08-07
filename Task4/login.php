<?php
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            
            $user = $stmt->fetch(); 

            if ($user && password_verify($password, $user['password'])) {
                
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email']    = $user['email'];

                header("Location: profile.php");
                exit();
                
            } else {
                $error = "Incorrect email or password!";
            }

        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }

    } else {
        $error = "Please fill in all fields!";
    }

}
?>
<?php
 include 'includes/header.php'; 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<div class="container">

    <h2>Login</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div><br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div><br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account?  <br><a href="register.php">Register here</a></p>

</div>
<script src="./assets/js/main.js"></script>
<?php
include 'includes/footer.php'; 
?>
</body>
</html>