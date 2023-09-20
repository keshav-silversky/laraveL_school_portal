<x-master>

  @section('page-title')
View Notices
  @endsection

  @section('content')

  <div class="row mt-1">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr> 
              <th>Image</th>
              <th>Course Name</th>
              <th>Subject</th>    
              <th>Description</th>    

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Image</th>
              <th>Course Name</th>
              <th>Subject</th>    
              <th>Description</th>    

            </tr>
          </tfoot>
          <tbody>


            @foreach($data->enroll as $course)

            @if(isset($course->payment->course))
            @foreach($course->payment->course->notices as $notice)

            <tr>
              <td><img src="{{$course->image}}" alt="" height="60px" width="60px"></td>
              <td>{{$course->name}}</td>
              <td>{{$notice->subject}}</td>
              <td>{{$notice->description}}</td>
    
            </tr>

       
        
            @endforeach
            @endif
     
          @endforeach
  
   

          </tbody>
        </table>
        <div class="pagination">
     
      </div>
      </div>
    </div>



  </div>

  @endsection
</x-master>