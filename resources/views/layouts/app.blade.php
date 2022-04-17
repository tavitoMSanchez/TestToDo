<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="GWMS" content="" />
    <title>Test To-DO</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Styles -->  
</head>

<body class="sb-nav-fixed" style="background-color:whitesmoke">
    <div id="app">
    </div>
    <script src="{{ mix('js/app.js')}}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" type="text/javascript"> </script>
</body>

</html>