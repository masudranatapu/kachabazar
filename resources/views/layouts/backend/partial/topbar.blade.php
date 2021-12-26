<header class="main-header">
   <!-- Logo -->
   <a href="{{ route('login') }}" class="logo">
     <!-- mini logo for sidebar mini 50x50 pixels -->
     <span class="logo-mini" style="padding: 5px;"><img class="img-responsive user-image " width="40px" height="40px"  src="{{ asset('images/small_logo.png') }}" alt=""></span>
     <!-- logo for regular state and mobile devices -->
     <span class="logo-lg"><img class="img-responsive user-image " style="max-width: 100%;max-height: 50px;margin: auto;"  src="{{ asset('images/projanmoit.png') }}" alt=""></span>
   </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top">
     <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" >
       <span class="sr-only">Toggle navigation</span>
     </a>

     <div class="navbar-custom-menu">
       <ul class="nav navbar-nav">




         <!-- User Account: style can be found in dropdown.less -->
         <li class="dropdown user user-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class="img-responsive user-image" style="border-radius: 100%; width: 30px;height:30px;"  src="@if (Auth::user()->image=='default.png')
              {{ asset('frontend/img/profile.png') }}
            @else
              {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}
            @endif" alt="">
             <span class="hidden-xs">{{Auth::user()->name}}</span>
           </a>
           <ul class="dropdown-menu">
             <!-- User image -->
             <li class="user-header">
               <img src="@if (Auth::user()->image=='default.png')
                 ../../../images/profile.png
               @else
                 {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}
               @endif" class="img-circle" alt="User Image">
               <p>
                 {{Auth::user()->name}}
                 <small>{{Auth::user()->about}}</small>
               </p>
             </li>
             <!-- Menu Body -->

             <!-- Menu Footer-->
             <li class="user-footer">
               <div class="pull-left">
                 <a href="" class="btn btn-default btn-flat">Profile</a>
               </div>

               <div class="pull-right">
                  <a class="dropdown-item btn btn-default btn-flat"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out"></i> Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
               </div>

             </li>
           </ul>
         </li>
         <!-- Control Sidebar Toggle Button -->
         <li><a href="{{ url('/') }}" target="blank" title="go to website"><i class="fa fa-globe"></i></a></li>
       </ul>
     </div>
   </nav>
 </header>
