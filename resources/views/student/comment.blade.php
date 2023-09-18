<x-master>

  @section('page-title')
Comments
  @endsection

  @section('content')

  <div class="row">
    @if(session('success'))
    <strong class="alert alert-success w-50">{{session('success')}}</strong>
    @endif
  </div>
 

    <form method="post" action="{{route('comment.store')}}">
      @csrf
      <input type="hidden" name="course_id" value="{{$course->id}}">
      <div class="mb-3" >
        <label for="name">Comment</label>
      <textarea name="comment" style="resize:none"   class="form-control w-50 @error('comment') is-invalid @enderror" value="{{old('comment')}}" placeholder="Write Comment From Here..."></textarea>
      @error('comment')
      <span class="invalid-feedback" role="alert">
          {{ $message }}
      </span>
      @enderror
      </div>

  <div>
  <button type="submit" class="btn btn-primary w-50">Add Comment</button>  
</form>  
</div>      

<div class="row mt-5">

  @if(session('deleted'))
<strong class="alert alert-danger w-100">{{session('deleted')}}</strong>
@endif

@if(session('not_deleted'))
<strong class="alert alert-warning w-100">{{session('not_deleted')}}</strong>
@endif

</div>

    <div class="row mt-1">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
            
                <th>User Id</th>
                <th>Comment Id</th>
                <th>Course Name</th>
                <th>Name</th>
                <th>Role</th>
                <th>Comment</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
            
                <th>User Id</th>
                <th>Comment Id</th>
                <th>Course Name</th>
                <th>Name</th>
                <th>Role</th>
                <th>Comment</th>
                <th>Action</th>
       
              </tr>
            </tfoot>
            <tbody>

              @foreach($comments as $comment)
            
              <tr class="   @if(auth()->user()->id == $comment->user_id ) table-info @else table-warning @endif ">
                <td>{{$comment['user']['id']}}</td>
                <td>{{ $comment['id'] }}</td>
                <td>{{$course->name}}</td>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->user->role}}</td>
                <td>{{$comment->comment}}</td>
                <td>
                  <form method="post" action="{{route('comment.delete',$comment->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"  class="btn btn-link"  ><img src="{{asset('images/remove.png')}}" alt="" height="30px" width="30px"></button>
                </form>
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