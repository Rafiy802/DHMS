<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
//     return view('welcome');
// });
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');



//Main Routing

Route::get('/', function () {
    return view('home');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*--------------------------------------------------------------
# Routing for patient
--------------------------------------------------------------*/

Route::group(['middleware' => ['auth', 'patient']], function () {
    // Route::get('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'viewMakeAppointment'])->name('makeAppointment.view');
    Route::get('/patientAppointment', [App\Http\Controllers\AppointmentController::class, 'viewPatientAppointment'])->name('patients.appointment.view');

    //Profile

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'viewPatientProfile'])->name('patients.profile');
    Route::get('/editProfile', [App\Http\Controllers\ProfileController::class, 'viewEditPatientProfile'])->name('patients.profile.view');

    Route::put('/editProfile/{id}', [App\Http\Controllers\ProfileController::class, 'editPatientProfile'])->name('patients.profile.edit');


});




//Appointments

Route::get('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'viewMakeAppointment'])->name('makeAppointment.view')->middleware('auth');
// Route::get('/patientAppointment', [App\Http\Controllers\AppointmentController::class, 'viewPatientAppointment'])->name('patients.appointment.view');

Route::post('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'addMakeAppointment'])->name('makeAppointment.new')->middleware('auth');

Route::put('/cancelAppointment/{id}', [App\Http\Controllers\AppointmentController::class, 'cancelAppointment'])->name('appointment.cancel')->middleware('auth');



/*--------------------------------------------------------------
# Routing for Dentist
--------------------------------------------------------------*/


Route::group(['middleware' => ['auth', 'dentist']], function () {

    //Appointments
    Route::get('/dentistAppointment', [App\Http\Controllers\AppointmentController::class, 'viewDentistAppointment'])->name('dentist.appointment.view');


    // Dentist Profile
    Route::get('/dentistProfile', [App\Http\Controllers\ProfileController::class, 'viewDentistProfile'])->name('dentist.profile');
    Route::get('/editDentistProfile', [App\Http\Controllers\ProfileController::class, 'viewEditDentistProfile'])->name('dentist.profile.view');

    Route::put('/editDentistProfile/{id}', [App\Http\Controllers\ProfileController::class, 'editDentistProfile'])->name('dentist.profile.edit');

    // Route::post('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'addMakeAppointment'])->name('makeAppointment.new')->middleware('auth');



});

//Appointments





//Patient
Route::get('/viewAllPatients', [App\Http\Controllers\PatientController::class, 'viewAllPatients'])->name('dentist.allPatients.view');

Route::get('/viewPatient/{id}', [App\Http\Controllers\PatientController::class, 'viewPatient'])->name('dentist.patient.view');



//Receipt

Route::get('/patientReceipt/{id}', [App\Http\Controllers\ReceiptController::class, 'viewDentistReceipt'])->name('dentist.receipt.viewAll');

Route::get('/editReceipt', function () {
    return view('dentists.editReceipt');
})->name('dentist.receipt.viewEdit');

Route::get('/addReceipt/{id}', [App\Http\Controllers\ReceiptController::class, 'viewNewReceipt'])->name('dentist.receipt.add');

Route::post('/addReceipt/{id}', [App\Http\Controllers\ReceiptController::class, 'addNewReceipt'])->name('dentist.receipt.new');

Route::get('/viewReceipts/{id}', [App\Http\Controllers\ReceiptController::class, 'viewSelectedReceipt'])->name('dentist.receipt.view');






/*--------------------------------------------------------------
# Routing for Receptionist
--------------------------------------------------------------*/

Route::group(['middleware' => ['auth', 'receptionist']], function () {

    //Apointments

    Route::get('/allAppointment', [App\Http\Controllers\AppointmentController::class, 'viewAllAppointment'])->name('receptionist.allAppointment.view');
    Route::get('/historyAppointment', [App\Http\Controllers\AppointmentController::class, 'viewHistoryAppointment'])->name('receptionist.historyAppointment.view');



    //Medicine
    Route::get('/allMedicines', [App\Http\Controllers\MedicineController::class, 'viewAllMedicine'])->name('receptionist.medicine.viewAll');
    Route::get('/addMedicine', function () {
        return view('receptionist.addMedicine');
    })->name('receptionist.medicine.add');
    Route::get('/editMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'viewEditMedicine'])->name('receptionist.medicine.edit');

    Route::post('/addMedicine', [App\Http\Controllers\MedicineController::class, 'addNewMedicine'])->name('receptionist.medicine.new');

    Route::put('/editMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'editMedicine'])->name('receptionist.medicine.save');

    Route::delete('/deleteMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'deleteMedicine'])->name('receptionist.medicine.delete');



    //Treatments
    Route::get('/allTreatments', [App\Http\Controllers\TreatmentController::class, 'viewAllTreatments'])->name('receptionist.treatment.viewAll');
    Route::get('/addTreatment', function () {
        return view('receptionist.addTreatment');
    })->name('receptionist.treatment.add');
    Route::get('/editTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'viewEditTreatment'])->name('receptionist.treatment.edit');

    Route::post('/addTreatment', [App\Http\Controllers\TreatmentController::class, 'addNewTreatment'])->name('receptionist.treatment.new');

    Route::put('/editTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'editTreatment'])->name('receptionist.treatment.save');

    Route::delete('/deleteTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'deleteTreatment'])->name('receptionist.treatment.delete');



    //Receipts

    Route::get('/patientsReceipt/{id}', [App\Http\Controllers\ReceiptController::class, 'viewAllReceipt'])->name('receptionist.receipt.viewAll');
    // Route::get('/viewReceipts/{id}', [App\Http\Controllers\ReceiptController::class, 'viewSelectedReceipt'])->name('dentist.receipt.view');


    // Patient
    Route::get('/editPatientInfo/{id}', [App\Http\Controllers\PatientController::class, 'viewEditPatientInfo'])->name('receptionist.patientInfo.view');
    Route::put('/editPatientInfo/{id}', [App\Http\Controllers\PatientController::class, 'editPatientInfo'])->name('receptionist.patientInfo.edit');


    // Dentist

    Route::get('/manageDentists', [App\Http\Controllers\DentistController::class, 'viewAllDentist'])->name('receptionist.dentist.manage');
    Route::get('/addDoctors', function () {
        return view('receptionist.addDentist');
    })->name('receptionist.dentist.add');
    Route::post('/addDentist', [App\Http\Controllers\DentistController::class, 'addNewDentist'])->name('receptionist.dentist.new');

    Route::get('/dentistInfo/{id}', [App\Http\Controllers\DentistController::class, 'viewDentistInfo'])->name('receptionist.dentist.view');
    Route::get('/editDentistInfo/{id}', [App\Http\Controllers\DentistController::class, 'viewEditDentistInfo'])->name('receptionist.dentist.editView');

    Route::put('/editDentistInfo/{id}', [App\Http\Controllers\DentistController::class, 'editDentistInfo'])->name('receptionist.dentist.edit');

});


//Doctors




//Invoices
Route::get('/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'generateInvoice'])->name('receptionist.invoice.create');



// Route::group(['middleware' => ['auth', 'dentist|receptionist']], function() {

// //Patient
// Route::get('/viewAllPatients', [App\Http\Controllers\PatientController::class, 'viewAllPatients'])->name('dentist.allPatients.view');

// Route::get('/viewPatient/{id}', [App\Http\Controllers\PatientController::class, 'viewPatient'])->name('dentist.patient.view');

// });