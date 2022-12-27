<header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('techblog/')}}"><img src="{{ asset('images/version/tech-logo.png') }}" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('techblog/')}}">Home</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('techblog/about')}}">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('techblog/contact')}}">Contact Us</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav mr-2">
                            <div class="float-end">
                            @if(Session::get('loginid') == true)
                                <a href="{{url('admin/dashboard')}}"><button class="btn">Dashboard</button></a>
                            @else
                                <a href="{{url('admin/login')}}"><button class="btn">Login</button></a>
                            @endif
                            </div>
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->