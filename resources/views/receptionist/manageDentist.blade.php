@extends('patients.patientIndex')


@section('content')
    <main id="main">

        <section id="doctors" class="doctors">
            <div class="container mt-4">

                <div class="col-md-12">
                    <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Dentists</h2>
                    <p class="text-muted"><a href="{{ route('receptionist.dentist.add') }}"><code>Add
                                Dentist</code></a></p>
                </div>

                <div class="row">
                    @foreach ($dentists as $dentist)
                        <div class="col-lg-6 mt-4">
                            <div class="member d-flex align-items-start">
                                <div class="pic">
                                    <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="member-info d-flex flex-column justify-content-between">
                                    <div>
                                        <h4>{{ $dentist->name }}</h4>
                                        <span>Cardiology</span>
                                        <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                                    </div>
                                    <a href="/edit" class="btn btn-primary mt-3 align-self-end">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Doctors Section -->

    </main>
@endsection
