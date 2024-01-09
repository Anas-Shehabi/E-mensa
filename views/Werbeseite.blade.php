
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>WebSeite</title>
</head>
<body>

<header >
    <nav >
        @yield('header&nav')
    </nav>

</header>

<main>
    @yield('main')

</main>
<footer>
    @yield('footer')
</footer>
</body>
</html>