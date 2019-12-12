<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Design Grid</title>
    <meta name="description" content="Design grid overlay for vertical and horizontal alignment.">
    <meta name="author" content="RHE Global">
    <style>
        html, body {
            margin: 0;
        }

        .square {
            display: inline-block;
            height: 72px;
            width: 72px;
            margin-right: 6px;
            float: left;
            background-color: #2d5ab4;
            margin-bottom: 6px;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="container">
        @for($i = 0; $i < 300; $i++)
        <div class="square">{{$i+1}}</div>
        @endfor
    </div>
    <script type="text/javascript" src="/grid?{{$query}}"></script>
</body>
</html>
