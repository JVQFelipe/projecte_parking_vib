<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ParkingSlotController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ImgController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// CRUD PARKING 
Route::middleware('auth')->group(function () {

    Route::get('/parkings', [App\Http\Controllers\ParkingController::class, 'index'])->name('parkings.index');
    /*Route::get('/parkings/create', [App\Http\Controllers\ParkingController::class, 'create'])->name('parkings.create');*/
    Route::get('/parkings/show/{parking}', [App\Http\Controllers\ParkingController::class, 'show'])->name('parkings.show');
    /*Route::post('/parkings/store', [App\Http\Controllers\ParkingController::class, 'store'])->name('parkings.store');
    Route::get('/parkings/destroy/{parking}', [App\Http\Controllers\ParkingController::class, 'destroy'])->name('parkings.destroy');
    Route::get('/parkings/edit/{parking}', [App\Http\Controllers\ParkingController::class, 'edit'])->name('parkings.edit');
    Route::post('/parkings/update/{parking}', [App\Http\Controllers\ParkingController::class, 'update'])->name('parkings.update');*/

    //Obtenir número de places lliures per a mostrar dinàmicament al main.
    Route::get('/parkings/{id}/available-slots', [ParkingController::class, 'getAvailableSlots']);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/parkings/create', [ParkingController::class, 'create'])->name('parkings.create');
        Route::post('/parkings/store', [ParkingController::class, 'store'])->name('parkings.store');
        Route::get('/parkings/destroy/{parking}', [ParkingController::class, 'destroy'])->name('parkings.destroy');
        Route::get('/parkings/edit/{parking}', [ParkingController::class, 'edit'])->name('parkings.edit');
        Route::post('/parkings/update/{parking}', [ParkingController::class, 'update'])->name('parkings.update');
    });
    

//Rutes CRUD FLOOR
Route::get('/floors', [App\Http\Controllers\FloorController::class, 'index'])->name('floors.index');
/*Route::get('/parkings/{parking}/floors/create', [App\Http\Controllers\FloorController::class, 'create'])->name('floors.create');*/
Route::get('/floors/show/{floor}', [App\Http\Controllers\FloorController::class, 'show'])->name('floors.show');
/*Route::post('/parkings/{parking_id}/floors/store', [FloorController::class, 'store'])->name('floors.store');
Route::get('/floors/destroy/{floor}', [App\Http\Controllers\FloorController::class, 'destroy'])->name('floors.destroy');
Route::get('/floors/edit/{floor}', [App\Http\Controllers\FloorController::class, 'edit'])->name('floors.edit');
Route::post('/floors/update/{floor}', [App\Http\Controllers\FloorController::class, 'update'])->name('floors.update');*/
Route::get('/parkings/{parking}/floors', [App\Http\Controllers\ParkingController::class, 'floorsParking'])->name('parkings.floorsparking');
Route::get('/parkings/{parking}/tickets', [App\Http\Controllers\ParkingController::class, 'ticketsParking'])->name('parkings.ticketsparking');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/parkings/{parking}/floors/create', [FloorController::class, 'create'])->name('floors.create');
    Route::post('/parkings/{parking_id}/floors/store', [FloorController::class, 'store'])->name('floors.store');
    Route::get('/floors/destroy/{floor}', [FloorController::class, 'destroy'])->name('floors.destroy');
    Route::get('/floors/edit/{floor}', [FloorController::class, 'edit'])->name('floors.edit');
    Route::post('/floors/update/{floor}', [FloorController::class, 'update'])->name('floors.update');
});

//Rutes CRUD PARKINGSLOT
Route::get('/parkingslots', [App\Http\Controllers\ParkingSlotController::class, 'index'])->name('parkingslots.index');
/*Route::get('/parkings/{parking}/floors/{floor}/parkingslots/create', [App\Http\Controllers\ParkingSlotController::class, 'create'])->name('parkingslots.create');*/
Route::get('/parkingslots/show/{id}', [App\Http\Controllers\ParkingSlotController::class, 'show'])->name('parkingslots.show');
/*Route::post('/parkings/{parking}/floors/{floor}/parkingslots/store', [App\Http\Controllers\ParkingSlotController::class, 'store'])->name('parkingslots.store');
Route::get('/parkingslots/destroy/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'destroy'])->name('parkingslots.destroy');
Route::get('/parkingslots/edit/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'edit'])->name('parkingslots.edit');
Route::post('/parkingslots/update/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'update'])->name('parkingslots.update');*/
Route::get('/floors/{floor}/parkingslots', [App\Http\Controllers\FloorController::class, 'slotsFloor'])->name('floors.slotsfloor');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/parkings/{parking}/floors/{floor}/parkingslots/create', [App\Http\Controllers\ParkingSlotController::class, 'create'])->name('parkingslots.create');
    Route::post('/parkings/{parking}/floors/{floor}/parkingslots/store', [App\Http\Controllers\ParkingSlotController::class, 'store'])->name('parkingslots.store');
    Route::get('/parkingslots/destroy/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'destroy'])->name('parkingslots.destroy');
    Route::get('/parkingslots/edit/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'edit'])->name('parkingslots.edit');
    Route::post('/parkingslots/update/{parkingslots}', [App\Http\Controllers\ParkingSlotController::class, 'update'])->name('parkingslots.update');
});

//Rutes APARCAR
Route::get('parkingslots/{id}/aparcar', [App\Http\Controllers\ParkingSlotController::class, 'showAparcarForm'])->name('parkingslots.aparcar.form');
Route::post('parkingslots/{id}/aparcar', [App\Http\Controllers\ParkingSlotController::class, 'aparcar'])->name('parkingslots.aparcar.store');
Route::get('parkingslots/{id}/aparcar', [App\Http\Controllers\ParkingSlotController::class, 'showAparcarForm'])->name('parkingslots.aparcar.form');
Route::post('parkingslots/{id}/aparcar', [App\Http\Controllers\ParkingSlotController::class, 'aparcar'])->name('parkingslots.aparcar.store');
//RUTES DESAPARCAR
Route::post('/parkingslots/{parkingslot}/desaparcar', [App\Http\Controllers\ParkingSlotController::class, 'desaparcar'])->name('parkingslots.desaparcar');


//Rutes CRUD TICKETS
Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
Route::get('/parkings/{parking}/tickets/create', [App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create');
Route::get('/tickets/show/{ticket}', [App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');
Route::post('/parkings/{parking_id}/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/destroy/{ticket}', [App\Http\Controllers\TicketController::class, 'destroy'])->name('tickets.destroy');
Route::get('/tickets/edit/{ticket}', [App\Http\Controllers\TicketController::class, 'edit'])->name('tickets.edit');
Route::post('/tickets/update/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('tickets.update');

//Tarifes RUTES
Route::get('/parkings/{parking}/rates', [App\Http\Controllers\ParkingController::class, 'editRates'])->name('parkings.editrates');
Route::post('/parkings/{parking}/assignrate', [App\Http\Controllers\ParkingController::class, 'assignRate'])->name('parkings.assignrate');
Route::post('/parkings/{parking}/detachrate', [App\Http\Controllers\ParkingController::class, 'detachRate'])->name('parkings.detachrate');
/*Route::get('/rates', [App\Http\Controllers\RatesController::class, 'index'])->name('rates.index');
Route::get('/rates/create', [App\Http\Controllers\RatesController::class, 'create'])->name('rates.create');
Route::get('/rates/show/{rate}', [App\Http\Controllers\RatesController::class, 'show'])->name('rates.show');
Route::post('/rates/store', [App\Http\Controllers\RatesController::class, 'store'])->name('rates.store');
Route::get('/rates/destroy/{rate}', [App\Http\Controllers\RatesController::class, 'destroy'])->name('rates.destroy');
Route::get('/rates/edit/{rate}', [App\Http\Controllers\RatesController::class, 'edit'])->name('rates.edit');
Route::post('/rates/update/{rate}', [App\Http\Controllers\RatesController::class, 'update'])->name('rates.update');*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/rates', [App\Http\Controllers\RatesController::class, 'index'])->name('rates.index');
    Route::get('/rates/create', [App\Http\Controllers\RatesController::class, 'create'])->name('rates.create');
    Route::get('/rates/show/{rate}', [App\Http\Controllers\RatesController::class, 'show'])->name('rates.show');
    Route::post('/rates/store', [App\Http\Controllers\RatesController::class, 'store'])->name('rates.store');
    Route::get('/rates/destroy/{rate}', [App\Http\Controllers\RatesController::class, 'destroy'])->name('rates.destroy');
    Route::get('/rates/edit/{rate}', [App\Http\Controllers\RatesController::class, 'edit'])->name('rates.edit');
    Route::post('/rates/update/{rate}', [App\Http\Controllers\RatesController::class, 'update'])->name('rates.update');
});



//RUTES GALERIA IMATGES
Route::get('/parkings/gallery/{parkingId}', [ImgController::class, 'showGallery'])->name('gallery'); // Mostrar la galería
Route::post('/images', [ImgController::class, 'store'])->name('images.store'); // Subir una nueva imagen

//RUTES ASSIGNAR PLAÇA
Route::get('/floors/{floor}/parkingslots/{slot}/assign', [App\Http\Controllers\FloorController::class, 'assignPlateForm'])->name('floors.assignPlateForm');
Route::post('/floors/{floor}/parkingslots/{slot}/assign', [App\Http\Controllers\FloorController::class, 'assignPlate'])->name('floors.assignPlate');

// Rutes CRUD REPORTS (EXTRA)
/*Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); 
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create'); 
Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store'); 
Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit'); 
Route::post('/reports/{report}/update', [ReportController::class, 'update'])->name('reports.update'); 
Route::get('/reports/{report}/destroy', [ReportController::class, 'destroy'])->name('reports.destroy'); 
Route::get('/reports/{parkingId}', [ReportController::class, 'show'])->name('reports.show'); 

Route::get('reports/download/{id}', [ReportController::class, 'downloadReport'])->name('reports.download');*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [App\Http\Controllers\ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports/store', [App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}/edit', [App\Http\Controllers\ReportController::class, 'edit'])->name('reports.edit');
    Route::post('/reports/{report}/update', [App\Http\Controllers\ReportController::class, 'update'])->name('reports.update');
    Route::get('/reports/{report}/destroy', [App\Http\Controllers\ReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('/reports/{parkingId}', [App\Http\Controllers\ReportController::class, 'show'])->name('reports.show');
    Route::get('reports/download/{id}', [App\Http\Controllers\ReportController::class, 'downloadReport'])->name('reports.download');
});
});

require __DIR__.'/auth.php';

