<!--header-->
<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
            </a>
        </div>
        <div class="flex-grow-1 search-bar">
            <div class="input-group">
                <div class="input-group-prepend search-arrow-back">
                    <button class="btn btn-search-back" type="button"><i class="bx bx-arrow-back"></i>
                    </button>
                </div>
                <input type="text" class="form-control" placeholder="search" />
                <div class="input-group-append">
                    <button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="right-topbar ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item search-btn-mobile">
                    <a class="nav-link position-relative" href="javascript:;"> <i
                            class="bx bx-search vertical-align-middle"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;"
                        data-toggle="dropdown"> <span class="msg-count">0</span>
                        <i class="bx bx-comment-detail vertical-align-middle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <h6 class="msg-header-title">0 New</h6>
                                <p class="msg-header-subtitle">Messages</p>
                            </div>
                        </a>
                        <div class="header-message-list">
                            <a class="dropdown-item" href="javascript:;">
                                <div class="media align-items-center">
                                    <div class="user-offline">
                                        <img src="https://via.placeholder.com/110x110" class="msg-avatar"
                                            alt="user avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="msg-name">No new message <span class="msg-time float-right"> - </span></h6>
                                        <p class="msg-info">- </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="javascript:;">
                            <div class="text-center msg-footer">View All Messages</div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;"
                        data-toggle="dropdown"> <i class="bx bx-bell vertical-align-middle"></i>
                        <span class="msg-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <h6 class="msg-header-title">0 New</h6>
                                <p class="msg-header-subtitle">Notifications</p>
                            </div>
                        </a>
                        <div class="header-notifications-list">
                            <a class="dropdown-item" href="javascript:;">
                                <div class="media align-items-center">
                                    <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="msg-name">No notifications<span class="msg-time float-right"> - </span></h6>
                                        <p class="msg-info"> - </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="javascript:;">
                            <div class="text-center msg-footer">View All Notifications</div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-user-profile">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-toggle="dropdown">
                        <div class="media user-box align-items-center">
                            <div class="media-body user-info">
                                <p class="user-name mb-0">{{Auth::user()->name}}</p>
                                <p class="designattion mb-0">Available</p>
                            </div>
                            <img src="{{Auth::user()->ProfileData->profile_picture}}" class="user-img" alt="user avatar">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                        <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                        <a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
                        <div class="dropdown-divider mb-0"></div> 
                        <a class="dropdown-item" href="javascript:;"
                        onclick="event.preventDefault(); document.querySelector('form#logoutForm').submit()"><i class="bx bx-power-off"></i><span>Logout</span></a>
                        <form action="{{route('logout')}}" method="post" id="logoutForm">@csrf</form>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-language">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-toggle="dropdown">
                        <div class="lang d-flex">
                            <div><i class="flag-icon flag-icon-um"></i>
                            </div>
                            <div><span>En</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                        <a class="dropdown-item" href="javascript:;"><i class="flag-icon flag-icon-um"></i><span>English</span></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--end header-->
