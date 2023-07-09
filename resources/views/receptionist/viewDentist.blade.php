@extends('receptionist.receptionistIndex')

@section('content')
    <main id="main">

        <section id="doctors" class="doctors">
            <div class="container mt-4">
                <div class="card mb-4" style="margin-top: 100px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Dentist's Info</h2>
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
                                @foreach ($dentists as $dentist)
                                    <div class="profile-info">
                                        <h4>{{ $dentist->name }}</h4>
                                        <p>Email: {{ $dentist->email }}</p>
                                        <p>IC Number: {{ $dentist->IC }}</p>
                                        <p>Birth Date: {{ $dentist->birthdate }}</p>
                                        <p>Mobile Num: {{ $dentist->mobile_num }}</p>
                                        <p>Address: {{ $dentist->address }}</p>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row mt-3">
                                <div class="text-center">
                                    <a class="appointment-btn scrollto"
                                        href="{{ route('receptionist.dentist.editView', $dentist->user_id) }}">Edit Dentist
                                        Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
