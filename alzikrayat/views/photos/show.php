<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($photo['title']); ?> - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4 mb-5">
    <a href="/alzikrayat/public/" class="btn btn-secondary mb-3">&larr; Back to Gallery</a>
    <div class="row">
        <div class="col-md-8">
            <img src="/alzikrayat/public/images/uploads/<?php echo htmlspecialchars($photo['file_name']); ?>" class="img-fluid rounded shadow" alt="...">
        </div>
        <div class="col-md-4">
            <h2><?php echo htmlspecialchars($photo['title']); ?></h2>
            <p class="text-muted">Uploaded by <strong><?php echo htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($photo['description'])); ?></p>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $photo['user_id']): ?>
                <a href="/alzikrayat/public/photo/<?php echo $photo['id']; ?>/delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this photo?');">Delete Photo</a>
            <?php endif; ?>
        </div>
    </div>

    <hr class="my-4">
    <h3>Comments</h3>

    <!-- Comments Listing -->
    <div class="mb-4">
        <?php if (empty($comments)): ?>
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="card mb-2">
                    <div class="card-body py-2">
                        <h6 class="card-subtitle mb-1 text-muted small">
                            <?php echo htmlspecialchars($comment['first_name'] . ' ' . $comment['last_name']); ?> 

                        </h6>
                        <p class="card-text mb-0"><?php echo nl2br($comment['comment']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Add Comment Form -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="/alzikrayat/public/comment/store" method="POST">
            <input type="hidden" name="photo_id" value="<?php echo $photo['id']; ?>">
            <div class="mb-3">
                <textarea name="comment" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
        </form>
    <?php else: ?>
        <p class="text-muted"><a href="/alzikrayat/public/login">Login</a> to leave a comment.</p>
    <?php endif; ?>
</body>
</html>