@extends('receptionist.receptionistIndex')

@section('content')
    <main id="main">

        <div class="container mt-4">


            <div class="card mb-4" style="margin-top: 100px;">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">All Appointment</h2>
                            <!-- <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." aria-label="Search">
                            <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                        </div> -->
                        </div>
                        <!-- Grid column -->
                    </div>
                    <a href="{{ route('receptionist.historyAppointment.view') }}" class="btn btn-primary"
                        >View Appointment's History</a>
                    <!-- Grid row -->
                    <!--Table-->
                    <div class="table-responsive">
                        <!-- Add this div to make the table scrollable on smaller screens -->
                        <h5 class="pt-3 pb-4 font-up deep-purple-text">Today Appointment</h5>
                        <table class="table table-striped">
                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Dentist</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>

                                {{-- @php
                                    $currentPage = $todayAppointment->currentPage();
                                    $perPage = $todayAppointment->perPage();
                                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                                @endphp --}}

                                @forelse ($todayAppointment as $today)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->index + $startingNumber }}</th> --}}
                                        <th scope="row">{{ $loop->index + 1}}</th>
                                        <td>{{ $today->patient_name }}</td>
                                        <td>{{ $today->day }}</td>
                                        <td>{{ $today->time }}</td>
                                        <td>{{ $today->dentist_name }}</td>
                                        <td>{{ $today->status }}</td>
                                        <td>
                                            @if ($today->status == 'Cancelled')
                                                {{ $today->status }}
                                            @else
                                                <form method="POST"
                                                    action="{{ route('appointment.cancel', $today->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- <a class="cancel-btn scrollto" href="#">Cancel</a> -->
                                                    <div class="row mb-0">
                                                        <div class="col-md-6">
                                                            <input type="hidden" value="{{ $today->id }}"
                                                                name="appointment_id">
                                                            <input type="hidden" value="Cancelled"
                                                                name="appointment_status">
                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center align-middle"><strong>No appointments for today.</strong></td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <!--Table body-->
                        </table>
                        {{-- <div class="row">
                            <div class="pagination custom-style">
                                {{ $todayAppointment->appends(['tab' => 'today'])->links('pagination::bootstrap-4') }}
                            </div>
                        </div> --}}

                        <h5 class="mt-5 pt-3 pb-4 font-up deep-purple-text">Upcoming Appointment</h5>
                        <table class="table table-striped">
                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Dentist</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>

                                @php
                                    $currentPage = $appointments->currentPage();
                                    $perPage = $appointments->perPage();
                                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                                @endphp

                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $loop->index + $startingNumber }}</th>
                                        <td>{{ $appointment->patient_name }}</td>
                                        <td>{{ $appointment->day }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>{{ $appointment->dentist_name }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>
                                            @if ($appointment->status == 'Cancelled')
                                                {{ $appointment->status }}
                                            @else
                                                <form method="POST"
                                                    action="{{ route('appointment.cancel', $appointment->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- <a class="cancel-btn scrollto" href="#">Cancel</a> -->
                                                    <div class="row mb-0">
                                                        <div class="col-md-6">
                                                            <input type="hidden" value="{{ $appointment->id }}"
                                                                name="appointment_id">
                                                            <input type="hidden" value="Cancelled"
                                                                name="appointment_status">
                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center align-middle"><strong>No appointments yet.</strong></td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <!--Table body-->
                        </table>
                        <div class="row">
                            <div class="pagination custom-style">
                                {{ $appointments->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!--Table-->
                </div>
            </div>
            
        </div>

    </main>
@endsection
