<x-master>

@section('content')



<style>
  .card {
    background-color: #ffffff; /* Set a background color */
    box-shadow: 0 4px 8px 0 rgba(123, 171, 216, 0.075); /* Add a shadow effect */
    transition: transform 0.2s; /* Add a smooth transition effect for hovering */
    margin: 10px; /* Add some spacing between cards */
  }

  .card:hover {
    transform: scale(1.05); /* Enlarge the card on hover */
    background-color: #c7fff8; /* Change background color on hover */
  }

  .card-text {
    color: #0539e6; /* Set text color */
    font-size: 24px; /* Set font size */
  }

  .row {
    display: flex;
    justify-content: space-around; /* Center align the cards in the row */
  }
  .card-body
  {
    color: #6171e7 !important;
  }
</style>


<div class="row">
  <div class="col-lg-4 col-md-12">
<div class="card text-center">
<div class="card-content">
<div class="card-body">
<h5 class="card-text font-weight-bold">  <i class="fas fa-book"></i> Courses</h5>
<h1 class="card-text font-weight-bold">{{ $user->courses_count }}</h1>


</div>
</div>
</div>
</div>
 {{-- col 2 --}}

 <div class="col-lg-4 col-md-12">
  <div class="card text-center">
  <div class="card-content">
  <div class="card-body">
  <h5 class="card-text font-weight-bold"><i class="fas fa-user-graduate"></i>Students</h5>

  <h1 class="card-text font-weight-bold">{{ $user->students }}</h1>

  </div>
  </div>
  </div>
  </div>

   {{-- col 2 --}}

 <div class="col-lg-4 col-md-12">
  <div class="card text-center">
  <div class="card-content">
  <div class="card-body">
  <h5 class="card-text font-weight-bold"><i class="fas fa-money-bill-wave"></i> Payments</h5>
  
  <h1 class="card-text font-weight-bold">&#8377; {{ $user->payment_sum_sum_amount}}</h1>

  </div>
  </div>
  </div>
  </div>


</div>

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $(".card").hide().fadeIn(1000); // Fade in the cards on page load
  });
</script>

    
@endsection

    



@endsection

</x-master>