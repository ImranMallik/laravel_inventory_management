<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\WareHouseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// *** custom Auth Controller ***//
Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('admin.login-store');
Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('admin.register-store');

Route::get('/logout', [AuthController::class, 'logoutView'])->name('admin.logout-view');

// *** Admin Dashboard ***//
Route::prefix('admin')->as('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // Profile Route
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/{id}', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/credential/{id}', [AdminProfileController::class, 'updateCredential'])->name('profile.credential.update');
    //**** Manage Brand ***//
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand-list', 'index')->name('brand.all');
        Route::get('/brand-create', 'create')->name('brand.create');
        Route::post('/brand-store', 'store')->name('brand.store');
        Route::get('/brand-edit/{id}', 'edit')->name('brand.edit');
        Route::post('/brand-update/{id}', 'update')->name('brand.update');
        Route::delete('/brand-delete/{id}', 'delete')->name('brand.delete');
    });
    // *** Ware House  ***//

    Route::controller(WareHouseController::class)->group(function () {
        Route::get('/ware-house-list', 'index')->name('ware-house.all');
        Route::get('/ware-house-create', 'create')->name('ware-house.create');
        Route::post('/ware-house-store', 'store')->name('ware-house.store');
        Route::get('/ware-house-edit/{id}', 'edit')->name('ware-house.edit');
        Route::post('/ware-house-update/{id}', 'update')->name('ware-house.update');
        Route::delete('/ware-house-update/{id}', 'delete')->name('ware-house.delete');
    });

    //*** Route Supplier ***//
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers-list', 'index')->name('supplier.all');
        Route::get('/supplier-create', 'create')->name('supplier.create');
        Route::post('/supplier-store', 'store')->name('supplier.store');
        Route::get('/supplier-edit/{id}', 'edit')->name('supplier.edit');
        Route::post('/supplier-update/{id}', 'update')->name('supplier.update');
        Route::delete('/supplier-delete/{id}', 'delete')->name('supplier.delete');
    });

    // *** Route Customer ***//
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers-list', 'index')->name('customer.all');
        Route::get('/customers-create', 'create')->name('customer.create');
        Route::post('/customers-store', 'store')->name('customer.store');
        Route::get('/customers-edit/{id}', 'edit')->name('customer.edit');
        Route::post('/customers-update/{id}', 'update')->name('customer.update');
        Route::delete('/customers-delete/{id}', 'delete')->name('customer.delete');
    });

    // *** Route Manage Category ***//
    Route::controller(ProductController::class)->group(function () {
        Route::get('/category-list', 'index')->name('category.all');
        Route::post('/category-store', 'store')->name('category.store');
        Route::post('/category-update/{id}', 'update')->name('category.update');
        Route::delete('/category-delete/{id}', 'delete')->name('category.delete');
    });
});
