<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('icon.png') }}" type="image/x-icon">
</head>
<body class="bg-light">
    
    <div class="container col-xl-5 mt-5 pt-5">
        <div class="card text-center">
            <div class="card-header">
                <h5>Select Pixel</h5>
            </div>
            <div class="card-body">
                <a href="{{ $render720p60Link }}" class="card-text btn btn-success" style="margin-right: 15px;">720p</a>
                <a href="{{ $render480pLink }}" class="card-text btn btn-warning" style="margin-right: 15px;">480p</a>
                <a href="{{ $render240pLink }}" class="card-text btn btn-danger">240p</a>
            </div>
        </div>
    </div>
</body>
</html>