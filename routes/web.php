
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

// Route::get('/', function () {
//     return view('admin.welcome');
// });

// Route::get('/dashboard', function () {
//     //return view('dashboard');
    
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard',[HomeController::class, 'index'])->name('dashboard');
    Route::resource('employee',EmployeeController::class);
    Route::resource('contract',ContractController::class);
    Route::resource('payslip',PayslipsController::class);
    Route::resource('prime',PrimeController::class);
    Route::resource('presence',PresenceController::class);
    Route::resource('company',CompanyController::class);
    Route::resource('payday',PayDayController::class);
    Route::resource('employeeidrecord',EmployeeIDRecordController::class);
    Route::resource('conge',CongeController::class);
    Route::resource('congehistory',CongeHistoriqueController::class);
    Route::resource('paymod',PayModController::class);

        //ajax request 
    Route::post('/ajax/filterss', [HomeController::class, 'tsearch'])->name('posts.filter');

    Route::get('congein/{id}', [CongeHistoriqueController::class, 'calconge'])->name('conge.conge');
    Route::get('filter_pay_view', [PayslipsController::class, 'filter_pay_view'])->name('payslip.fileter_view');
    Route::get('search', [PayslipsController::class, 'search'])->name('payslip.search');
    Route::get('firter_generate', [PayslipsController::class, 'filtre_pay'])->name('payslip.filter');
    Route::get('pay', [PayslipsController::class, 'pay_function'])->name('pay.pay');
    Route::get('pay_test_te/{payslip}', [PayslipsController::class, 'pay_test'])->name('pays.pay');
    Route::get('/downloadPDF/{payslip}',[PayslipsController::class,'downloadPDF'])->name('payslip.download');

    //import/eport file employe
    Route::get('file-import-export', [EmployeeController::class, 'fileImportExport'])->name('employe.import');
    Route::post('file-import', [EmployeeController::class, 'importEmploye'])->name('employe.import_store');
    Route::get('file-export', [EmployeeController::class, 'fileExport'])->name('file-export');

    //import/eport file contract
   Route::get('contract-file-import-export', [ContractController::class, 'fileImportExport'])->name('contract.import');
    Route::post('contract-file-import', [ContractController::class, 'importContract'])->name('contract.import_store');
   // Route::get('file-export', [ContractController::class, 'fileExport'])->name('file-export');

    //import/eport file presence
    Route::get('presence-file-import-export', [PresenceController::class, 'fileImportExport'])->name('presence.import');
    Route::post('presece-file-import', [PresenceController::class, 'importPresence'])->name('presence.import_store');
   // Route::get('file-export', [PresenceController::class, 'fileExport'])->name('file-export');

    //import/eport file prime
    Route::get('prime-file-import-export', [PrimeController::class, 'fileImportExport'])->name('prime.import');
    Route::post('prime-file-import', [PrimeController::class, 'importPrime'])->name('prime.import_store');
    //Route::get('file-export', [EmployeeController::class, 'fileExport'])->name('file-export');

    //import/eport file payday
    Route::get('payday-file-import-export', [PayDayController::class, 'fileImportExport'])->name('payday.import');
    Route::post('payday-file-import', [PayDayController::class, 'importPayDay'])->name('payday.import_store');
    //Route::get('payday-file-export', [PayDayController::class, 'fileExport'])->name('file-export');


    
});

require __DIR__.'/auth.php';