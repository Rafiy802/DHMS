@extends('patients.patientIndex')

@section('content')
    <main id="main">
        <div class="container mt-4">
            <div class="card mb-4" style="margin-top: 100px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">My Appointment</h2>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <h5 class="pt-3 pb-4 font-up deep-purple-text">Today Appointment</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Dentist</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($todayAppointment as $today)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $today->day }}</td>
                                        <td>{{ $today->time }}</td>
                                        <td>{{ $today->dentist_name }}</td>
                                        <td>{{ $today->status }}</td>
                                        <td>
                                            @if ($today->status == 'Cancelled')
                                                {{ $today->status }}
                                            @else
                                                <form method="POST" action="{{ route('appointment.cancel', $today->id) }}">
                                                    @csrf
                                                    @method('PUT')
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
                                        <td colspan="6" class="text-center align-middle"><strong>No appointments for
                                                today.</strong></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <h5 class="mt-5 pt-3 pb-4 font-up deep-purple-text">Upcoming Appointment</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Dentist</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentPage = $appointments->currentPage();
                                    $perPage = $appointments->perPage();
                                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $loop->index + $startingNumber }}</th>
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
                                        <td colspan="6" class="text-center align-middle"><strong>No appointments
                                                yet.</strong></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="pagination custom-style">
                                {{ $appointments->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
