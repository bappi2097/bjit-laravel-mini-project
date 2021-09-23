<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
<aside id="colorlib-aside" role="complementary" class="js-fullheight">
    <nav id="colorlib-main-menu" role="navigation">
        <ul>
            <li class="colorlib-active"><a href="index.html">Home</a></li>
            @auth
                <li><a href="javascript::void(0)">Profile</a></li>
                <li><a href="javascript::void(0)">Users</a></li>
                <li><a href="javascript::void(0)">Logout</a></li>
            @endauth
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>

    {{-- <div class="colorlib-footer">
        <h1 id="colorlib-logo" class="mb-4"><a href="index.html"
                style="background-image: url({{ asset('template/images/bg_1.jpg') }});">Andrea
                <span>Moore</span></a></h1>
        <div class="mb-4">
            <h3>Subscribe for newsletter</h3>
            <form action="#" class="colorlib-subscribe-form">
                <div class="form-group d-flex">
                    <div class="icon"><span class="icon-paper-plane"></span></div>
                    <input type="text" class="form-control" placeholder="Enter Email Address">
                </div>
            </form>
        </div>
        <p class="pfooter">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <script>
                document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart"
                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
    </div> --}}
</aside> <!-- END COLORLIB-ASIDE -->
