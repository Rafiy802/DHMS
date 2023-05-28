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



//Main Routing
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Route::get('/', function () {
    return view('home');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*--------------------------------------------------------------
# Routing for patient
--------------------------------------------------------------*/

//Appointments

Route::get('/patient', function () {
    return view('patients.patientHome');
})->name('patients.dashboard');

Route::get('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'viewMakeAppointment'])->name('makeAppointment.view');
Route::get('/patientAppointment', [App\Http\Controllers\AppointmentController::class, 'viewPatientAppointment'])->name('patients.appointment.view');

Route::post('/makeAppointment', [App\Http\Controllers\AppointmentController::class, 'addMakeAppointment'])->name('makeAppointment.new');

Route::put('/cancelAppointment/{id}', [App\Http\Controllers\AppointmentController::class, 'cancelAppointment'])->name('appointment.cancel');




//Profile

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'viewPatientProfile'])->name('patients.profile');
Route::get('/editProfile', [App\Http\Controllers\ProfileController::class, 'viewEditPatientProfile'])->name('patients.profile.view');


Route::put('/editProfile/{id}', [App\Http\Controllers\ProfileController::class, 'editPatientProfile'])->name('patients.profile.edit');



// Route::get('/editProfile', function () {
//     return view('patients.editPatientProfile');
// })->name('patients.profile.view');

// Route::get('/patientAppointment', function () {
//     return view('patients.patientAppointment');
// })->name('patients.appointment.view');


/*--------------------------------------------------------------
# Routing for Dentist
--------------------------------------------------------------*/


//Appointments

Route::get('/dentistAppointment', [App\Http\Controllers\AppointmentController::class, 'viewDentistAppointment'])->name('dentist.appointment.view');



//Patient
Route::get('/viewAllPatients', [App\Http\Controllers\PatientController::class, 'viewAllPatients'])->name('dentist.allPatients.view');

Route::get('/viewPatient/{id}', [App\Http\Controllers\PatientController::class, 'viewPatient'])->name('dentist.patient.view');



//Receipt







/*--------------------------------------------------------------
# Routing for Receptionist
--------------------------------------------------------------*/

//Apointments

Route::get('/allAppointment', [App\Http\Controllers\AppointmentController::class, 'viewAllAppointment'])->name('receptionist.allAppointment.view');



//Medicine
Route::get('/allMedicines', [App\Http\Controllers\MedicineController::class, 'viewAllMedicine'])->name('receptionist.medicine.viewAll');
Route::get('/addMedicine', function () {
    return view('receptionist.addMedicine');
})->name('receptionist.medicine.add');
Route::get('/editMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'viewEditMedicine'])->name('receptionist.medicine.edit');

Route::post('/addMedicine', [App\Http\Controllers\MedicineController::class, 'addNewMedicine'])->name('receptionist.medicine.new');

Route::put('/editMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'editMedicine'])->name('receptionist.medicine.save');

Route::delete('/deleteMedicine/{id}', [App\Http\Controllers\MedicineController::class, 'deleteMedicine'])->name('receptionist.medicine.delete');


//blum di implement
Route::delete('/deleteBook/{id}', [App\Http\Controllers\AppointmentController::class, 'deleteAppointment'])->name('appointment.delete');