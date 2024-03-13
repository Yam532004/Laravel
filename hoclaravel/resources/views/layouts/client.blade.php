<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title')-My Website</title>
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
    @yield('css')
</head>

<body>
    @include('clients.blocks.header')
    <main class="py-5">
        <div class="container">
        <div class="row">
            <div class="col-4">
                <aside>
                    @section('sidebar')
                    @include('clients.blocks.sidebar')
                    @show
                </aside>
            </div>
            <div class="col-8">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
        </div>
    </main>

    @include('clients.blocks.footer')
    <script src="{{asset('assets/clients/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/clients/js/custom.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @yield('js')
    @stack('scripts')
</body>

</html>