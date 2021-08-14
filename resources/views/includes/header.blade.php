<!-- web site Header(main-menu,topbar) area start  -->
<header id="header" class="bg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-3 d-flex align-self-center logo_area1">
                <div class="logo">
                    <a href="/">
                        <img class="img-fluid" src="/assets/images/logo_400x140_ambient_tansparent.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-12 col-xl-9">
                <div id="topbar_area">
                    <div class="top-bar d-flex justify-content-between">
                        <ul class="left">
                            <li>
                                <a href="/archive">
                                    <i class="fas fa-chart-pie"></i>
                                    Archive
                                </a>
                            </li>
                            <li>
                                <a href="/services">
                                    <i class="fas fa-newspaper"></i>
                                    Services
                                </a>
                            </li>
                            <li>
                                <a href="/forum">
                                    <i class="fas fa-clipboard-list"></i>
                                    Forum
                                </a>
                            </li>
                        </ul>
                        <ul class="right">
                            <li>
                                <a href="#">
                                    <i class="fab fa-dropbox"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">
                                    <i class="fas fa-search"></i>
                                </a>
                                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <form method="POST">
                                                <input type="text" class="mr-search" placeholder="Search">
                                                <button type="submit" class="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- logo 2 hide on xl device-->
                <div class="logoarea2">
                    <a href="index.html">
                        <img src="/assets/images/favicon_white.png" alt="">
                    </a>
                </div>
                <!-- logo 2 -->
                <div class="main_mamu">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a href="index.html" class="logo3">
                            <img src="/assets/images/favicon_white.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/aboutus">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/profile/submission/new">New Submission</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/documentations">For Authors</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/blog">News</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        More
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/contactus">Contact us</a>
                                        <a class="dropdown-item" href="/issues/new">Report issue</a>
                                    </div>
                                </li>
                            </ul>
                            @if(Auth::check())
                            <a href="/profile" class="mr_btn_solid" target="_blank"><i class="fa fa-user"></i>
                                Profile</a>
                            @else
                            <a href="/login" class="mr_btn_solid"><i class="fa fa-user"></i> Sign In</a>
                            @endif


                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- web site Header(main-menu,topbar) area start  -->
