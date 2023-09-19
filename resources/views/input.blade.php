@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
        
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
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



                

 





                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
