@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
        
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

{{-- Role --}}
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('role') }}</label>

                            <div class="col-md-6">
                              
                           
                                <select class="form-select @error('role') is-invalid @enderror" name="role" aria-label="Default select example" >
                                    <option selected value='sr'>---Select Role---</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                    
                                  </select>
                             
                                @error('role')
                                <span class="invalid-feedback" image="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       
                            </div>
                           
                        </div>

                        {{-- Image --}}
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image"  class="form-control @error('image') is-invalid @enderror" image="image" value="{{ old('image') }}" >
                                @error('image')
                                    <span class="invalid-feedback" image="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- name --}}

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" name="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{-- Email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{-- mob --}}
<div class="row mb-3">
    <label for="mob" class="col-md-4 col-form-label text-md-end">{{ __('mob') }}</label>

    <div class="col-md-6">
        <input id="mob" type="number" name="mob" placeholder="Enter Mobile Number" class="form-control no-spinners @error('mob') is-invalid @enderror" mob="mob" value="{{ old('mob') }}">

        @error('mob')
            <span class="invalid-feedback" mob="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- dob  --}}

<div class="row mb-3">
    <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('dob') }}</label>

    <div class="col-md-6">
        <input id="dob" type="date" name="dob"  class="form-control @error('dob') is-invalid @enderror" dob="dob" value="{{ old('dob') }}"  autocomplete="dob" autofocus>

        @error('dob')
            <span class="invalid-feedback" dob="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- address --}}

<div class="row mb-3">
    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

    <div class="col-md-6">
        <input id="address" type="text" name="address" placeholder="Enter Address" class="form-control @error('address') is-invalid @enderror" address="address" value="{{ old('address') }}" >
        @error('address')
            <span class="invalid-feedback" address="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- gender  --}}
<div class="row mb-3">
    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('gender') }}</label>

    <div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio1" value="male" @if(old('gender')=='male') checked @endif>
            <label class="form-check-label" for="inlineRadio1">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio2" value="female" @if(old('gender')=='female') checked @endif>  
            <label class="form-check-label" for="inlineRadio2">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio3" value="other" @if(old('gender')=='other') checked @endif>
            <label class="form-check-label" for="inlineRadio3">Other</label>
          </div>
         @error('gender')
          <span class="invalid-feedback" gender="alert">
              <strong>{{ $message }}</strong>
          </span>
             @enderror

    </div>
</div>

{{-- hobbies --}}

<div class="row mb-3">
    <label for="hobbies" class="col-md-4 col-form-label text-md-end">{{ __('hobbies') }}</label>

    <div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('hobbies') is-invalid @enderror" name="hobbies[]" type="checkbox" id="inlineCheckbox1" value="cricket" {{ in_array('cricket', old('hobbies', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineCheckbox1">Cricket</label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input @error('hobbies') is-invalid @enderror" name="hobbies[]" type="checkbox" id="inlineCheckbox2" value="football" {{ in_array('football', old('hobbies', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="inlineCheckbox2">Football</label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input @error('hobbies') is-invalid @enderror" name="hobbies[]" type="checkbox" id="inlineCheckbox3" value="hockey" {{ in_array('hockey', old('hobbies', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="inlineCheckbox3">Hockey</label>
          </div>
        @error('hobbies')
            <span class="invalid-feedback" hobbies="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
