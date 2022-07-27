
<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CongeController;
use App\Http\Controllers\Admin\CongeHistoriqueController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeIDRecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PayDayController;
use App\Http\Controllers\Admin\PayModController;
use App\Http\Controllers\Admin\PayslipsController;
use App\Http\Controllers\Admin\PresenceController;
use App\Http\Controllers\Admin\PrimeController;
use App\Models\CongeHistorique;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     //return view('dashboard');
    
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard',[HomeController::class, 'index'])->name('dashboard');
    Route::resource('employee',EmployeeController::class);

    //import/eport file employe
    Route::get('file-import-export', [EmployeeController::class, 'fileImportExport'])->name('employe.import');
    Route::post('file-import', [EmployeeController::class, 'importEmploye'])->name('employe.import_store');


    

    
});
Route::get('/search', [EmployeeController::class,'search'])->name('guest.search');

require __DIR__.'/auth.php';