<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mijn applicatie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/custom.css">
    <link rel="stylesheet" href="{{ URL::asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/movieStyle.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../includes/js/functions.js"></script>


</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Movies</a>
            </div>

            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php">Home</a></li>


            </ul>
            <ul class="nav navbar-right navbar-nav">
                <li>
                    @if (Route::has('login'))

                        @auth
                            <a href="{{ url('/home') }}">Home</a>

                        @else
                            <a style="color: white" href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))

                                <a style="color: white" href="{{ route('register') }}">Register</a>

                            @endif
                        @endauth

                    @endif
                </li>
            </ul>

        </div>
    </nav>
