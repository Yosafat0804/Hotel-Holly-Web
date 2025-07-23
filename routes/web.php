<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelFacilityController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReviewController;

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


Route::group(['middleware' => 'prevent'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('landing');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/detail/room/{id}', [RoomTypeController::class, 'detailRoom'])->name('detail.room');
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('customer.transactions');
        Route::get('/transaction/cancel/{id}', [TransactionController::class, 'transactionCancel'])->name('customer.cancel.transaction');
        Route::post('/transaction/pay/{id}', [TransactionController::class, 'transactionPay'])->name('customer.pay.transaction');
        Route::post('/book', [TransactionController::class, 'store'])->name('customer.book.now');
        Route::get('/pay', [PaymentController::class, 'index'])->name('customer.pay');
        Route::post('/invoice', [PaymentController::class, 'invoice'])->name('customer.invoice');
        Route::post('/payment/proof/upload', [PaymentController::class, 'uploadProof'])->name('upload.proof');
        Route::get('/transaction/proof/{id}', [TransactionController::class, 'transactionProof'])->name('transaction.proof');
        Route::get('/transaction/early-checkout/{id}', [App\Http\Controllers\TransactionController::class, 'earlyCheckout'])->name('transaction.earlyCheckout');
        Route::get('/transaction/proof/print/{id}', [PaymentController::class, 'transactionProofPrint'])->name('transaction.proof.print');
        Route::post('/customer/save', [HomeController::class, 'storeProfile'])->name('customer.save');
        Route::get('/review', [ReviewController::class, 'index'])->name('review');
        Route::post('/review./store', [ReviewController::class, 'store'])->name('review.store');

        Route::group(['middleware' => 'admin'], function () {

            Route::get('/admin', [HomeController::class, 'admin'])->name('admin.home');
            Route::get('/admin/logs', [TransactionController::class, 'logs'])->name('admin.logs');
            Route::get('/admin/income-report', [AdminController::class, 'incomeReport'])->name('admin.incomeReport');
            //CRUD KAMAR
            Route::resource('room', RoomController::class)->except('destroy');
            Route::get('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');

            //CRUD TIPE KAMAR                   
            Route::resource('roomtype', RoomTypeController::class)->except('destroy');
            // Route::get('/roomtype/add', [RoomTypeController::class, 'add'])->name('roomtype.add');
            Route::get('/roomtype/delete/{id}', [RoomTypeController::class, 'destroy'])->name('roomtype.delete');
            Route::get('/roomtype/photo/create', [RoomTypeController::class, 'createPhoto'])->name('roomtype.photo.create');
            Route::post('/roomtype/photo/store', [RoomTypeController::class, 'storePhoto'])->name('roomtype.photo.store');

            //CRUD FASILITAS KAMAR
            Route::resource('roomfacility', RoomFacilityController::class)->except('destroy');
            Route::get('/roomfacility/delete/{id}', [RoomFacilityController::class, 'destroy'])->name('roomfacility.delete');

            //CRUD FASILITAS HOTEL
            Route::resource('hotelfacility', HotelFacilityController::class)->except('destroy');
            Route::get('/hotelfacility/delete/{id}', [HotelFacilityController::class, 'destroy'])->name('hotelfacility.delete');
        });

        Route::group(['middleware' => 'receptionis'], function () {
            Route::get('/receptionis', [HomeController::class, 'receptionis'])->name('resepsionis.home');
            Route::get('/receptionis/detail', [TransactionController::class, 'userDetail'])->name('receptionis.detail');
            Route::get('/reservations', [TransactionController::class, 'reservations'])->name('receptionis.reservations');
            Route::get('/to_process/{id}', [TransactionController::class, 'toProcessTransaction'])->name('receptionis.toprocess');
            Route::get('/to_verified/{id}', [TransactionController::class, 'toVerifiedTransaction'])->name('receptionis.toverified');
            Route::get('/to_failed/{id}', [TransactionController::class, 'toFailedTransaction'])->name('receptionis.tofailed');
            Route::get('/to_rejected/{id}', [TransactionController::class, 'toRejectedTransaction'])->name('receptionis.torejected');
            Route::get('/checkin', [TransactionController::class, 'viewCheckIn'])->name('receptionis.viewcheckin');
            Route::get('/checkout', [TransactionController::class, 'viewCheckOut'])->name('receptionis.viewcheckout');
            Route::get('/checkout-note/{transaction_id}', [TransactionController::class, 'viewCheckoutNote'])->name('receptionis.viewCheckoutNote');
            Route::post('/checkout-note/{transaction_id}', [TransactionController::class, 'storeCheckoutNote'])->name('receptionis.storeCheckoutNote');
            Route::get('/receptionis/maintenance-note/{room}', [ReceptionistController::class, 'maintenanceNote'])->name('receptionis.maintenanceNote');


            // Route::get('/checkin-pdata', [TransactionController::class, 'checkInPersonaldata'])->name('receptionis.checkin.pdata');
            // Route::post('/checkin/post', [TransactionController::class, 'checkInPost'])->name('receptionis.checkin.post');
            // Route::post('/checkin-pdata/post', [TransactionController::class, 'checkInPersonalDataPost'])->name('receptionis.checkin.pdata.post');
            // Route::get('/checkout/{id}', [TransactionController::class, 'checkOut'])->name('receptionis.checkout');
            // Route::get('/checkout-pdata/{id}', [TransactionController::class, 'checkPersonalDataOut'])->name('receptionis.pdata.checkout');
            Route::get('/receptionis/logs', [TransactionController::class, 'logs'])->name('receptionis.logs');
            Route::post('/receptionis/proof/uploadss', [PaymentController::class, 'receptionisUploadProof'])->name('receptionis.upload.proof');

            Route::get('/receptionis/room-list', [ReceptionistController::class, 'roomList'])->name('receptionis.roomList');

            Route::post('/checkout/{room_id}', [TransactionController::class, 'checkOut'])->name('receptionis.checkout');
            Route::post('/checkin/{room_id}', [TransactionController::class, 'checkIn'])->name('receptionis.checkin');

        });

        Route::group(['middleware' => 'maintenance'], function () {
            Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance.home');
            Route::patch('/maintenance/send-note', [MaintenanceController::class, 'sendNoteToReceptionist'])->name('maintenance.sendNoteToReceptionist');
            Route::get('/maintenance/detail', [MaintenanceController::class, 'userDetail'])->name('maintenance.detail');
            Route::get('/maintenance/room-facility', [MaintenanceController::class, 'roomFacility'])->name('maintenance.roomFacility');
            Route::get('/maintenance/hotel-facility', [MaintenanceController::class, 'hotelFacility'])->name('maintenance.hotelFacility');
            Route::patch('/maintenance/room-facility/{id}/toggle-status', [MaintenanceController::class, 'toggleRoomFacilityStatus'])->name('maintenance.roomFacility.toggleStatus');
            Route::patch('/maintenance/hotel-facility/{id}/toggle-status', [MaintenanceController::class, 'toggleHotelFacilityStatus'])->name('maintenance.hotelFacility.toggleStatus');
            Route::get('/maintenance/room-list', [MaintenanceController::class, 'roomList'])->name('maintenance.roomList');
            Route::get('/maintenance/detail-room/{id}', [MaintenanceController::class, 'detailRoom'])->name('maintenance.detailRoom');
            Route::put('/maintenance/detail-room/', [MaintenanceController::class, 'updateRoom'])->name('maintenance.updateRoom');
            Route::get('/maintenance/schedules', [MaintenanceController::class, 'scheduleMaintenance'])->name('maintenance.scheduleMaintenance');
        });

        Route::group(['middleware' => 'supervisor'], function () {
            Route::get('/supervisor', [HomeController::class, 'supervisor'])->name('supervisor.home');
            Route::get('/supervisor/room-facility', [SupervisorController::class, 'roomFacility'])->name('supervisor.roomFacility');
            Route::get('/supervisor/hotel-facility', [SupervisorController::class, 'hotelFacility'])->name('supervisor.hotelFacility');
            Route::get('/supervisor/maintenance-and-receptionist', [SupervisorController::class, 'maintenanceAndReceptionist'])->name('supervisor.maintenanceReceptionist');
            Route::get('/supervisor/maintenance-and-receptionist/show/{id}', [SupervisorController::class, 'showMaintenanceAndReceptionist'])->name('supervisor.maintenanceReceptionist.show');
            Route::patch('/supervisor/maintenance-and-receptionist/rate/{id}', [SupervisorController::class, 'rateMaintenanceAndReceptionist'])->name('supervisor.maintenanceReceptionist.rate');
            Route::patch('/supervisor/maintenance-and-receptionist/note/{id}', [SupervisorController::class, 'saveNote'])->name('supervisor.maintenanceReceptionist.note');
            Route::get('/supervisor/maintenance-and-receptionist/create', [SupervisorController::class, 'createMaintenanceAndReceptionist'])->name('supervisor.maintenanceReceptionist.create');
            Route::post('/supervisor/maintenance-and-receptionist', [SupervisorController::class, 'storeMaintenanceAndReceptionist'])->name('supervisor.maintenanceReceptionist.store');
        });
    });
});
