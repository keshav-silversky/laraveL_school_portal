<x-master>

  @section('page-title')
  Edit Course
  @endsection


  @section('content')
  <div class="row">
    @if(session('updated'))
    <span class="alert alert-success w-50">{{session('updated')}}</span>
    @elseif(session('not_updated'))
    <span class="alert alert-warning w-50">{{session('not_updated')}}</span>
    @endif
  </div>
<div class="row">
<div class="col-6">

  <form method="post" action="{{route('course.update',$course)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3" >
    <img src="{{$course->image}}" class="shadow-4-strong border border-warning" alt="image" height="120px" width="120px">
    </div>

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
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$course->name}}">
@error('name')
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
</div>
<div class="mb-3">
  <label for="price">Price</label>
<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$course->price}}">
@error('price')
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
</div>
<div class="mb-3">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
</form>

</div>  {{-- col div --}}
  
</div>  {{-- row div --}}





  @endsection

</x-master>