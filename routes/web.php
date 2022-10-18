<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardOfTrusteesController;
use App\Http\Controllers\ChairmanController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('wizard', function () {
    return view('welcome');
});*/
Route::get('/register', function () {
    return view('welcome');
});
/*Route::get('login', function () {
    return view('auth.login');
});*/


/*Admin Controller Routes*/
Route::get('/',[AdminController::class, 'login'])->name('login');
Route::post('/login-auth',[AdminController::class, 'loginAuth']);
Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');


Route::resource('savings', SavingsController::class);


Route::get('/admin-dashboard',[AdminController::class, 'adminDashboard'])->name('admin.dashboard');












/*Member Dashboard*/
Route::get('/member-dashboard',[MemberController::class, 'memberDashboard'])->name('member.dashboard');
Route::get('/member-profile',[MemberController::class, 'memberProfile'])->name('member.profile');
Route::get('/logout',[MemberController::class, 'logout'])->name('logout');





Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});


/*Add Savings*/
Route::get('/import-member-savings',[SavingsController::class, 'importForm']);
Route::post('/import',[AdminController::class, 'import'])->name('user.import');

/*user savings*/
Route::get('/savings-amount',[AdminController::class, 'savingsBalance']);

/*Route::get('/user-bank-details',[AdminController::class, 'bankDetails']);*/



/*chairman Routes*/
Route::get('/chairman-dashboard',[ChairmanController::class, 'index'])->name('chairman.dashboard');

Route::get('/soft-loan-requests',[ChairmanController::class, 'softloanRequests'])->name('soft.loan.requests');
/*approve soft loan*/
Route::post('/approve-soft-loan',[ChairmanController::class, 'approveSoftLoan'])->name('approve.soft.loan');
/*delete soft loan*/
Route::post('/delete-soft-loan',[ChairmanController::class, 'deleteSoftLoan'])->name('delete.soft.loan');
/*refund soft loan*/
Route::post('/refund-soft-loan',[ChairmanController::class, 'refundSoftLoan'])->name('refund.soft.loan');


/*emergency loan*/
Route::get('/emergency-loan-requests',[ChairmanController::class, 'emergencyLoanRequests'])->name('emergency.loan.requests');
/*approve emergency loan*/
Route::post('/approve-emergency-loan',[ChairmanController::class, 'approveEmergencyLoan'])->name('approve.emergency.loan');
/*delete emergency loan*/
Route::post('/delete-emergency-loan',[ChairmanController::class, 'deleteEmergencyLoan'])->name('delete.emergency.loan');
/*refund emergency loan*/
Route::post('/refund-emergency-loan',[ChairmanController::class, 'refundEmergencyLoan'])->name('refund.emergency.loan');



/*special loan*/
Route::get('/special-loan-requests',[ChairmanController::class, 'specialLoanRequests'])->name('special.loan.requests');
/*approve emergency loan*/
Route::post('/approve-special-loan',[ChairmanController::class, 'approveSpecialLoan'])->name('approve.special.loan');
/*delete emergency loan*/
Route::post('/delete-special-loan',[ChairmanController::class, 'deleteSpecialLoan'])->name('delete.special.loan');
/*refund emergency loan*/
Route::post('/refund-special-loan',[ChairmanController::class, 'refundSpecialLoan'])->name('refund.special.loan');


/*food loan*/
Route::get('/food-loan-requests',[ChairmanController::class, 'foodLoanRequests'])->name('food.loan.requests');
/*approve emergency loan*/
Route::post('/approve-food-loan',[ChairmanController::class, 'approveFoodLoan'])->name('approve.food.loan');
/*delete emergency loan*/
Route::post('/delete-food-loan',[ChairmanController::class, 'deleteFoodLoan'])->name('delete.food.loan');
/*refund emergency loan*/
Route::post('/refund-food-loan',[ChairmanController::class, 'refundFoodLoan'])->name('refund.food.loan');


/*Shares Controller Routes*/
Route::get('/admin-shares',[ChairmanController::class, 'adminShares'])->name('admin.add-shares');
Route::post('/admin-new-shares',[ChairmanController::class, 'addShares'])->name('add-shares');
Route::get('/shares-requests', [ChairmanController::class, 'sharesRequests'])->name('shares.requests');
Route::post('/approve-shares',[ChairmanController::class, 'approveShares'])->name('approve-shares');

/*Savings routes*/

Route::get('/batch-upload-savings',[ChairmanController::class, 'batchUpload'])->name('batch.upload.savings');

Route::post('/batch-upload-save',[ChairmanController::class, 'import'])->name('batch.upload');
/*all contributions*/
Route::get('/contributions',[ChairmanController::class, 'contributions'])->name('contributions');

Route::get('/members',[ChairmanController::class, 'members'])->name('members');

Route::post('/export-members',[ChairmanController::class, 'export'])->name('export.members');


/*executive routes*/
Route::get('/executives-dashboard',[ExecutiveController::class, 'index'])->name('executive.dashboard');

/*appliance loan*/
Route::get('/appliance-loan-requests',[ExecutiveController::class, 'applianceLoanRequests'])->name('appliance.loan.requests');
/*approve appliance loan*/
Route::post('/approve-appliance-loan',[ExecutiveController::class, 'approveApplianceLoan'])->name('approve.appliance.loan');
/*delete appliance loan*/
Route::post('/delete-appliance-loan',[ExecutiveController::class, 'deleteApplianceLoan'])->name('delete.appliance.loan');
/*refund appliance loan*/
Route::post('/refund-appliance-loan',[ExecutiveController::class, 'refundApplianceLoan'])->name('refund.appliance.loan');

/*ordinary loan*/
Route::get('/ordinary-loan-requests',[ExecutiveController::class, 'ordinaryLoanRequests'])->name('ordinary.loan.requests');
/*approve ordinary loan*/
Route::post('/approve-ordinary-loan',[ExecutiveController::class, 'approveOrdinaryLoan'])->name('approve.ordinary.loan');
/*liquidate ordinary loan*/
Route::post('/liquidate-ordinary-loan',[ExecutiveController::class, 'liquidateOrdinaryLoan'])->name('liquidate.ordinary.loan');
/*delete ordinary loan*/
Route::post('/delete-ordinary-loan',[ExecutiveController::class, 'deleteOrdinaryLoan'])->name('delete.ordinary.loan');
/*refund ordinary loan*/
Route::post('/refund-ordinary-loan',[ExecutiveController::class, 'refundOrdinaryLoan'])->name('refund.ordinary.loan');



/*board of trustees routes*/
Route::get('/board-of-trustees-dashboard',[BoardOfTrusteesController::class, 'index'])->name('board-of-trustees.dashboard');

/*special loan*/
Route::get('/special-loan-requests',[BoardOfTrusteesController::class, 'specialLoanRequests'])->name('special.loan.requests');

/*approve emergency loan*/
Route::post('/approve-special-loan',[BoardOfTrusteesController::class, 'approveSpecialLoan'])->name('approve.special.loan');
/*delete emergency loan*/
Route::post('/delete-special-loan',[BoardOfTrusteesController::class, 'deleteOrdinaryLoan'])->name('delete.special.loan');
/*refund emergency loan*/
Route::post('/refund-special-loan',[BoardOfTrusteesController::class, 'refundSpecialLoan'])->name('refund.special.loan');

/*Special Top-Up Loan*/
Route::get('/special-top-up-loan-requests',[BoardOfTrusteesController::class, 'specialTopUpLoanRequests'])->name('special.top-up.loan.requests');
Route::post('/approve-special-top-up-loan',[BoardOfTrusteesController::class, 'approveSpecialTopUpLoan'])->name('approve.special.top-up.loan');




//Gallery Image

Route::get('/image-gallery',[ImageGalleryController::class, 'index']);
Route::post('/image-gallery',[ImageGalleryController::class, 'upload']);
Route::delete('/image-gallery/{id}',[ImageGalleryController::class, 'destroy']);

//Profile Update
Route::post('/update-profile-pic',[MemberController::class, 'updateProfilePic'])->name('update.profile.pic');

//Bank Details Update
Route::post('/update-bank-details',[MemberController::class, 'updateBankDetails'])->name('update.bank.details');






/*Member's Loan Routes*/
/*soft loan*/
Route::get('/member-soft-loan-apply',[MemberController::class, 'softLoan'])->name('member.soft.loan.apply');
Route::post('/member-soft-loan-submit',[MemberController::class, 'softLoanSubmit'])->name('member.soft.loan.submit');
Route::get('/member-soft-loan-requests',[MemberController::class, 'softLoanRequests'])->name('member.soft.loan.requests');
Route::get('/member-soft-loan-refunds',[MemberController::class, 'softLoanRefunds'])->name('member.soft.loan.refunds');

/*emergency loan*/
Route::get('/member-emergency-loan-apply',[MemberController::class, 'emergencyLoan'])->name('member.emergency.loan.apply');
Route::post('/member-emergency-loan-submit',[MemberController::class, 'emergencyLoanSubmit'])->name('member.emergency.loan.submit');
Route::get('/member-emergency-loan-requests',[MemberController::class, 'emergencyLoanRequests'])->name('member.emergency.loan.requests');
Route::get('/member-emergency-loan-refunds',[MemberController::class, 'emergencyLoanRefunds'])->name('member.emergency.loan.refunds');

/*ordinary loan*/
Route::get('/member-ordinary-loan-apply',[MemberController::class, 'ordinaryLoan'])->name('member.ordinary.loan.apply');
Route::post('/member-ordinary-loan-submit',[MemberController::class, 'ordinaryLoanSubmit'])->name('member.ordinary.loan.submit');
Route::get('/member-ordinary-loan-requests',[MemberController::class, 'ordinaryLoanRequests'])->name('member.ordinary.loan.requests');
Route::get('/member-ordinary-loan-refunds',[MemberController::class, 'ordinaryLoanRefunds'])->name('member.ordinary.loan.refunds');

/*special loan*/
Route::get('/member-special-loan-apply',[MemberController::class, 'specialLoan'])->name('member.special.loan.apply');
Route::post('/member-special-loan-submit',[MemberController::class, 'specialLoanSubmit'])->name('member.special.loan.submit');
Route::get('/member-special-loan-requests',[MemberController::class, 'specialLoanRequests'])->name('member.special.loan.requests');
Route::get('/member-special-loan-refunds',[MemberController::class, 'specialLoanRefunds'])->name('member.special.loan.refunds');
/*special topup request*/
Route::get('/member-special-top-up-loan-apply',[MemberController::class, 'specialTopUpLoan'])->name('member.special.top-up.loan.apply');
Route::post('/member-special-top-up-loan-submit',[MemberController::class, 'specialTopUpLoanSubmit'])->name('member.special.top-up.loan.submit');

/*food loan*/
Route::get('/member-food-loan-apply',[MemberController::class, 'foodLoan'])->name('member.food.loan.apply');
Route::post('/member-food-loan-submit',[MemberController::class, 'foodLoanSubmit'])->name('member.food.loan.submit');
Route::get('/member-food-loan-requests',[MemberController::class, 'foodLoanRequests'])->name('member.food.loan.requests');
Route::get('/member-food-loan-refunds',[MemberController::class, 'foodLoanRefunds'])->name('member.food.loan.refunds');


/*appliance loan*/
Route::get('/member-appliance-loan-apply',[MemberController::class, 'applianceLoan'])->name('member.appliance.loan.apply');
Route::post('/member-appliance-loan-submit',[MemberController::class, 'applianceLoanSubmit'])->name('member.appliance.loan.submit');
Route::get('/member-appliance-loan-requests',[MemberController::class, 'applianceLoanRequests'])->name('member.appliance.loan.requests');
Route::get('/member-appliance-loan-refunds',[MemberController::class, 'applianceLoanRefunds'])->name('member.appliance.loan.refunds');

/*members share route*/
Route::get('/member-shares', [MemberController::class, 'memberShares'])->name('member.shares');
Route::post('/buy-shares', [MemberController::class, 'buyShares'])->name('buy.shares');


/*members contributions*/
Route::get('/member-contributions', [MemberController::class, 'memberContributions'])->name('member.contributions');
