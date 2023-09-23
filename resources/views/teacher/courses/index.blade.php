<x-master>

  @section('page-title')
  View All Course
  @endsection

  @section('content')
  <div class="row">
    @if(session('deleted'))
      <strong class="alert alert-danger w-100">&#10540; {{session('deleted')}} </strong>
    @elseif(session('not_deleted'))
    <span class="alert alert-warning w-100">{{session('not_deleted')}}</span>
    @endif
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary ">Your Courses</h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Created On</th>
              <th >Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Created On</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>

            @foreach($courses as $course)
            <tr>
              <td>{{$course->id}}</td>
              <td><img src="{{$course->image}}" alt="Image" height="60px" width="60px" ></td>
              <td><a href="{{route('course.edit',$course->id)}}">{{$course->name}}</a></td>
              <td>{{$course->price}}</td>
              <td>{{$course->created_at->diffForHumans()}}</td>

              <td class="text-center">
                <a href="{{ route('course.show', $course->id) }}" class="btn btn-outline-info d-inline-block">View Enrolled</a>
                <a href="{{ route('comments', $course->id) }}" class="btn btn-outline-info d-inline-block">Comments</a>

                <a href="{{ route('course.notices', $course->id) }}" class="btn btn-warning d-inline-block">Notice</a>
                <a href="{{ route('enroll', $course->id) }}" class="btn btn-success d-inline-block">Enroll</a>
                <form method="post" action="{{ route('course.destroy', $course->id) }}" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            
          

            </tr>

            @endforeach

          </tbody>
        </table>
        <div class="pagination">
          {{ $courses->links('vendor.pagination.bootstrap-5') }}
      </div>
      </div>
    </div>
  </div>

  @endsection



  @section('scripts')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  
    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>


  @endsection
</x-master>