@extends('patients.patientIndex')

@section('content')

<main id="main">

    <!-- <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Medilab?</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section> -->

    <!-- <div class="card">

    </div> -->
    <!-- <section id="doctors" class="doctors">
      <div class="container">
    <div class="col-lg-12">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Medical Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                
              </div>
            </div>
          </div>
</div>
</section> -->

<section id="doctors" class="doctors">
<div class="container mt-4">


    <div class="card mb-4" style="margin-top: 100px;">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Patient's Profile</h2>
                            <!-- <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." aria-label="Search">
                                <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                            </div> -->
                        </div>
                        <!-- Grid column -->
                    </div>
                    <div class="row">

          <div class="col-lg-12">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt=""></div>
              <div class="profile-info">
              @foreach($patient as $patient)
                  <h4>{{$patient->name}}</h4>
                  <p>Email :   {{$patient->email}}</p>
                  <p>IC Number :   {{$patient->IC}}</p>
                  <p>Birth Date   :   {{$patient->birthdate}}</p>
                  <p>Mobile Num   :   {{$patient->mobile_num}}</p>
                  <p>Address   :   {{$patient->address}}</p>
              @endforeach
                <a class="appointment-btn scrollto" href="#">Manage Receipt</a>
              </div>
            </div>
          </div>
</div>
                </div>
            </div>
            <section id="doctors" class="doctors">

</main>

@endsection