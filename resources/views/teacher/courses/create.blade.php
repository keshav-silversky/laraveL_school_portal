<x-master>

  @section('page-title')
  <h1>Create New Course</h1>
  @endsection

  @section('content')

  <div class="row">
<div class="col-6">
{{-- hello --}}
  <div class="row">
  <div class="col 3">
  </div>

  <div class="form-group">
    <form method="post" action="">
      @csrf
    
      <input type="text" name="name" value="" class="form-control w-50"><br>
      <button type="submit" class="btn btn-primary w-50">Create</button>

    </form>
  </div>
</div>
</div>


<div>
<a href=""><button class="btn btn-primary">View Roles</button></a>
</div>



{{-- hello --}}



</div>



  </div>

  @endsection

</x-master>