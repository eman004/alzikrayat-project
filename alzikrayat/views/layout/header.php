<nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
    <a class="navbar-brand" href="/alzikrayat/public/">Alzikrayat</a>
    <div class="ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="navbar-text me-3">Hi <?php echo htmlspecialchars($_SESSION['first_name']); ?></span>
            <a href="/alzikrayat/public/logout" class="btn btn-outline-danger btn-sm">Logout</a>
        <?php else: ?>
            <span class="navbar-text me-3">Please Login</span>
            <a href="/alzikrayat/public/login" class="btn btn-primary btn-sm">Login</a>
        <?php endif; ?>
    </div>
</nav>