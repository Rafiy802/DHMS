@extends('dentists.dentistIndex')

@section('content')
    <main id="main">

        <section id="doctors" class="doctors">
            <div class="container mt-4">
                <div class="card mb-4" style="margin-top: 100px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Profile</h2>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-8 col-md-6">
                                <div class="profile-info">
                                  @foreach($dentists as $dentist)
                                  <form method="POST" action="{{route('dentist.profile.edit', $dentist->user_id)}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$dentist->name}}" required autocomplete="name" autofocus>
                                            </div>
                                        </div>
                                        
                                        <!-- Hiden Input -->
                                        <input id="role" type="hidden" class="form-control" name="role" value="1">
                
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$dentist->email}}" required autocomplete="email" disabled>
                                            </div>
                                        </div>
                
                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                
                                            <div class="col-md-6">
                                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$dentist->address}}" required autocomplete="address">{{$dentist->address}}</textarea>
                                               
                                            </div>
                                        </div>
                
                                        <div class="row mb-3">
                                            <label for="mobile_num" class="col-md-4 col-form-label text-md-end">Mobile Number</label>
                
                                            <div class="col-md-6">
                                                <input id="mobile_num" type="text" class="form-control @error('mobile_num') is-invalid @enderror" name="mobile_num" value="{{$dentist->mobile_num}}" required autocomplete="mobile_num">
                                                
                                            </div>
                                        </div>
                
                                        <div class="row mb-3">
                                            <label for="birthdate" class="col-md-4 col-form-label text-md-end">Birthdate</label>
                
                                            <div class="col-md-6">
                                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{$dentist->birthdate}}" required autocomplete="birthdate" disabled>
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
        </section>

    </main>
@endsection
