@extends('dentists.dentistIndex')


@section('content')
    <main id="main">

        <!-- ======= Appointment Section ======= -->
        <section id="appointment" class="appointment section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Make an Appointment</h2>
                    <p>Please choose the date, time and the patient you want to make an appointment with.</p>
                </div>

                <form action="#" method="POST">
                    {{-- {{ route('makeAppointment.dentist.new') }} --}}
                    @csrf

                    <div class="row">
                        <div class="col-md-3 form-group mt-3">
                            <?php $tomorrow = \Carbon\Carbon::now()
                                ->addDay(1)
                                ->format('Y-m-d'); ?>
                            <input type="date" name="date" class="form-control datepicker" id="date"
                                placeholder="Appointment Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                min="{{ $tomorrow }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" value="Ongoing" name="status">
                        <div class="col-md-3 form-group mt-3">
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
                            @error('time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 form-group mt-3">
                            <select name="patient_id" id="patient_id" class="form-select">
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->user_id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 form-group mt-3">
                            <select name="dentist_id" id="dentist_id" class="form-select">
                                <option value="">Select Dentist</option>
                                @foreach ($dentists as $dentist)
                                    <option value="{{ $dentist->user_id }}">{{ $dentist->name }}</option>
                                @endforeach
                            </select>
                            @error('dentist_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-4"><button class="appointment-btn scrollto" type="submit">Make an
                            Appointment</button></div>
                </form>

            </div>
        </section><!-- End Appointment Section -->

    </main>
@endsection
