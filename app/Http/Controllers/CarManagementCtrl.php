<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Http\Requests\CarPostRequest;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class CarManagementCtrl extends Controller
{
    private $car;
    private $msg;

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->car = new Car();
    }

    public function show($page = null, $msg = null, $msgError = null) {
        
        $limit = 10;
        $amount = null;
        if($page==null) $page=1;
        if (request('filtr') == null) {
            $cars = CarManagementCtrl::getCars(null, $page, $limit);
            $amount = $this->countCars();
        } else{
            $cars = CarManagementCtrl::getCars(request('filtr'), $page, $limit);
            $amount = $this->countCars(request('filtr'));
        }
        if($amount%$limit==0){
            $lastPage = (int)(($amount/$limit));
        }else $lastPage = (int)(($amount/$limit))+1;
        if($lastPage==0) $lastPage=1;
        
        return view('carManagement/carList')->with('cars', $cars)
                        ->with('msg', $msg)
                        ->with('msgError', $msgError)
                        ->with('lastPage', $lastPage)
                        ->with('page', $page)
                        ->with('limit', $limit)
                        ->with('filtr', request('filtr'));
    }

    public function addCarView() {
        $currentYear = date("Y");
        return view('carManagement/addCar')->with("currentYear", $currentYear);
    }

    public function editCarView($id) {
        $currentYear = date("Y");
        try {
            $car = DB::table('cars')
                    ->where('id', $id)
                    ->first();
        } catch (\PDOException $e) {
            return redirect('/carManagement');
        }

        if ($car == null)
            return redirect('/carManagement');
        $this->car = $car;
        return view('carManagement/editCar')->with('car', $this->car)
                                              ->with("currentYear", $currentYear);
    }

    public function addCar(CarPostRequest $request) {
        // walidacja danych
        $validated = $request->validated();
        date_default_timezone_set('Europe/Warsaw');
        $path = $this->upload($request);
        if ($path == null) {
            $cars = CarManagementCtrl::getCars();
            return view('carManagement/addCar')->with('cars', $cars)
                            ->with('msg', null)
                            ->with('msgError', "Error: Photo must be in .png or .jpg format!");
        }
        // wypełnienie danych
        $this->car->brand = $validated['brand'];
        $this->car->model = $validated['model'];
        $this->car->engine = request('engine');
        $this->car->engine_capacity = request('engine_capacity');
        $this->car->year = request('year');
        $this->car->mileage = $validated['mileage'];
        $this->car->offer = 0;
        $this->car->weekoffer = 0;
        $this->car->imagePath = $path;
        $this->car->href = $validated['href'];
        $this->car->price = $validated['price'];
        $this->car->created_at = date("Y-m-d H:i:s");
        $this->car->updated_at = date("Y-m-d H:i:s");
        //zapis do BD
        try {
            $this->storeInDB($this->car);
            return $this->show(null, "A car has been added!", null);
        } catch (\PDOException $e) {
            $cars = CarManagementCtrl::getCars();
            return $this->show(null, null, "Failed to add car");
        }
    }

    public function editCar($id, CarPostRequest $request) {
        // walidacja danych
        $validated = $request->validated();
        date_default_timezone_set('Europe/Warsaw');
        try {
            $filePath = DB::table('cars')
                    ->where('id', $id)
                    ->first('imagePath');
        } catch (\Exception $e) {
            $filePath = null;
        }
        if ($request->hasFile('image')) {
            $path = $this->upload($request);
        } else
            $path = null;

        if ($path == null) {
            $this->car->imagePath = $filePath->imagePath;
        } else {
            $this->car->imagePath = $path;
            Storage::disk('images')->delete($filePath->imagePath);
        }


        // wypełnienie danych
        $this->car->brand = $validated['brand'];
        $this->car->model = $validated['model'];
        $this->car->engine = request('engine');
        $this->car->engine_capacity = request('engine_capacity');
        $this->car->year = request('year');
        $this->car->mileage = $validated['mileage'];
        $this->car->href = $validated['href'];
        $this->car->price = $validated['price'];
        $this->car->created_at = date("Y-m-d H:i:s");
        $this->car->updated_at = date("Y-m-d H:i:s");
        //zapis do BD
        try {
            $this->updateInDB($this->car, $id);
            return $this->show(null, "Correctly edited car!", null);
        } catch (\PDOException $e) {
            return $this->show(null, null, "Error: Failed to edit the car.");
        }
    }

    public function deleteCar($id) {
        try {

            $filePath = DB::table('cars')
                    ->where('id', $id)
                    ->first('imagePath');

            Storage::disk('images')->delete($filePath->imagePath);
            DB::table('cars')->delete($id);
            return $this->show(null, "Deleted!", null);
        } catch (\PDOException $e) {
            return $this->show(null, null, "Error: Failed to delete the car.");
        } catch (\Exception $e) {
            return $this->show(null, null, "Error: Failed to delete the car.");
        }
    }

    private function storeInDB($car) {
        try {
            DB::table('cars')->insert([
                'brand' => $car->brand,
                'model' => $car->model,
                'engine' => $car->engine,
                'engine_capacity' => $car->engine_capacity,
                'year' => $car->year,
                'mileage' => $car->mileage,
                'imagePath' => $car->imagePath,
                'href' => $car->href,
                'price' => $car->price,
                'created_at' => $car->created_at,
                'updated_at' => $car->updated_at
            ]);
        } catch (\PDOException $e) {
            return $this->show(null, null, "Failed to add car");
        }
    }

    private function updateInDB($car, $id) {
        try {
            DB::table('cars')
                    ->where('id', $id)
                    ->update([
                        'brand' => $car->brand,
                        'model' => $car->model,
                        'engine' => $car->engine,
                        'engine_capacity' => $car->engine_capacity,
                        'year' => $car->year,
                        'mileage' => $car->mileage,
                        'imagePath' => $car->imagePath,
                        'href' => $car->href,
                        'price' => $car->price,
                        'updated_at' => $car->updated_at
            ]);
        } catch (\PDOException $e) {
            return $this->show(null, null, "Error: Failed to update the car!");
        }
    }

    public static function getCars($filtr = null, $page = null, $limit = 0) {
        try {
            if ($filtr == null) {
                if ($page == null) {
                    return DB::table('cars')
                                    ->limit($limit)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                } else {
                    return DB::table('cars')
                                    ->offset($page * $limit - $limit)
                                    ->limit($limit)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                }
            } else { //$form!=null
                if ($page == null) {
                    return DB::table('cars')
                                    ->where('id', $filtr)
                                    ->orWhere('brand', $filtr)
                                    ->orWhere('model', $filtr)
                                    ->limit($limit)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                } else {
                    return DB::table('cars')
                                    ->where('id', $filtr)
                                    ->orWhere('brand', $filtr)
                                    ->orWhere('model', $filtr)
                                    ->offset($page * $limit - $limit)
                                    ->limit($limit)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                }
            }
        } catch (\PDOException $e) {
            return redirect()->route('home');
        }
    }

    private function upload($request) {
        $allowed = array('png', 'jpg');

        if ($request->hasFile('image')) {
            $filename = $request->file('image');
            $filename = $request->image;
            $extension = $request->image->extension();
            if (!in_array($extension, $allowed)) {
                return null;
            }

            if ($request->file('image')->isValid()) {
                $path = $request->image->store('carImages', 'images');
                return $path;
            }
        }
    }

    public function carPreview($id) {
        try {
            $car = DB::table('cars')
                    ->where('id', $id)
                    ->first();
        } catch (\PDOException $e) {
            return redirect('/carManagement');
        }
        return view('carManagement/offerExample')->with('car', $car);
    }

    public static function countCars($filtr = null) {
        if ($filtr == null) {
            return DB::table('cars')->count();
        } else {
            return DB::table('cars')
                            ->where('id', $filtr)
                            ->orWhere('brand', $filtr)
                            ->orWhere('model', $filtr)
                            ->count();
        }
    }

}
