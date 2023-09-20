@extends('layouts.app')

@section('content')


    <div class="container">


        <div class="row">

            @if(session('updated'))
            <strong class="alert alert-success w-100">{{session('updated')}}</strong>
            @elseif(session('nothing_changed'))
            <strong class="alert alert-warning w-100">{{session('nothing_changed')}}</strong>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('user.profile.update',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            {{-- Image  --}}

                            <div class="row mb-3">
                      

                              <div class="col-md-6 d-flex justify-content-center">
                                <img src="{{$user->image}}" alt="" height="80px" width="80px" class="rounded-circle border border-info">
                              </div>

                          </div>



                            {{-- Role --}}
                            <div class="row mb-3">
                                <label for="role"
                                    class="col-md-4 col-form-label text-md-end">{{ __('role') }}</label>

                                <div class="col-md-6">


                                    <select class="form-select @error('role') is-invalid @enderror" name="role"
                                        aria-label="Default select example" disabled>
                                        <option selected value='sr'>{{ $user->role }}</option>


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
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" image="image"
                                        value="{{ old('image') }}">
                                    @error('image')
                                        <span class="invalid-feedback" image="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- name --}}

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" name="name" placeholder="Enter Name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{$user->name}}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control "
                                        value="{{$user->email}}" disabled>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- mob --}}
                            <div class="row mb-3">
                                <label for="mob"
                                    class="col-md-4 col-form-label text-md-end">{{ __('mob') }}</label>

                                <div class="col-md-6">
                                    <input id="mob" type="number" name="mob" placeholder="Enter Mobile Number"
                                        class="form-control no-spinners @error('mob') is-invalid @enderror" mob="mob"
                                        value="{{$user->mob}}">

                                    @error('mob')
                                        <span class="invalid-feedback" mob="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- dob  --}}

                            <div class="row mb-3">
                                <label for="dob"
                                    class="col-md-4 col-form-label text-md-end">{{ __('dob') }}</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" name="dob"
                                        class="form-control @error('dob') is-invalid @enderror" dob="dob"
                                        value="{{$user->dob}}" autocomplete="dob" autofocus>

                                    @error('dob')
                                        <span class="invalid-feedback" dob="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- address --}}

                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" name="address" placeholder="Enter Address"
                                        class="form-control @error('address') is-invalid @enderror" address="address"
                                        value="{{$user->address}}">

                                    @error('address')
                                        <span class="invalid-feedback" address="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- gender  --}}
                            <div class="row mb-3">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-end">{{ __('gender') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male" @if ($user->gender == 'male') checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female" @if ($user->gender == 'female') checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                            value="other" @if ($user->gender == 'other') checked @endif>
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
                                <label for="hobbies"
                                    class="col-md-4 col-form-label text-md-end">{{ __('hobbies') }}</label>

                                    @php
                                     $hobbies = explode('-',$user->hobbies)  ; 
                                    @endphp

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="hobbies[]" type="checkbox"
                                            id="inlineCheckbox1" value="cricket"
                                           {{-- {{ strpos( 'cricket',$user->hobbies)===0 || strpos( 'cricket',$user->hobbies)>0 ? 'checked':"" }} --}}
                                           {{ in_array('cricket', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineCheckbox1">Cricket</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="hobbies[]" type="checkbox"
                                            id="inlineCheckbox2" value="football"
                                            {{ in_array('football', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineCheckbox2">Football</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="hobbies[]" type="checkbox"
                                            id="inlineCheckbox3" value="hockey"
                                            {{ in_array('hockey', $hobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineCheckbox3">Hockey</label>
                                    </div>
                                    @error('hobbies')
                                        <span class="invalid-feedback" hobbies="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
