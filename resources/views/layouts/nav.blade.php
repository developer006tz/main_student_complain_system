
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
        @php 

        $messages = App\Models\Message::where('user_id', auth()->user()->id)->latest()
                ->paginate(2);
                $total = App\Models\Message::where('user_id', auth()->user()->id)->count();

        @endphp
        
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="icon ion-ios-chatbubbles"></i>
                <span class="badge badge-danger navbar-badge">{{$total ?? '-'}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @forelse($messages as $message)
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('logo.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                               <strong>{{$message->user->name ?? '-'}}</strong>
                                <span class="float-right text-sm text-danger"><i class="icon ion-ios-star"></i></span>
                            </h3>
                            <p class="text-sm"> {{$message->body}} </p>
                            <p class="text-sm text-muted"><i class="icon ion-md-clock"></i>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                @empty
                <div class="empty">No messages yet</div>
                @endforelse
                <a href="{{ route('messages.index') }}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->@auth
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
          <img src="@auth{{asset("uploads/student/$photo")}} @else {{asset("uploads/student/default.png")}} @endauth" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{$user ? $user->name: ''}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="@auth{{asset("uploads/student/$photo")}} @else {{asset("uploads/student/default.png")}} @endauth" class="img-circle elevation-2" alt="User Image">

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
