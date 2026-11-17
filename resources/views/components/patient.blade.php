@php
$settings = DB::table('settings')->first(); 
$user = Auth::user();
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ $settings->website_name }} - @yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Storage::url('img/' . $settings->favicon) }}">
    <!-- CSS Dependencies -->
    <link href="{{ asset('assets/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/slimselect.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
    <!-- Tom Select CSS -->
    <link href="{{ asset('assets/css/tom-select.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="layout-wrapper">
        <div id="preloader">
            <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
        </div>
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- Logo -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('patient.dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                @if($user->profile_image)
                                    <img class="rounded-circle header-profile-user" 
                                        src="{{ asset('storage/img/' . $user->profile_image) }}" 
                                        alt="Header Avatar" 
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                @endif
                            </span>
                            <span class="logo-lg">
                                @if($user->profile_image)
                                    <img class="rounded-circle header-profile-user mt-3" 
                                        src="{{ asset('storage/img/' . $user->profile_image) }}" 
                                        alt="Header Avatar" 
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                                @endif
                            </span>
                        </a>
                        <a href="{{ route('patient.dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                @if($user->profile_image)
                                <img class="rounded-circle header-profile-user" 
                                     src="{{ asset('storage/img/' . $user->profile_image) }}" 
                                     alt="Header Avatar" 
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @endif
                            </span>
                            <span class="logo-lg">
                                @if($user->profile_image)
                                <img class="rounded-circle header-profile-user mt-3" 
                                     src="{{ asset('storage/img/' . $user->profile_image) }}" 
                                     alt="Header Avatar" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            @endif
                            </span>
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- Additional Buttons -->
                    <div class="row">
                        
                        <div class="col-md-4 m-auto">
                            <div class="d-flex"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <!-- Search Dropdown for Mobile -->
                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Dark Mode Light Mode Settings --}}
                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon icon-lg layout-mode-dark"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun icon-lg layout-mode-light"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        </button>
                    </div>
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($user->profile_image)
                                <img class="rounded-circle header-profile-user" src="{{ asset('storage/img/' . $user->profile_image) }}" alt="Header Avatar">
                            @endif
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ $user->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-alt"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled mt-3" id="side-menu">

                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('patient.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <!-- Profile -->
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-alt"></i>
                                <span data-key="t-dashboard">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                {{ $slot }}
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <script>document.write(new Date().getFullYear())</script> RecordSync.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- End Main Content -->
    </div>
    <!-- End Layout Wrapper -->

    <!-- JavaScript Dependencies -->
     <!-- JavaScript Dependencies -->
     <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
     <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
     <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
     <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
     <script src="{{ asset('assets/js/waves.min.js') }}"></script>
     <script src="{{ asset('assets/js/feather.min.js') }}"></script>
     <script src="{{ asset('assets/js/pace.min.js') }}"></script>
     <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard.init.js') }}"></script>
     <script src="{{ asset('assets/js/app.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('assets/js/buttons.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
     <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
     <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
     <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
     <script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
     <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/responsive.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
     <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
     <script src="{{ asset('assets/js/mood.js') }}"></script>
     <script src="{{ asset('assets/js/quill.min.js') }}"></script>
     <script src="{{ asset('assets/js/slimselect.min.js') }}"></script>
     <!-- Tom Select JS -->
     <script src="{{ asset('assets/js/tom-select.complete.min.js') }}"></script>
     
     <!-- DataTable Initialization -->
     <script>
         $(document).ready(function () {
             var table = $('#example').DataTable({
                 lengthChange: false,
                 buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis'],
                 order: [[0, 'desc']]
             });
 
             table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
         });
     </script>
</body>

</html>
