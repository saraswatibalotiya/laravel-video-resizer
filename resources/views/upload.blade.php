<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Upload a Video</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="videoName">Video Name:</label>
                        <input type="text" class="form-control" id="videoName" name="videoName" required>
                    </div>
                    <div class="form-group">
                        <label for="video">Choose a video file:</label>
                        <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
