@extends('patients.patientIndex')

@section('content')

<main id="main">

<div class="container mt-4">


    <div class="card mb-4" style="margin-top: 100px;">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">All Patients</h2>
                            <!-- <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." aria-label="Search">
                                <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                            </div> -->
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                    <!--Table-->
                    <table class="table table-striped">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Registered On</th>
                                <th>Action</th>
                                <!-- <th>Dentist</th>
                                <th>Status</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$patient->name}}</td>
                                    <td> TBA </td>
                                    <td>
                                    <a href="{{route('dentist.patient.view', $patient->patient_id)}}">View More Info</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>
            </div>
</div>

</main>

@endsection