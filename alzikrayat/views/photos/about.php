<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 shadow-sm">
        <a class="navbar-brand fw-bold" href="/alzikrayat/public/">📷 Alzikrayat</a>
        <div class="ms-auto">
            <a href="/alzikrayat/public/" class="btn btn-outline-light btn-sm me-2">Home</a>
            <a href="/alzikrayat/public/about" class="btn btn-light btn-sm me-2">About Us</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/alzikrayat/public/logout" class="btn btn-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="/alzikrayat/public/login" class="btn btn-primary btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white p-5 rounded shadow-sm">
                <h1 class="mb-4 text-primary">About Alzikrayat</h1>
                <p class="lead"><strong>Alzikrayat</strong> is a custom-built, MVC-based photo sharing web application designed to demonstrate robust core web engineering principles without relying on automated frameworks</p>
                
                <hr class="my-4">

                <h3 class="h5 text-dark">Engineering Architecture</h3>
                <p>The application strictly implements a 3-Tier physical boundary combined with a custom Model-View-Controller pattern:</p>
                <ul>
                    <li><strong>Presentation Tier:</strong> Dynamic HTML5 templates styled completely with responsive Bootstrap UI components.</li>
                    <li><strong>Application Tier:</strong> Core request handlers, input validators, session controllers, and a custom manual Regular Expression Router</li>
                    <li><strong>Data Tier:</strong> Normalized relational MySQL schemas managed via raw, parameterized PHP PDO queries</li>
                </ul>

                <h3 class="h5 text-dark mt-4">Project Purpose</h3>
                <p>Developed as part of the Advanced Web Technologies course, Alzikrayat emphasizes deep mastery over fundamental application mechanics, secure Bcrypt password hashing, session cookies, and strict data ownership validation.</p>

                <div class="mt-4">
                    <a href="/alzikrayat/public/" class="btn btn-primary">&larr; Back to Gallery</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>