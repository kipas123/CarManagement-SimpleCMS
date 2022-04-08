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
        <div class="col align-self-center">
        <h1>CarList:</h1>
          <hr />
          <a href="/carManagement"><button type="button" class="btn btn-warning" style="margin-bottom: 20px;"> <--back</button></a>
          <div class="col-sm-6">
        <form action="/addCar" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="top-margin">
                                        <label>Brand(np.BMW)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="brand">
                                    </div>
                                    <p>@error('name') {{ $message }} @enderror</p>
                                    <div class="top-margin">
                                        <label>Model(np.X4)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="model">
                                    </div>
                                    <div class="top-margin">
                                        <label>Engine type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="engine">
                                            <option>gasoline</option>
				            <option>gasoline/gas</option>
                                            <option>diesel oil</option>
                                            <option>hybrid</option>
                                            <option>electric</option>				
                                        </select>
                                    </div>

                                    <div class="top-margin">
                                        <label>Engine capacity(cm3)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="engine_capacity">
                                    </div>
                                    <div class="top-margin">
                                        <label>Production year<span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="year">
                                            @for ($i = 1999; $i <= 2021; $i++)
                                            <option>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="top-margin">
                                        <label>Vehicle mileage(km)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mileage">
                                    </div>
                                    <div class="top-margin">
                                        <label>Pirce(EU)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="price">
                                    </div>
                                    <div class="top-margin">
                                        <label>Link(otomoto)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="href">
                                    </div>
                                    <div class="top-margin">
                                        <label>Image<span class="text-danger">*</span></label>
                                        <input type="file" name="image" id="fileToUpload">
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-8">                     
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <button class="btn" style="background-color: #2C36CA !important; color: white;" type="submit">Save</button>
                                        </div>
                                    </div>
                                    <p>@error('brand')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    <p>@error('model')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p>
                                    @enderror</p>
                                    <p>@error('mileage')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p><!-- comment -->
                                    <p>@error('engine_capacity')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p>
                                <p>@error('href')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p>
                                <p>@error('price')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p>
				<p>@error('image')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror</p>
                                @isset($msgError)
                                  @if ($msgError !=null)
                    <div class="alert alert-danger"><span style="font-size:20px;">{{ $msgError }}</span></div>
                    @endif
                                @endisset
                                </form>
          </div>
        </div>
      </div>

  </article>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>