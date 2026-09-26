<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Login to Alzikrayat</h2>
    <p class="text-muted">Last login from this computer was: <strong><?php echo htmlspecialchars($lastLogin); ?></strong></p>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="/alzikrayat/public/login" method="POST">
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="/alzikrayat/public/register" class="btn btn-link">Don't have an account? Register</a>
    </form>
</body>
</html>