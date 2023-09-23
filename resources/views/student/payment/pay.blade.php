<x-master>

  @section('page-title')
  Payment
  @endsection

  @section('content')



  <div class="row mb-4" >

    <table class="table text-center border-bottom-warning table-info table-striped" >

      <tr>
        <th>Image</th>
        <th>Course Name</th>
        <th>Course Price</th>
      </tr>
      <tr>
        <td><img src="{{$course->image}}" class="rounded-2" alt="" height="60px" width="60px"></td>
        <td>{{$course->name}}</td>
        <td>{{$course->price}}</td>
      </tr>
    </table>


  </div>
  

  <div class="row">

    <div class="col items-center">



      <form method="post" action="{{route('payment.store',$course->id)}}" class="mx-auto w-50" enctype="multipart/form-data">
        
        @csrf

        <div class="mt-2">
          <label for="name">Name</label>
          <input type="text" name="name" placeholder="Enter Name" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}">
          @error('name')
          <strong class="invalid-feedback">{{$message}}</strong>
          @enderror
        </div>
        <div class="mt-2">
          <label for="card">Card Number</label>
          <input type="text" name="card" placeholder="Enter Card Number" class="form-control  @error('card') is-invalid @enderror" value="{{old('card')}}">
          @error('card')
          <strong  class="invalid-feedback">{{$message}}</strong>
          @enderror
        </div>
        <div class="mt-2">
          <label for="cvv">cvv</label>
          <input type="text" name="cvv" placeholder="Enter cvv" class="form-control  @error('cvv') is-invalid @enderror" value="{{old('cvv')}}">
          @error('cvv')
          <strong class="invalid-feedback">{{$message}}</strong>
          @enderror
        </div>
        <div class="mt-2">
          <label for="expiry_date">Expiry Date</label>
          <input type="date" name="expiry_date" placeholder="Enter Expiry Date" class="form-control  @error('expiry_date') is-invalid @enderror" value="{{old('expiry_date')}}">
          @error('expiry_date')
          <strong class="invalid-feedback">{{$message}}</strong>
          @enderror
        </div>
        <div class="mt-2">
          <label for="">Price</label>
          <input type="text"  class="form-control" value="{{$course->price}}" disabled>
          @error('name')
          <strong class="invalid-feedback">{{$message}}</strong>
          @enderror
        </div>
        <div class="mt-2">
          <label for="pdf" class="col-md-4 col-form-label text-md-end">{{ __('pdf') }}</label>
          <input type="file" name="pdf" class="form-control" >
          @error('pdf')
          <strong class="invalid-feedback">{{$message}} </strong>
          @enderror
        </div>
        <div class="mt-2">
          <button type="submit" class="form-control btn btn-primary">Payment</button>
        </div>
      </form>
    





    </div>

  </div>



  @endsection
</x-master>