@extends('patients.patientIndex')


@section('content')
    <main id="main">

        <!-- ======= Appointment Section ======= -->
        <section id="appointment" class="appointment section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Make an Appointment</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <form action="{{ route('makeAppointment.new') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 form-group mt-3">
                            <input type="date" name="date" class="form-control datepicker" id="date"
                                placeholder="Appointment Date" data-rule="minlen:4"
                                data-msg="Please enter at least 4 chars">

                        </div>
                        <input type="hidden" value="{{ Auth::user()->user_id }}" name="patient_id">
                        <input type="hidden" value="Ongoing" name="status">
                        <!-- <div class="col-12 col-sm-6">
                    <div class="date" id="date" data-target-input="nearest">
                        <input type="date" class="form-control datepicker" placeholder="Appointment Date" data-target="#date" data-toggle="datetimepicker" style="height: 55px;" name="date">
                    </div>
                </div> -->
                        <div class="col-md-4 form-group mt-3">
                            <select name="time" id="time" class="form-select">
                                <option value="">Select Time</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="10:15:00">10:15 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="10:45:00">10:45 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="11:15:00">11:15 AM</option>
                                <option value="11:30:00">11:30 AM</option>
                                <option value="11:45:00">11:45 AM</option>
                                <option value="12:00:00">12:00 AM</option>
                                <option value="12:15:00">12:15 AM</option>
                                <option value="12:30:00">12:30 AM</option>
                                <option value="12:45:00">12:45 AM</option>
                                <option value="13:00:00">01:00 PM</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="dentist" id="dentist" class="form-select">
                                <option value="">Select Dentist</option>
                                @foreach ($dentists as $dentist)
                                    <option value="{{ $dentist->user_id }}">{{ $dentist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center"><button class="appointment-btn scrollto" type="submit">Make an
                            Appointment</button></div>
                </form>

            </div>
        </section><!-- End Appointment Section -->

    </main>
@endsection
