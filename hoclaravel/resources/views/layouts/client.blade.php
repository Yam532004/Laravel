<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') My Web Page </title>
    @yield('css')
</head>

<body>
    <header>
        HEADER
    </header>
    <main>
        @section('sidebar')
        @include('clients.blocks.sidebar')
        @show
    </main>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        FOOTER
    </footer>
    @yield('js')
</body>

</html>