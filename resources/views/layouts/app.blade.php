<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>
    <div id="app">

        <nav class="navbar is-warning" role="navigation" aria-label="main navigation" style="margin-bottom: 20px;">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ route('products') }}">
                    Small Commerce
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <p class="control">
                            <a href="{{ route('retailers')  }}"> Retailers </a>
                        </p>
                    </div>
                </div>
            </div>
        </nav>



        @if($message = \Illuminate\Support\Facades\Session::get('success'))
            <div class="container" style="margin-bottom: 30px;">
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ $message }}
                </div>
            </div>
        @elseif($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="container" style="margin-bottom: 30px;">
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ $message }}
                </div>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer" >
        <div class="content has-text-centered">
            <p>
                <strong>SmallCommerce</strong> by <a href="https://github.com/josefelipetto">José Henrique Felipetto</a>.
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</body>

</html>
