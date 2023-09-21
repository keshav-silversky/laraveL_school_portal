<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  
  {{$errors}}
  <form method="post" action="{{route('testing')}}">
  @csrf
    <input type="text" name="name"><br>
    <input type="text" name="state"><br>

<button type="submit">Submit</button>
  </form>


</body>

</html>