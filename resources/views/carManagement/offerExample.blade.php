<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Komis Samochodowy Karo, Paniówki ul. Gliwicka 88c, auta, przeglądy i diagnostyka.">
  <meta name='keywords' content='Komis, samochody. osobowe, dostawcze, skup, sprzedaż, zamiana, kredyty, leasingi, gwarantowane, pewne, giełda samochodowa, salon, handel'>
  <meta name='robots' content='index,follow'>
  <title>Komis Samochodowy-Mikołów</title>
  <link rel="shortcut icon" href="public/assets/assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/carManagement/carPreview.css') }}">
</head>

<body>
  <section id="kon_oferta">
    <div class="srodkuj">
      <h1>Generated example of offer {{$car->id}}:</h1>

      <div class="boks_oferta">
        <p class="oferty">{{ $car->brand }}</p>
        <p>{{ $car->model }}</p>
        <div><a href="{{ $car->href }}"><img src="/assets/{{$car->imagePath}}" alt=""></a></div>
        <ul>
          <li><span class="icon-attachment"></span>Mileage: <span style='font-weight: bold;'>{{$car->mileage}} km</span></li>
          <li><span class="icon-attachment"></span>Production year: <span style='font-weight: bold;'>{{$car->year}}</span></li>
          <li><span class="icon-attachment"></span>Engine: <span style='font-weight: bold;'>{{$car->engine}}</span></li>
          <li><span class="icon-attachment"></span>Engine capacity: <span style='font-weight: bold;'>{{$car->engine_capacity}} cm3</span></li>
        </ul>
        <p class="cena_oferta">{{ number_format($car->price)}} EU</p>
      </div>
</body>

</html>