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
          <!-- Preloader HTML -->
    {{-- <div id="preloader">
        <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
    </div> --}}

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- Logo -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                @if(file_exists(public_path('storage/img/' . $settings->favicon)))
                                    <img src="{{ asset('storage/img/' . $settings->favicon) }}" alt="Logo" height="24">
                                @endif
                            </span>
                            <span class="logo-lg">
                                <span class="logo-txt">{{ $settings->website_name }}</span>
                            </span>
                        </a>
                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                @if(file_exists(public_path('storage/img/' . $settings->favicon)))
                                    <img src="{{ asset('storage/img/' . $settings->favicon) }}" alt="Logo" height="24">
                                @endif
                            </span>
                            <span class="logo-lg">
                                <span class="logo-txt">{{ $settings->website_name }}</span>
                            </span>
                        </a>
                    </div>
                    
                    

                    <!-- Mobile Menu Button -->
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


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
                    {{-- Dark Mood Light Mood Settings --}}
                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon icon-lg layout-mode-dark"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun icon-lg layout-mode-light"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        </button>
                    </div>
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{--
                            @if($user->profile_image)
                                <img class="rounded-circle header-profile-user" src="{{ asset('storage/img/' . $user->profile_image) }}" alt="Header Avatar">
                            @endif
                            --}}
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ $user->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateProfilePicModal">
                                <i class="fas fa-image"></i> Profile
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
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <!-- Dashboard -->

                        @hasrole('superadmin|admin')

                        <li>
                            <a href="{{ route('menus', ['slug' => 'main-menu']) }}">
                               <i class="fas fa-th-list"></i>
                                <span data-key="t-dashboard">Menus</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-paw"></i>
                                <span data-key="t-authentication">Categories</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('categories.index') }}" data-key="t-register">Categories</a></li>
                                <li><a href="{{ route('indexsubcategory') }}" data-key="t-login">Sub Categories</a></li>
                            </ul>
                        </li>
                  


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-tablets"></i>
                                <span data-key="t-authentication">Med Categories</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('med-categories.index') }}" data-key="t-register">List</a></li>
                                <li><a href="{{ route('med-categories.create') }}" data-key="t-login">Add New</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-pills"></i>
                                <span data-key="t-authentication">Medicines</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('medicines.index') }}" data-key="t-register">Med List</a></li>
                                <li><a href="{{ route('medicines.create') }}" data-key="t-login">Add New Med</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-location-arrow"></i>
                                <span data-key="t-authentication">Locations</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.location.index') }}" data-key="t-register">Country</a></li>
                                <li><a href="{{ route('admin.location.indexstate') }}" data-key="t-login">State</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="{{ route('admin.featured_on.index') }}">
                                <i class="fas fa-bolt"></i>
                                <span data-key="t-dashboard">Featured On</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-hospital"></i>
                                <span data-key="t-authentication">Hospitals</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.hospitals.index') }}" data-key="t-register">All Hospitals</a></li>
                                <li><a href="{{ route('admin.hospitals.create') }}" data-key="t-login">Add Hospital</a></li>
                                <li><a href="{{ route('admin.hospitals.request') }}" data-key="t-login">Hospital Request</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-hospital"></i>
                                <span data-key="t-authentication">Clinic Speciality</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('specialities.index') }}" data-key="t-register">Specialities</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-clinic-medical"></i>
                                <span data-key="t-authentication">Clinics</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.clinics.index') }}" data-key="t-register">All Clinics</a></li>
                                <li><a href="{{ route('admin.clinics.create') }}" data-key="t-login">Add Clinic</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-clinic-medical"></i>
                                <span data-key="t-authentication">Packages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('treatment-categories.index') }}" data-key="t-register">Treatment Categories</a></li>
                                <li><a href="{{ route('treatment-packages.index') }}" data-key="t-register">Package List</a></li>
                                <li><a href="{{ route('treatment-packages.create') }}" data-key="t-register">Create Package</a></li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-hand-holding-usd"></i>
                                <span data-key="t-authentication">Expense</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('expense.add') }}" data-key="t-register">Add Expense</a></li>
                                <li><a href="{{ route('expenses.all') }}" data-key="t-login">All Expense</a></li>
                            </ul>
                        </li>





                        <li>
                            <a href="{{ route('admin.appointments.list') }}">
                                <i class="fas fa-notes-medical"></i>
                                <span data-key="t-dashboard">Appointments</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('free-quotes.index') }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span data-key="t-dashboard">Free Quote</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('careers.index') }}">
                                <i class="fas fa-briefcase"></i>
                                <span data-key="t-dashboard">Career</span>
                            </a>
                        </li>



                        <li>
                            <a href="{{ route('home-settings.edit') }}">
                                <i class="fas fa-cogs"></i>
                                <span data-key="t-dashboard">Home Setting</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-blog"></i>
                                <span data-key="t-authentication">Blog</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('blogs.index') }}" data-key="t-register">Blog List</a></li>
                                <li><a href="{{ route('blogs.create') }}" data-key="t-login">Add New Blog</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-file-alt"></i>
                                <span data-key="t-authentication">Page Generation</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('page_generations.index') }}" data-key="t-register">Page List</a></li>
                                <li><a href="{{ route('page_generations.create') }}" data-key="t-login">Add New Page</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-question-circle"></i>
                                <span data-key="t-authentication">FAQs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('faqs.index') }}" data-key="t-register">FAQ List</a></li>
                                <li><a href="{{ route('faqs.create') }}" data-key="t-login">Add New FAQ</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-podcast"></i>
                                <span data-key="t-authentication">Podcast</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('podcasts.index') }}" data-key="t-register">Podcast List</a></li>
                                <li><a href="{{ route('podcasts.create') }}" data-key="t-login">Add New Podcast</a></li>
                            </ul>
                        </li>




                        <li>
                            <a href="{{ route('notes.index') }}">
                                <i class="fas fa-notes-medical"></i>
                                <span data-key="t-dashboard">Notes</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.reports.index') }}">
                                <i class="fas fa-bug"></i>
                                <span data-key="t-dashboard">Report</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.contacts.index') }}">
                                <i class="fas fa-bug"></i>
                                <span data-key="t-dashboard">Contacts</span>
                            </a>
                        </li>
          
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-hospital-user"></i>
                                <span data-key="t-authentication">Role & Users</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('roles.index')}}" data-key="t-register">Roles</a></li>
                                <li><a href="{{route('users.index')}}" data-key="t-register">All User</a></li>
                                <li><a href="{{route('users.create')}}" data-key="t-login">Add User</a></li>
                            </ul>
                        </li>
                        
                     
                        <!-- Settings -->
                        <hr>
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-alt"></i>
                                <span data-key="t-dashboard">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings') }}">
                                <i class="fas fa-sliders-h"></i>
                                <span data-key="t-dashboard">Settings</span>
                            </a>
                        </li>

                        @elsehasrole('clinic')

                        @if($user->clinic_id != null)
                        <li>
                            <a href="{{ route('admin.clinics.show', $user->clinic_id ?? '') }}">
                                <i class="fas fa-hospital-symbol"></i>
                                <span data-key="t-dashboard">My Clinic</span>
                            </a>
                        </li>
                        @endif

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-clinic-medical"></i>
                                <span data-key="t-authentication">Packages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('treatment-packages.index') }}" data-key="t-register">Package List</a></li>
                                <li><a href="{{ route('treatment-packages.create') }}" data-key="t-register">Create Package</a></li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-users"></i>
                                <span data-key="t-authentication">Users</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('clinic.users.list') }}" data-key="t-register">User List</a></li>
                               
                                
                            </ul>
                        </li>


                        @elsehasrole('patient')


                        <!-- Profile -->
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-alt"></i>
                                <span data-key="t-dashboard">Profile</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('patient.infos.create')}}">
                                <i class="fas fa-folder"></i>
                                <span data-key="t-dashboard">My Medical History</span>
                            </a>                            
                        </li>

                        <li>
                            <a href="{{ route('patient.my.history')}}">
                                <i class="fas fa-folder"></i>
                                <span data-key="t-dashboard">Medical History</span>
                            </a>                            
                        </li>

                        <li>
                            <a href="{{ route('patient.appointments.index')}}">
                                <i class="far fa-calendar-check"></i>
                                <span data-key="t-dashboard">My Appointments</span>
                            </a>                            
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-hand-holding-usd"></i>
                                <span data-key="t-authentication">Report Gallery</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('report_galleries.create') }}" data-key="t-register">Add Report</a></li>
                                <li><a href="{{ route('report_galleries.index') }}" data-key="t-login">All Report</a></li>
                            </ul>
                        </li>


                        @elsehasrole('doctor')


                        <li>
                            <a href="{{ route('doctor-profiles.index') }}">
                                <i class="fas fa-user-alt"></i>
                                <span data-key="t-dashboard">Profile</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-pills"></i>
                                <span data-key="t-authentication">Visiting Hour</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('slots.index') }}" data-key="t-register">Visiting Hour List</a></li>
                                <li><a href="{{ route('slots.create') }}" data-key="t-login">Add Visiting Hour</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('doctor.appointments.index')}}">
                                <i class="far fa-calendar-check"></i>
                                <span data-key="t-dashboard">Appointments</span>
                            </a>                            
                        </li>


                        @elsehasrole('hospital')

                        @if($user->hospital_id != null)
                        <li>
                            <a href="{{ route('admin.hospitals.show', $user->hospital_id) }}">
                                <i class="fas fa-hospital-symbol"></i>
                                <span data-key="t-dashboard">My Hospital</span>
                            </a>
                        </li>
                          @endif


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-clinic-medical"></i>
                                <span data-key="t-authentication">Packages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('treatment-packages.index') }}" data-key="t-register">Package List</a></li>
                                <li><a href="{{ route('treatment-packages.create') }}" data-key="t-register">Create Package</a></li>
                                
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-users"></i>
                                <span data-key="t-authentication">Users</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('hospital.users.list') }}" data-key="t-register">User List</a></li>
                               
                                
                            </ul>
                        </li>

                        @else

                        @endhasrole
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                    @yield('content')


            <!-- Update Profile Picture Modal -->
            <div class="modal fade" id="updateProfilePicModal" tabindex="-1" aria-labelledby="updateProfilePicModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProfilePicModalLabel">Update Profile Picture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if(Auth::user()->profile_picture)
                                <img src="{{ asset('uploads/profile/' . Auth::user()->profile_picture) }}" 
                                     class="img-thumbnail mb-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;" 
                                     alt="Current Profile Image">
                                @endif

                                <input type="file" name="profile_image" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
