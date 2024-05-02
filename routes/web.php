<?php

use App\Http\Controllers\AbsentHistoryController;
use App\Http\Controllers\ContributionInterestController;
use App\Http\Controllers\InterestCalculationController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanProductController;
use App\Http\Controllers\MeasureUnitController;
use App\Http\Controllers\RejectReasonController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankBranchController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MemberStatusController;
use App\Http\Controllers\MonthlyDeductionController;
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RegimentController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuwasahanaController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\WithdrawalProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('items-category', ItemCategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('units', MeasureUnitController::class);



});
