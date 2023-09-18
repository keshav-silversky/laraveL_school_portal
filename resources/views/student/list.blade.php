<x-master>

  @section('page-title')
Comments
  @endsection

  @section('content')


    <div class="row mt-1">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr> 
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>    
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
 
              </tr>
            </tfoot>
            <tbody>

  
            @foreach($course->users as $student)
              <tr>
                <td><img src="{{$student->image}}" alt="Image" width="60px"></td>
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>

                </td>

              </tr>
            
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