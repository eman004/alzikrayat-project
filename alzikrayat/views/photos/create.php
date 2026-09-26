<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Photo - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Upload a New Memory</h2>
    <form action="/alzikrayat/public/photo/store" method="POST" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Photo Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Choose Image File</label>
            <input type="file" name="photo" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
        <a href="/alzikrayat/public/" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>