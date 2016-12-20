<!doctype html>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" href="bower_components/jqcloud2/dist/jqcloud.min.css">
</head>

<body>
    <div class="page-header text-center">
        <h1>Hashtags visualizer <br> <small>popular hash tags ordered by font size</small></h1>
    </div>
    <div class="container">
        <ul class="list-group">
        @foreach($hashTags as $hashTag)
                <li class="list-group-item"><p style="font-size: {{$hashTag['hashTagsWithFontSize']}}px">{{ $hashTag['hashTag'] }}</p></li>
        @endforeach
        </ul>
    </div>

</body>

</html>

