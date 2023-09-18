<x-master>
  @section('page-title')
  Student Dashboard
  @endsection

  @section('content')


  
  


  <div class="card shadow mb-4 mt-2">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary ">My Courses</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
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


            @foreach($courses as $course)
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
                <button class="btn btn-outline-success">Payment</button>
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