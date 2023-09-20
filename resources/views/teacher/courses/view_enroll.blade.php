<x-master>

    @section('page-title')
        Enrolled Student List
    @endsection

    @section('content')
        <div class="container">
            <div class="row mb-4">

                <table class="table text-center border-bottom-warning ">

                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Progress</th>
                    </tr>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Progress</th>
                        </tr>
                    </tfoot>

                    @foreach ($course->students as $student)
      {{-- class=" @if(!is_null($student->progress) && $student->progress->progess =  = 100) table table-success  @endif" --}}

                        <tr>
                            <td><img src="{{ $student->image }}" alt="" height="60px" width="60px"></td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                @if (empty($student->progress))
                                    0% Complete
                                @else
                                    {{ $student->progress->progress }}% Complete
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </table>


            </div>




        </div>
    @endsection



</x-master>
