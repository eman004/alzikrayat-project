<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow-sm">
                <h2 class="mb-3 text-center text-primary">Register for Alzikrayat</h2>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="/alzikrayat/public/register" method="POST">
                    <div class="mb-3">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" pattern="[A-Za-z]+" title="Letters only" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" pattern="[A-Za-z]+" title="Letters only" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Occupation</label>
                        <input type="text" name="occupation" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biography / Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <div class="text-center mt-3">
                    <a href="/alzikrayat/public/login">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>