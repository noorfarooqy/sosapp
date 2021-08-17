<!--sidebar-wrapper-->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="{{App\Services\CacheServices::getAppSettings($reset=true)->app_logo}}" class="logo-icon" alt="" />
        </div>
        
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="/"><i class="bx bx-home"></i>Home</a>
                </li>
                <li> <a href="/profile"><i class="bx bx-stats"></i>Dashboard</a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->isAdmin())
        <li class="menu-label">Adminstrator</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-spa"></i>
                </div>
                <div class="menu-title">Submission</div>
            </a>
            <ul>
                <li> <a href="/admin/submission/accepted"><i class="bx bx-right-arrow-alt"></i>Accepted</a></li>
                <li> <a href="/admin/submission/pending"><i class="bx bx-right-arrow-alt"></i>Pending</a></li>
                <li> <a href="/admin/submission/resent"><i class="bx bx-right-arrow-alt"></i>Resent</a></li>
                <li> <a href="/admin/submission/rejected"><i class="bx bx-right-arrow-alt"></i>Rejected</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-comment"></i>
                </div>
                <div class="menu-title">Forums</div>
            </a>
            <ul>
                <li> <a href="/admin/forum?status=all"><i class="bx bx-right-arrow-alt"></i>All discussions</a></li>
                <li> <a href="/admin/forum?status=trending"><i class="bx bx-right-arrow-alt"></i>Trending</a></li>
                <li> <a href="/admin/forum?status=flagged"><i class="bx bx-right-arrow-alt"></i>Flagged</a></li>
                <li> <a href="/admin/forum/categories"><i class="bx bx-right-arrow-alt"></i>Categories</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-edit"></i>
                </div>
                <div class="menu-title">Authors</div>
            </a>
            <ul>
                <li> <a href="/admin/authors?status=all"><i class="bx bx-right-arrow-alt"></i>All authors</a></li>
                <li> <a href="/admin/authors?status=trending"><i class="bx bx-right-arrow-alt"></i>Trending</a></li>
                <li> <a href="/admin/authors?status=flagged"><i class="bx bx-right-arrow-alt"></i>Suspended</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li> <a href="/admin/users?status=all"><i class="bx bx-right-arrow-alt"></i>All users</a></li>
                <li> <a href="/admin/users?status=flagged"><i class="bx bx-right-arrow-alt"></i>Suspended</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-wrench"></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="/admin/settings?platform=web"><i class="bx bx-right-arrow-alt"></i>App settings</a></li>
                <li> <a href="/admin/settings?platform=mobile"><i class="bx bx-right-arrow-alt"></i>Mobile settings</a></li>
            </ul>
        </li>
        @else
        
        @include('user.user_sidebar') 
        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar-wrapper-->
