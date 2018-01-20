<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">   --}}  
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
    <link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"  />

    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Zain Print') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        
        <div class="container">
           {{--  @include('admin.sidebar') --}}
            
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    

    <!-- Scripts -->
   {{--  <script src="{{ asset('js/app.js') }}"></script> --}}
   <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
   {{-- <script src="//code.jquery.com/jquery-1.10.2.min.js"></script> --}}
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>   
   <script src="{{ asset('js/select2.min.js') }}"></script>
   <script src="{{ asset('js/jquery.priceformat.min.js')}}"></script>

   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   
    
    @yield('footer')    
    
    <script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">Order @{{ harga }}'s OrderDetail</div>
        <table class="table details-table" id="orders-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>sub total</th>
            </tr>
            </thead>
        </table>
    </script>

    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
         @if (Session::has('info'))
            toastr.info("{{Session::get('info')}}")
        @endif
    </script>
</body>
</html>
