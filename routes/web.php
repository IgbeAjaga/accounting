<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartonQtyController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role == 'admin') {
            return view('adminDashboard');
        } elseif ($user->role == 'superadmin') {
            return view('superAdminDashboard');
        } elseif ($user->role == 'customercare') {
            return view('customerCareDashboard');
        } else {
            // Handle other roles or default case
            return view('dashboard');
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');   
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    

    Route::resource('transactions', TransactionController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('cartons',CartonQtyController::class);
    
    
    Route::get('/allcustomers', [CustomerController::class, 'index'])->name('allcustomers');
    Route::get('/alltransactions', [TransactionController::class, 'index'])->name('alltransactions');
    Route::get('/allcartons', [CartonQtyController::class, 'index'])->name('allcartons');   
    
    
    

    Route::get('/searchcustomer', [CustomerController::class, 'search'])->name('searchcustomer');
    Route::get('/searchcarton', [CartonQtyController::class, 'search'])->name('searchcarton');
    Route::get('/searchtransaction', [TransactionController::class, 'search'])->name('searchtransaction');
    Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
    Route::get('/export', [TransactionController::class, 'export'])->name('transactions.export');
    



Route::get('/create-customer', function() {
    return view('createcustomer');
})->name('create.customer.form');

Route::post('/create-customer', [CustomerController::class, 'createCustomer'])->name('create.customer');

Route::get('/deposit', function() {
    return view('depositform');
})->name('deposit.form');

Route::get('/purchase', function() {
    return view('purchaseform');
})->name('purchase.form');

Route::post('/process-transaction', [CustomerController::class, 'processTransaction'])->name('process.transaction');

Route::post('/process-transaction', [CartonQtyController::class, 'processTransaction'])->name('process.transaction');



});

Route::middleware(['auth'])->group(function () {
    // Routes for admin dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Routes for super admin dashboard
    Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.dashboard');

    // Routes for customer care dashboard
    Route::get('/customercare/dashboard', [CustomerCareDashboardController::class, 'index'])->name('customercare.dashboard');
       

    // Routes for user profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});


// Routes
Route::post('/deposit', [DepositController::class, 'store']);
Route::post('/purchase', [PurchaseController::class, 'store']);


// Display the form to add a carton
Route::get('/cartonqty/add', function() {
    return view('addcarton');
})->name('cartonqty.add.form');

// Handle the form submission to add a carton
Route::post('/cartonqty/add', [CartonQtyController::class, 'addCarton'])->name('cartonqty.add');

// Handle the form submission to purchase a carton
Route::post('/cartonqty/purchase', [TransactionController::class, 'purchaseCarton'])->name('cartonqty.purchase');

require __DIR__.'/auth.php';
