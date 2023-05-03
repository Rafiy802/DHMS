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
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">My Appointment</h2>
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
                @foreach($patient as $pat)
                  <form method="POST" action="{{route('patients.profile.edit', $pat->user_id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$pat->name}}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        
                        <!-- Hiden Input -->
                        <input id="role" type="hidden" class="form-control" name="role" value="1">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$pat->email}}" required autocomplete="email" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$pat->address}}" required autocomplete="address">{{$pat->address}}</textarea>
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile_num" class="col-md-4 col-form-label text-md-end">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile_num" type="text" class="form-control @error('mobile_num') is-invalid @enderror" name="mobile_num" value="{{$pat->mobile_num}}" required autocomplete="mobile_num">
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-end">Birthdate</label>

                            <div class="col-md-6">
                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{$pat->birthdate}}" required autocomplete="birthdate" disabled>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                @endforeach
              </div>
            </div>
          </div>
</div>
                </div>
            </div>
            <section id="doctors" class="doctors">

</main>

@endsection