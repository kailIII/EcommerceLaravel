
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Furniture Shop </title>

        <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    </head><!--/head-->

    <body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 08084188687</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> richardiyama@yahoo.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">

                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <img src="{{ url('uploads/Logo.JPG') }}" alt="" /><h4>Furniture Shop</h4>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ route('account.orders') }}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> View Cart</a></li>
                                @if (Auth::guest())
                                    <li><a href="/auth/login"><i class="fa fa-lock"></i> Login</a></li>
                                @else
                                    @if (Auth::user()->is_admin == 1)
                                        <li><a href="/admin/categories" target="_blank" ><i class="fa fa-gear" target="_blank"></i> Administration</a></li>
                                    @endif
                                        <li><a href="/auth/logout"><i class="fa fa-lock"></i> Logout {{ Auth::user()->name }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="/" class="active">Home</a></li>
                                <li><a href="/customer/about_us">About Us</a></li>
                                <li><a href="/customer/contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::open(['route'=>'store.search']) !!}
                            <div class="pull-right">
                                 {!! Form::submit('Search', ['class'=>'btn btn-primary', 'id'=> 'search_button' ]) !!}
                            </div>
                            <div class="search_box pull-right">
                                <input type="text" name="search" placeholder="Type here your search..."/>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section>
        <div class="container">

            <div class="row">
                    @yield('categories')
                    @yield('content')
            </div>

        </div>
        <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <ul class="list-inline item-details">
                    <li><a href="http://themifycloud.com">ThemifyCloud</a></li>
                    <li><a href="http://themescloud.org">ThemesCloud</a></li>
                </ul>
            </div>
        </div>
    </section>

    <footer id="footer"><!--Footer-->

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2016 Richardrealiyama Software Solutions</p>
                    <p class="pull-right">Developed by Richard Iyama</p>
                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    <script src="{{ elixir('js/all.js') }}"></script>

    @yield('pagejs')

    </body>
    </html>