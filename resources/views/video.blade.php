<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Video</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Uploaded Video</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <video id="videoPlayer" class="embed-responsive-item" controls>
                        <source src="{{ url($savedFiles['mid']) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="form-group mt-3">
                    <label for="resolution">Select Resolution:</label>
                    <select id="resolution" name="resolution" class="form-control">
                        <option value="{{ url($savedFiles['low']) }}">240p</option>
                        <option value="{{ url($savedFiles['mid']) }}" selected>360p</option>
                        <option value="{{ url($savedFiles['high']) }}">720p</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('resolution').addEventListener('change', function() {
            var videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.src = this.value;
            videoPlayer.play();
        });
    </script>
</body>
</html>
