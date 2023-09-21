<x-master>
  @section('page-title')
  Student Dashboard
  @endsection

  @section('content')

  <div class="row container">
    <form method="get" action="{{route('search.by.student')}}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search Course or Teacher"
          aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm">Search</i>
          </button>
        </div>
      </div>
    </form>


  </div>




  <div class="row">
    @if(session('payment_success'))
    <span class="alert alert-success w-100">{{session('payment_success')}}</span>
    @endif
  </div>
  <div class="row">
    @if(session('progress_updated'))
    <span class="alert alert-success w-100">{{session('progress_updated')}}</span>
    @endif
  </div>
  <div class="row">
    @if(session('certificate'))
    <span class="alert alert-warning w-100">{{session('certificate')}}</span>
    @endif
  </div>
  
  


  <div class="card shadow mb-4 mt-2">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary ">My Courses</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <div class="d-grid gap-2 mb-2 d-md-flex justify-content-md-end mr-10">

              <a href="{{route('notice.show',auth()->user()->id)}}"><button class="btn btn-warning" type="button">&#9888; Notices</button></a>
            </div>
            <tr>
              <th>Image</th>
              <th>Course Name</th>
              <th>Price</th>
              <th>Assigned By</th>
              <th>Action</th>
              <th>Payment</th>
          
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Image</th>
              <th>Course Name</th>
              <th>Price</th>
              <th>Assigned By</th>
              <th>Action</th>
              <th>Payment</th>

            </tr>
          </tfoot>
          <tbody>


            @foreach($courses->enroll as $course)
            <tr>
              <td><img src="{{$course->image}}" alt="courseImage" width="60px"></td>
              <td>{{$course->name}}</td>
              <td>{{$course->price}}</td>
              <td>{{$course->user->name}}</td>
              <td>
                <a href="{{route('student.list',$course->id)}}"><button class="btn btn-outline-info">View</button></a>
                <a href="{{route('comments',$course->id)}}"><button class="btn btn-outline-info">Comments</button></a>
              </td>
              <td>
                {{-- {{dd($course->payment[0]->status)}} --}}
                @if(empty($course->payment))
                <a href="{{route('payment.create',$course->id)}}"><button class="btn btn-outline-success">Payment</button></a>
                @elseif($course->payment->status == Config('constants.payment.pending'))
            <button class="btn btn-outline-warning">Pending</button>
                @elseif($course->payment->status == Config('constants.payment.rejected'))
                <a href="{{route('payment.edit',$course->payment->id)}}"><button class="btn btn-outline-danger">Rejected</button></a>
                @elseif($course->payment->status == Config('constants.payment.approved') && $course->progress == NULL || $course->progress->progress !== 100 )
                <a href="{{route('progress.index',$course->id)}}"><button class="btn btn-primary">Start Course</button></a>
                @elseif($course->progress->progress == 100 && $course->progress->certificate == NULL)
                <form method="post"action="{{route('progress.certificate',$course->progress->id)}}">
                  @csrf
                  @method('PUT')
                <button type="submit" class="btn btn-outline-success">Request For Certificate</button>
              </form>
              @elseif($course->progress->progress == 100 && $course->progress->certificate == Config('constants.progress.certificate'))
              <button class="btn btn-outline-info">Wait For Certificate</button>
              @else
              <a href="/storage/payment/{{$course->progress->certificate}}" target="_blank" ><button class="btn btn-outline-success">Download Certificate</button></a> 
                @endif
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
  
      </div>
    </div>
  </div>




  
  @endsection
</x-master>