<x-master>

  @section('page-title')
Enroll Students
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



  <div class="row mb-2">
    @if(session('attached'))
    <strong class="alert alert-success w-100">{{session('attached')}}</strong>
    @endif  
  </div>
  <div class="row mb-2">
    @if(session('detached'))
    <strong class="alert alert-danger w-100">{{session('detached')}}</strong>
    @endif  
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary ">Student List</h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
     
          <thead>
         
            <div class="d-grid gap-2 mb-2 d-md-flex justify-content-md-end">
              <button class="btn btn-danger" type="button">Detach All</button>
            </div>
           
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
       

          @foreach($users as $user)
                  <tr>
                        <td>{{$user->id}}</td>
                        <td><img src="{{$user->image}}" alt="" height="60px" width="60px"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        {{-- ATTACH --}}
                        <td class="d-flex align-items-center">
                          @if($user->hasCourse($user,$course) == false)
                        <form method="post" action="{{route('course.attach',$user->id)}}">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="course_id" value="{{$course->id}}" >
                          <button type="submit" class="btn btn-link"><img src="{{asset('images/add.png')}}" alt="" height="30px" width="30px"></button>
                      </form>
                      @else
                <button type="submit" class="btn btn-link" disabled><img src="{{asset('images/add.png')}}" alt="" height="30px" width="30px"></button>
                      @endif

                        {{-- DETACH --}}
             
                          @if($user->hasCourse($user,$course) == true)
                        <form method="post" action="{{route('course.detach',$user->id)}}">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="course_id" value="{{$course->id}}" >
                          <button type="submit"  class="btn btn-link"  ><img src="{{asset('images/remove.png')}}" alt="" height="30px" width="30px"></button>
                      </form>
                      @else
                <button type="submit"  class="btn btn-link" disabled><img src="{{asset('images/remove.png')}}" alt="" height="30px" width="30px"></button>
                      @endif
                        </td>

                  </tr>
          @endforeach  
        


          </tbody>
        </table>
        <div class="pagination">
          {{ $users->links('vendor.pagination.bootstrap-5') }}
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