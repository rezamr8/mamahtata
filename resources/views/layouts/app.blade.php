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
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"  />

    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/themes/default-dark/style.css') }}">

  <script>
    //   window.oncontextmenu = function () {
    //     return false;
    //     }
    //     $(document).keydown(function (event) {
    //     if (event.keyCode == 123) {
    //     return false;
    //     }
    //     else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
    //     return false;
    //     }
    // });
  </script>
    
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
                        {{ config('app.name', 'NAZMA MEDIA') }}
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
        @if(Session::has('flash_message'))
            <div class="container">      
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif 

        <div class="row">
            <div class="col-md-8 col-md-offset-2">              
                @include ('errors.list') {{-- Including error file --}}
            </div>
        </div>        
        
        <div class="container">
           {{--  @include('admin.sidbebar') --}}
            
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    

    <!-- Scripts -->
   {{--  <script src="{{ asset('js/app.js') }}"></script> --}}
   <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
   <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('js/handlebars.min.js') }}"></script>
   <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
   {{-- <script src="//code.jquery.com/jquery-1.10.2.min.js"></script> --}}
   {{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>    --}}
   <script src="{{ asset('js/select2.min.js') }}"></script>
   <script src="{{ asset('js/jquery.priceformat.min.js')}}"></script>
   <script src="{{ asset('js/autoNumeric.js')}}"></script>
   <script src="{{ asset('js/jstree.min.js')}}"></script>
   <script src="{{ asset('js/rupiah.js')}}"></script>

   {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
   
    
    @yield('footer')    
    
    <script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">Order @{{ harga }}'s OrderDetail</div>
        <table class="table details-table" id="orders-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Panjang</th>
                <th>Lebar</th>
                <th>Luas</th>
                <th>Jasa</th>
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
    <script>
        var treeview = $("#jstree");
        treeview.bind("loaded.jstree", function (event, data) {
        treeview.jstree("open_all");
    });
        
         $('#jstree').jstree({
            'plugins':["wholerow"]
              })
         .bind("select_node.jstree", function (e, data) { 
            
            document.location.href = data.node.a_attr.href; 

        });

          $(".list-group a").dblclick(function(){
               $(".list-group").find(".active").removeClass("active");
               $(this).parent().addClass("active");
            });
    </script>
</body>
</html>
