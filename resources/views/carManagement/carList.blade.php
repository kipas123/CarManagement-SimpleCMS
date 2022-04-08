<!doctype html>
<html lang="en">
<!-- head -->
@include('siteElement/header')
<!-- /head -->
<body>
  @include('siteElement/headerNavi')
  <article>
    <div class="container">
      <div class="row">
        <h1>CarList:</h1>
        <hr />
        @isset($msg)
        @if ($msg !=null && $msgError==null)
        <div class="alert alert-success"><span style="font-size:20px;">{{ $msg }}</span></div>
        @endif
        @endisset
        @isset($msgError)
        @if ($msgError !=null)
        <div class="alert alert-danger"><span style="font-size:20px;">{{ $msgError }}</span></div>
        @endif
        @endisset
        <div class="col-sm-12">

          <form action="/carManagement" method="get">
            @if ($filtr!=null)
            <a href="/carManagement/"> <button type="button" class="btn btn-danger btn-sm">x <sub>{{ $filtr }}</sub></button></a>
            @endif
            <a href="/addCar"><button type="button" class="btn btn-success btn-sm" style="float:right; margin-right: 10px;">Add +</button></a>
            <div class="col-sm-2">
              <input type="text" class="form-control" placeholder="ID/Firma/Model" aria-label="Server" name="filtr">
              <button type="submit" class="btn btn-sm" style="background-color: blue; color: white;">Search</button>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <th>#</th>
                  <th>id</th>
                  <th>Brand</th>
                  <th>Model</th>
                  <th>Engine</th>
                  <th>Engine capacity(cm3)</th>
                  <th>Production year</th>
                  <th>Price</th>
                  <th>Vehicle mileage</th>
                  <th>Addition date</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cars as $car)
                <tr>
                  <td>{{ ($loop->index + 1)+($page*$limit-$limit)}}</td>
                  <td>{{ $car->id }}</td>
                  <td>{{ $car->brand }}</td>
                  <td>{{ $car->model }}</td>
                  <td>{{ $car->engine }}</td>
                  <td>{{ $car->engine_capacity }}</td>
                  <td>{{ $car->year }}</td>
                  <td>{{ number_format($car->price)}}</td>
                  <td>{{ number_format($car->mileage)}}</td>
                  <td>{{ $car->created_at }}</td>
                  <td><a href="/carPreview/{{ $car->id }}" target="_blank"> <button type="button" class="btn btn-warning btn-sm">View</button></a>/<a href="/editCar/{{ $car->id }}"> <button type="button" class="btn btn-info btn-sm">Edit</button></a>/ <button onclick="myFunction({{$car->id}})" type="button" class="btn btn-danger btn-sm">Delete</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if($cars!=null)<div style="clear:both; margin: 0 auto; text-align: center; font-size: 25px; color: white;">{{ $page }} z {{ $lastPage }}</div>@else
          <div style="clear:both; margin: 0 auto; text-align: center; font-size: 25px;">No results</div>@endif
          @if($filtr==null)
          @if($page>1)<a href="/carManagement/{{ $page-1 }}"> <button type="button" class="btn btn-outline-primary">Previous</button></a>@endif
          @if($page<$lastPage)<a href="/carManagement/{{ $page+1 }}"><button type="button" class="btn btn-outline-primary" style="float:right;">Next</button></a>@endif
            @else
            @if($page>1)<a href="/carManagement/{{ $page-1 }}?filtr={{$filtr}}"><button type="button" class="btn btn-outline-primary">Previous</button></a>@endif
            @if($page<$lastPage)<a href="/carManagement/{{ $page+1 }}?filtr={{$filtr}}"><button type="button" class="btn btn-outline-primary" style="float:right;">Next</button></a>@endif
              @endif
              </ul>
        </div>

      </div>

  </article>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>