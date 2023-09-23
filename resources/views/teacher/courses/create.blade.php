<x-master>

  @section('page-title')
  Create New Course
  @endsection


  @section('content')
  <div class="row">
    @if(session('created'))
    <span class="alert alert-success w-50">{{session('created')}}</span>
    @elseif(session('not_created'))
    <span class="alert alert warning">{{session('not_created')}}</span>
    @endif
  </div>
<div class="row">
<div class="col-6">




  <form method="post" action="{{route('course.store')}}" enctype="multipart/form-data">
    @csrf


<div class="mb-3" >
  <label for="image">Course image</label>
<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}">
@error('image')
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
</div>

<div class="mb-3" >
  <label for="name">Name</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
@error('name')
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
</div>
<div class="mb-3">
  <label for="price">Price</label>
<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
@error('price')
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
</div>
<div class="mb-3">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>


</div>  {{-- col div --}}
  
</div>  {{-- row div --}}

<div class="row align-content-center mt-4">
  <a href="{{route('course.index')}}"><button class="btn btn-outline-primary">View All Courses</button></a>
  
</div>






  @endsection

</x-master>