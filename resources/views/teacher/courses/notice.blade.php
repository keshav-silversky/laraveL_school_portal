<x-master>

  @section('page-title')
 Notice Dashboard
  @endsection

  @section('content')

<div class="row">

  @if(session('notice_created'))
  <strong class="alert alert-success w-50">{{session('notice_created')}}</strong>
  @endif
</div>


  <div class="row">
    <div class="col">

      <form method="post" action="{{route('notice.store',$course->id)}}">
        @csrf
        <div class="mb-3" >
          <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Enter Subject" class="form-control w-25   @error('subject') is-invalid @enderror" value="{{old('subject')}}">
        @error('subject')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
        @enderror
        </div>
        <div class="mb-3" >
          <label for="description">Description</label>
        <input type="text" name="description" placeholder="Enter Description" class="form-control w-25 h-50  @error('description') is-invalid @enderror" value="{{old('description')}}">
        @error('description')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
        @enderror
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Add Notice</button>
        </div>

      </form>

    </div>
  </div>


  <div class="row">
    @if(session('deleted'))
    <strong class="alert alert-danger w-100">{{session('deleted')}}</strong>
    @endif
  </div>
  
  @if($notices->isNotEmpty())
  <div class="card shadow mb-4">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary ">Notices</h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Action</th>
          
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Action</th>
     
            </tr>
          </tfoot>
          <tbody>


            @foreach($notices as $notice)
            <tr>
              <td>{{$notice->id}}</td>
              <td>{{$notice->subject}}</td>
              <td>{{$notice->description}}</td>
              <td>
                <form method="post" action="{{route('notice.delete',$notice)}}">
                  @csrf
                  @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
              </td>


            </tr>
            @endforeach

          </tbody>
        </table>
  
      </div>
    </div>
  </div>
  @else
  <div class="container text-center mt-4">
<h1>No Notice Created Yet</h1>
</div>
  @endif

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