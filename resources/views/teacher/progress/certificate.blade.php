<x-master>

    @section('page-title')
        Manage Certificate
    @endsection

    @section('content')
        <div class="container">
            <div class="row">
                @if (session('certificate'))
                    <strong class="alert alert-success w-100">{{ session('certificate') }}</strong>
                @endif
            </div>

       
         
            <div class="row">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Course Name</th>
                                    <th>Progress</th>
                                    <th>Certificate</th>


                                </tr>
                            </thead>
                            <tfoot>


                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Course Name</th>
                                    <th>Progress</th>
                                    <th>Certificate</th>

                            </tfoot>
                            <tbody>


                                @foreach ($user->courses as $course)
                                    @foreach ($course->progresses as $progress)
                                        <tr>
                                            <td>{{ $progress->user->name }}</td>
                                            <td>{{ $progress->user->email }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $progress->progress }}</td>
                                            <td>
                                                
                                                <form method="post"
                                                    action="{{ route('certificate.upload',[$course->id, $progress->id]) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="file" name="certificate" class="">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </form>
                                            </td>




                                        </tr>
                                    @endforeach
                                @endforeach




                            </tbody>
                        </table>
                        <div class="pagination">

                        </div>
                    </div>
                </div>

            </div>
      
     
    
        </div>
    @endsection

</x-master>
