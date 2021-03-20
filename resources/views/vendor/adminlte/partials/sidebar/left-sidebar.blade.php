<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
                <a class="nav-link mb-4" href="">
                    <i class="nav-icon fa fa-user"></i>&nbsp;<p class="text">Profile</p>
                </a>
                <hr>
            </li>

            @if(($base_isAdmin))
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-fw fa-user"></i>&nbsp;<p class="text">Users</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('tests.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-file-medical"></i>&nbsp;<p class="text">Tests</p>
                </a>
            </li>

            @endif


            @if(($base_isAdmin || $base_isUser))
            <li class="nav-item">
                <a href="{{ route('appointments.index') }}" class="nav-link">
                  <i class="nav-icon far fa-calendar-check"></i>&nbsp;<p class="text">Appointments</p>
                </a>
            </li>
            @endif
            
            <li class="nav-item">
                <a href="{{ route('tests.show') }}" class="nav-link">
                  <i class="nav-icon far fa-list-alt"></i>&nbsp;<p class="text">Test Details</p>
                </a>
            </li>

                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
