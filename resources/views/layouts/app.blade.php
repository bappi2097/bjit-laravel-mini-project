@extends('layouts.master')
@section('master')

    <div id="colorlib-page">
        @include('layouts.partials.left-sidebar')
        <div id="colorlib-main">
            <section class="ftco-section ftco-no-pt ftco-no-pb">
                <div class="container">
                    <div class="row d-flex">
                        @yield('content')
                        <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                            <div class="sidebar-box pt-md-4">
                                <form action="#" class="search-form">
                                    <div class="form-group">
                                        <span class="icon icon-search"></span>
                                        <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                                    </div>
                                </form>
                            </div>
                            @include('layouts.partials.categories')
                            @include('layouts.partials.popular', ["posts" => \App\Post::latest()->get()->take(5)])
                            @include('layouts.partials.tags')
                        </div><!-- END COL -->
                    </div>
                </div>
            </section>
        </div><!-- END COLORLIB-MAIN -->
    </div><!-- END COLORLIB-PAGE -->

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>
@endsection
