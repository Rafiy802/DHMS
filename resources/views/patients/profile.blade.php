@extends('patients.patientIndex')

@section('content')
    <main id="main">

        <section id="doctors" class="doctors">
            <div class="container mt-4">
                <div class="card mb-4" style="margin-top: 100px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Profile</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 d-flex align-items-center justify-content-center">
                                {{-- <div class="pic">
                                    <img src="{{ asset('assets/img/doctors/doctors-1.jpg') }}"
                                        class="img-fluid rounded-circle" alt=""
                                        style="width: 200px; height: 200px;">
                                </div> --}}
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <div class="profile-info">
                                    @foreach ($patient as $pat)
                                        <h4>{{ $pat->name }}</h4>
                                        <p>Email : {{ $pat->email }}</p>
                                        <p>IC Number : {{ $pat->IC }}</p>
                                        <p>Birth Date : {{ $pat->birthdate }}</p>
                                        <p>Mobile Num : {{ $pat->mobile_num }}</p>
                                        <p>Address : {{ $pat->address }}</p>
                                    @endforeach
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="text-center">
                                  <a class="appointment-btn scrollto" href="{{ route('patients.profile.view') }}">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
