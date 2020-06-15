<?php
    $sess_user = Auth::user();
    $usertype = session('usertype');
    $moduleNameArr = [];
    if($usertype == 'employee') {
        if(auth()->guard($usertype)->user()) {
            $id = auth()->guard($usertype)->user()->id;
            $userInfo = \App\User::where('id', $id)->with(['PermissionModule' => function($query) {
                $query->select('group_id','module_id');
            }, 'PermissionModule.ModuleName:id,slug,name'])->first();
            foreach ($userInfo->PermissionModule as $row) {
                $moduleNameArr[] = $row->ModuleName->name;
            }
            // dd($moduleNameArr);
        }
    }
?>
{{-- @php
    dd(Route::current()->getName());
@endphp --}}
<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="profile-img"> <img src="{{ $sess_user->photo ? asset('storage/'.$sess_user->photo) : asset('assets/images/dummy-avatar.png')}} " alt="user" /> </div>
            <div class="profile-text">
            <a href="{{ url('my-company') }}" aria-haspopup="true" aria-expanded="true">
                    <?php
                        echo ($sess_user->name != null) ? $sess_user->name : 'N/A';
                    ?>
                </a>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">PERSONAL</li>
                <li {{ request()->is('my-company') ? 'class=active' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ url('my-company') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">{{__('Dashboard')}} </span>
                    </a>
                </li>
                @if ($usertype == 'admin')
                    <li {{ request()->is('admin/groups') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('admin/groups') }}" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu">Groups</span>
                        </a>
                    </li>
                @endif

                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('users', $moduleNameArr)))
                   
                    <li {{ request()->is('admin/users') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('users') }}" aria-expanded="false">
                            <i class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('sites', $moduleNameArr)))
                    <li {{ request()->is('sites') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('sites') }}" aria-expanded="false">
                            <i class="mdi mdi-google-maps"></i>
                            <span class="hide-menu">Sites</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('activities', $moduleNameArr)))
                    <li {{ request()->is('activities') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('activities') }}" aria-expanded="false">
                            <i class="mdi mdi-run"></i>
                            <span class="hide-menu">Activity</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('protected-areas', $moduleNameArr)))
                    <li {{ request()->is('protected-areas') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('protected-areas') }}" aria-expanded="false">
                            <i class="mdi mdi-flower"></i>
                            <span class="hide-menu">Protected Areas</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('pages', $moduleNameArr)))
                    <li {{ request()->is('pages') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('pages') }}" aria-expanded="false">
                            <i class="mdi mdi-library-books"></i>
                            <span class="hide-menu">Custom Pages</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('messages', $moduleNameArr)))
                    <li {{ request()->is('messages') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('messages') }}" aria-expanded="false">
                            <i class="mdi mdi-message-text-outline"></i>
                            <span class="hide-menu">Messages</span>
                        </a>
                    </li>
                    @endif
                    
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('newsletter', $moduleNameArr)))
                    <li {{ request()->is('newsletter') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('newsletter') }}" aria-expanded="false">
                            <i class="mdi mdi-library"></i>
                            <span class="hide-menu">Newsletter</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('entities', $moduleNameArr)))
                    <li {{ request()->is('entities') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('entities.index') }}" aria-expanded="false">
                            <i class="fa fa-braille"></i>
                            <span class="hide-menu">Entities</span>
                        </a>
                    </li>
                @endif

                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('vessels', $moduleNameArr)))
                    <li {{ request()->is('vessels') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('vessels.index') }}" aria-expanded="false">
                            <i class="fa fa-ship"></i>
                            <span class="hide-menu">Vessels</span>
                        </a>
                    </li>
                @endif
                  @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('Vehicles', $moduleNameArr)))
                    <li {{ request()->is('Vehicles') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('Vehicles.index') }}" aria-expanded="false">
                           <i class="fa fa-car" aria-hidden="true"></i>
                            <span class="hide-menu">Vehicles</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('news-events', $moduleNameArr)))
                    <li {{ request()->is('newsevents') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('newsevents.index') }}" aria-expanded="false">
                            <i class="fa fa-bullhorn"></i>
                            <span class="hide-menu">News/Events</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('organizations', $moduleNameArr)))
                    <li {{ request()->is('organizations') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('organizations') }}" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu">Organizations</span>
                        </a>
                    </li>
                @endif
                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('registration-requests', $moduleNameArr)))
                    <li {{ request()->is('registration-requests') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('registration-requests') }}" aria-expanded="false">
                            <i class="fa fa-user-plus"></i>
                            <span class="hide-menu">Registration requests</span>
                        </a>
                    </li>
                @endif

                @if (($usertype == 'admin') || ($usertype == 'employee' && in_array('e-tickets', $moduleNameArr)))
                    <li {{ request()->is('e-tickets') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('e-tickets') }}" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="hide-menu">E Tickets</span>
                        </a>
                    </li> 
                
                {{-- @elseif($usertype == 'employee') --}}
                    {{-- <li {{ request()->is('organizations') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('organizations') }}" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu">Organizations</span>
                        </a>
                    </li>
                    <li {{ request()->is('registration-requests') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('registration-requests') }}" aria-expanded="false">
                            <i class="fa fa-user-plus"></i>
                            <span class="hide-menu">Registration requests</span>
                        </a>
                    </li>
                    <li {{ request()->is('e-tickets') ? 'class=active' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ url('e-tickets') }}" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="hide-menu">E Tickets</span>
                        </a>
                    </li> --}}
                @elseif ($usertype == 'owner')
                    {{-- <li class=""> <a class="waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="mdi mdi-package-variant"></i><span class="hide-menu">Permits</span></a> --}}
                    </li>
                    {{-- <li class=""> <a class="waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">Units</span></a> --}}
                    </li>
                    {{-- <li class=""> <a class="waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="mdi mdi-image-area"></i><span class="hide-menu">Protected Area</span></a> --}}
                    </li>
                    {{-- <li class=""> <a class="waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="mdi mdi-source-branch"></i><span class="hide-menu">Branches</span></a> --}}
                    </li>
                <li class=""> <a class="waves-effect waves-dark" href="{{route('booking.index')}}" aria-expanded="false"><i class="mdi mdi-ticket"></i><span class="hide-menu">{{__('Booking')}}</span></a>
                    </li>
                <li class=""> <a class="waves-effect waves-dark" href="{{route('booking.tickets')}}" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">{{__('Tickets')}}</span></a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="sidebar-footer">
        <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <a href="#" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
</aside>
