<x-master>

  @section('page-title')
  Progress
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

{{$errors}}

  @if(empty($course->progress))
  <form method="post" action="{{route('progress.store',$course)}}">
    @else
    <form method="post" action="{{route('progress.update',$course->progress->id)}}">
    @method('PUT')
      @endif

      @csrf
  <div class="container mt-5">
    <h1>Your Progress</h1>
    <div class="form-group">
        <label for="progress">Progress:</label>
        <input type="range" class="form-range" id="progress" name="progress" min="0" max="100" step="1">
    </div>
    <div class="progress mt-3"> 
        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <span class="progress-text">0%</span>
        </div>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Submit Progress</button>
    </form>
    </div>
   
  </div>




<!-- Include Bootstrap JS (optional, only if you need additional functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+uaqbe5CbOG5z/T5M5Ff5u1jC+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkf" crossorigin="anonymous"></script>

<!-- Your JavaScript for updating the progress bar -->
<script>
    // Get the range input and progress bar elements
    const rangeInput = document.getElementById('progress');
    const progressBar = document.querySelector('.progress-bar');

    // Listen for changes in the range input
    rangeInput.addEventListener('input', function () {
        const progressValue = this.value;
        progressBar.style.width = progressValue + '%';
        progressBar.setAttribute('aria-valuenow', progressValue);
        progressBar.querySelector('.progress-text').textContent = progressValue + '%';
    });
</script>
@endsection



</x-master>