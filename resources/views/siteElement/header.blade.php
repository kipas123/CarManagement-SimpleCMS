<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/carManagement/carManagement.css') }}">

  <title>Hello, world!</title>
  <script>
    function myFunction(id) {

      var r = confirm("Are you sure you want to delete auto no. " + id + "?");
      if (r == true) {
        window.location.href = "/deleteCar/" + id;
      } else {}
    }
  </script>
</head>
