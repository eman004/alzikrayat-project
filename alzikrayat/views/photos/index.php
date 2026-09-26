<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alzikrayat - Modern Photo Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-banner {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 5rem 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        .card-img-top {
            transition: transform 0.5s ease;
        }
        .card:hover .card-img-top {
            transform: scale(1.05);
        }
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-left: 5px solid #2a5298;
        }
    </style>
</head>
<body>

    <!-- Modern Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3 shadow-sm">
        <a class="navbar-brand fw-bold fs-4" href="/alzikrayat/public/"><i class="fa-solid fa-camera-retro text-primary me-2"></i>Alzikrayat</a>
        <div class="ms-auto d-flex align-items-center">
            <a href="/alzikrayat/public/" class="btn btn-outline-light btn-sm me-2">Home</a>
            <a href="/alzikrayat/public/about" class="btn btn-outline-light btn-sm me-3">About Us</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="text-light me-3">Welcome, <strong><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong></span>
                <a href="/alzikrayat/public/photo/create" class="btn btn-success btn-sm me-2"><i class="fa-solid fa-upload me-1"></i> Upload</a>
                <a href="/alzikrayat/public/logout" class="btn btn-outline-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="/alzikrayat/public/login" class="btn btn-primary btn-sm px-3">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Hero Section -->
        <div class="hero-banner text-center">
            <h1 class="display-4 fw-bold mb-3">Preserve Your Cherished Memories</h1>
            <p class="lead mb-4">A secure, high-performance community platform built on custom MVC architecture.</p>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="/alzikrayat/public/register" class="btn btn-light btn-lg text-primary fw-bold px-4 shadow">Get Started Now</a>
            <?php endif; ?>
        </div>

        <!-- Statistics Row -->
        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="stat-card">
                    <h3 class="fw-bold text-primary"><?php echo count($photos); ?></h3>
                    <p class="text-muted mb-0">Memories Uploaded</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-left-color: #198754;">
                    <h3 class="fw-bold text-success">Secure</h3>
                    <p class="text-muted mb-0">Bcrypt Authentication & PDO</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-left-color: #ffc107;">
                    <h3 class="fw-bold text-dark">100%</h3>
                    <p class="text-muted mb-0">Custom MVC & Manual Router</p>
                </div>
            </div>
        </div>

        <!-- Gallery Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-secondary">Community Gallery</h2>
        </div>

        <!-- Photo Grid Layout -->
        <div class="row g-4">
            <?php if (empty($photos)): ?>
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded shadow-sm">
                        <i class="fa-regular fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted fs-5">No photos found in the gallery yet. Be the first to share a memory!</p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/alzikrayat/public/photo/create" class="btn btn-primary mt-2">Upload First Photo</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($photos as $photo): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div style="height: 240px; overflow: hidden;">
                                <img src="/alzikrayat/public/images/uploads/<?php echo htmlspecialchars($photo['file_name']); ?>" class="card-img-top w-100 h-100 object-fit-cover" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold text-dark"><?php echo htmlspecialchars($photo['title']); ?></h5>
                                <p class="card-text text-muted small mb-3">
                                    <i class="fa-regular fa-user me-1"></i> By <?php echo htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']); ?>
                                </p>
                                <a href="/alzikrayat/public/photo/<?php echo $photo['id']; ?>" class="btn btn-outline-primary btn-sm mt-auto fw-semibold">View Details & Comments</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modern Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0 text-muted">&copy; 2026 Alzikrayat Photo Sharing Application. Built with Pure PHP & Bootstrap.</p>
    </footer>

</body>
</html>