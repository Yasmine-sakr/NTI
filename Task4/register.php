<?php
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                'username' => $username,
                'email'    => $email,
                'password' => $hashedPassword
            ]);
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = 'Username or email already taken.';
            } else {
                $error = 'Registration failed: ' . $e->getMessage();
            }
        }
    } else {
        $error = "All fields are required!";
    }
}

?>
<?php
 include 'includes/header.php'; 
 ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4 text-primary">Create Account</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?php echo $error; ?></div>
        <?php endif; ?>
  
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" n="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="text-center mt-3 mb-0 text-muted">
            Already have an account? <a href="login.php" class="text-decoration-none">Login</a>
        </p>
    </div>
</div>

<?php   
include 'includes/footer.php'; 
?>