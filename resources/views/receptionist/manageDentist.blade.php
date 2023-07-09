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
                        <div class="member d-flex align-items-center">
                            <div class="member-info d-flex flex-column justify-content-between justify-content-center"> 
                                <div>
                                    <h4>{{ $dentist->name }}</h4>
                                    <span></span>
                                    <?php
                                    $joined = \Carbon\Carbon::parse($dentist->created_at)->format('Y-m-d');
                                    ?>
                                    <p>Joined since {{ $joined }}</p>
                                </div>
                                <a href="{{ route('receptionist.dentist.view', $dentist->dentist_id) }}" class="btn btn-primary mt-3 align-self-start">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Doctors Section -->

    </main>
@endsection
