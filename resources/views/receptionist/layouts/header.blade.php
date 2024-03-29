<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="index.html">ANAKITA</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('home') }}">Home</a></li>
                {{-- <li><a class="nav-link scrollto" href="#about">About</a></li> --}}
                <!-- <li><a class="nav-link scrollto" href="#services">Services</a></li> -->
                <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('receptionist.medicine.viewAll') }}">Manage Medicines</a></li>
                        <li><a href="{{ route('receptionist.treatment.viewAll') }}">Manage Treatments</a></li>
                    </ul>
                </li>
                <!-- <li><a class="nav-link scrollto" href="#">Appointment</a></li> -->
                <li><a class="nav-link scrollto" href="{{ route('receptionist.dentist.manage') }}">Dentists</a></li>
                <li><a class="nav-link scrollto" href="{{ route('dentist.allPatients.view') }}">Patients</a></li>
                <li class="dropdown"><a href="#"><span>Appointment</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('makeAppointment.view') }}">Make Appointment</a></li>
                        <li><a href="{{ route('receptionist.allAppointment.view') }}">All Appointment</a></li>
                        {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                    class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">TBA</a></li>
                                <li><a href="#">TBA</a></li>
                                <li><a href="#">TBA</a></li>
                                <li><a href="#">TBA</a></li>
                                <li><a href="#">TBA</a></li>
                            </ul>
                        </li>
                        <li><a href="#">TBA</a></li> --}}
                    </ul>
                </li>
                {{-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
                <!-- .navbar -->

                <!-- <a href="{{ route('login') }}" class="appointment-btn scrollto">Login</a> -->
                @guest
                    @if (Route::has('login'))
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav> <!-- <li> -->
            <a class="appointment-btn scrollto" href="{{ route('login') }}">{{ __('Login') }}</a>
            <!-- </li> -->
            @endif
        @else
            <li class="dropdown"><a href="#"><span> {{ Auth::user()->name }}</span> <i
                        class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}</a></li>
                </ul>
            </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endguest
        {{-- <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --> --}}

    </div>
</header><!-- End Header -->
