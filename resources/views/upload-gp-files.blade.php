<!-- resources/views/upload.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>Upload File</h1>
    <form action="{{ url('/uploadGPFiles') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="macAddress">MAC Address:</label>
            <input type="text" name="macAddress" id="macAddress" required>
        </div>
        <div>
            <label for="file">File:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>
</html>
