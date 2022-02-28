<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container-md.card {
            padding: 20px;
            text-align: center;
            margin: 30px auto;
            width: 700px;
        }

    </style>
</head>

<body>



    <div class="container-md card">

        @if(Session::has('success'))
        <div class="btn btn-warning">
               Date has been stored on Database
            </div>
            <br>
            <div class="btn btn-info">
                {{ session()->get('success') }}
            </div>
            <br>
        

        @elseif(Session::has('error'))
            <div class="btn btn-danger">
                {{ session()->get('error') }}
            </div>
            @else
            <div class="btn btn-info">
               Please  Upload Your PDF File
            </div>
            <br>
        @endif
        

        <form class="row g-3" action="{{ route('file.store') }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            <div class="mb-3">
                <!-- <label for="formFileMultiple" class="form-label">Upload Pdf File </label> -->
                <input class="form-control" name="file" type="file" id="formFileMultiple" multiple>
            </div>

            <button type="submit" class="btn btn-outline-info">Save</button>
        </form>
    </div>
</body>

</html>
