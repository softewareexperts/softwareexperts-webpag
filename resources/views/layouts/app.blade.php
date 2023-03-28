<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href={{asset("/css/app.css")}} rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Scripts -->

        {{--  window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>  --}}
    </script>
    <style>      
        .bdge {
          height: 21px;
          background-color: orange;
          color: #fff;
          font-size: 11px;
          padding: 8px;
          border-radius: 4px;
          line-height: 3px;
        }
        
        .comments {
          text-decoration: underline;
          text-underline-position: under;
          cursor: pointer;
        }
        
        .dot {
          height: 7px;
          width: 7px;
          margin-top: 3px;
          background-color: #bbb;
          border-radius: 50%;
          display: inline-block;
        }
        
        .hit-voting:hover {
          color: blue;
        }
        
        .hit-voting {
          cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    @if (Auth::user())
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Dashboard
                    </a>

                    <a class="navbar-brand" href="{{ url('/add_member') }}">
                        ADD Members
                    </a>
                    
                    <a class="navbar-brand" href="{{ url('/create_post') }}">
                        Create Post
                    </a>
                    <a class="navbar-brand" href="{{ url('/all_post') }}">
                        All Posts
                    </a>
                    <a class="navbar-brand" href="{{ url('add/todo') }}">
                        Add Todo
                    </a>
                    <a class="navbar-brand" href="{{ route('add.article') }}">
                        Article
                    </a>
                    <a class="navbar-brand" href="{{ route('show.article') }}">
                       All Article
                    </a>
                    @if(Auth::user()->user_type==1)
                    <a class="navbar-brand" href="{{ Route('make.admin') }}">
                        Assign Roles
                    </a>
                    @endif
                    @else
                    <a class="navbar-brand" href="{{ url('/add_member') }}">
                        My Application
                    </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src={{asset("/js/app.js")}}></script>
    @yield('script')

</body>
</html>
