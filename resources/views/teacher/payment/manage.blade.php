<x-master>

    @section('page-title')
        Manage Payments
    @endsection

    @section('content')
    

        <div class="container">
          <div class="row">
            @if(session('approved'))
            <strong class="alert alert-success w-100">{{session('approved')}}</strong>
            @elseif(session('rejected'))
            <strong class="alert alert-danger w-100">{{session('rejected')}}</strong>
            @elseif(session('failed'))
            <strong class="alert alert-warning w-100">{{session('unauthorized')}}</strong>
            @endif
          </div>



        <div class="row">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Price</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Receipt</th>

                                    <th colspan="2">Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Price</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Receipt</th>

                                    <th>Action</th>

                            </tfoot>
                            <tbody>

                                @foreach ($user->courses as $course)

                                @foreach($course->payments as $payment)

                                    <tr>
                                        <td>{{$course->name}}</td>
                                        <td>{{$course->price}}</td>
                                        <td>{{$payment->user->name}}</td>
                                        <td>{{$payment->user->email}}</td>
                                        <td><a href="{{$payment->pdf}}" target="_blank">Receipt</a></td>
                                        <td class="mx-auto">
                                          <form method="post" action="{{route('payment.update.decide',[$course->id,$payment->id])}}" class="mx-auto">
                                            @csrf
                                            @method('PUT')
                                          <button type="submit" name="action" value="accept" class="btn btn-outline-success">Accept</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-outline-danger">Reject</button>
                                      </form></td>
                                    
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
