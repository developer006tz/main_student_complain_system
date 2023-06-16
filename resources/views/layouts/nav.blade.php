
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"> <i class="icon ion-md-menu"></i></a>
        </li>
    </ul>
    @php
$user = Auth::user();
@endphp
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="icon ion-md-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="icon ion-md-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="icon ion-ios-close"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="icon ion-ios-chatbubbles"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="icon ion-ios-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="icon ion-md-clock"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="icon ion-ios-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="icon ion-md-clock"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="icon ion-ios-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="icon ion-md-clock"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="icon ion-md-notifications"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="icon ion-md-mail-unread"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="icon ion-md-people"></i> 8 new complaints
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="icon ion-md-copy"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>@auth
        <li class="nav-item dropdown user-menu">
            @auth
            @php
            $role = Auth::user()->getRoleNames()[0];
            $photo = "profile.png";
            if($role == 'student'){
                $student = Auth::user()->student()->first();
                if($student){
                    $photo = $student->photo ?? $photo;
                    $student_id = $student->id;
                }
            }elseif($role == 'lecturer'){
                $lecturer = Auth::user()->lecture()->first();
                if($lecturer){
                    $photo = $lecturer->image ?? $photo;
                }
            }


            @endphp
            @endauth

        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="@auth{{asset("uploads/$role/$photo")}} @endauth {{asset("uploads/student/default.png")}}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{$user ? $user->name: ''}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="@auth{{asset("uploads/$role/$photo")}} @endauth {{asset("uploads/student/default.png")}}" class="img-circle elevation-2" alt="User Image">

            <p>@auth
              {{$user->name}} - {{$role ?? '-'}}
              <small>Member since: {{$user->created_at}}</small>
              @endauth
            </p>
          </li>
          <!-- Menu Body -->
          <!-- Menu Footer-->
          <li class="user-footer">
                @php
                    $url = !empty($student_id) && $role == 'student' ? url("students/$student_id") :
                        (!empty($lecture_id) && $role == 'lecturer' ? url("lectures/$lecture_id") :
                        url("users/$user->id"));
                @endphp
                <a href="{{ $url }}" class="btn btn-default btn-flat">Profile</a>
            


            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-up-left').submit();" class="btn btn-default text-danger btn-outline-danger btn-flat float-right">Sign out</a>
            <form id="logout-form-up-left" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
          </li>
        </ul>
      </li>
      @endauth
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="icon ion-ios-expand"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
