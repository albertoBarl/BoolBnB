<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use Illuminate\Http\Request;

// controllers
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MessageController;

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
    return view('welcome');
});

// route for dashboard
Route::middleware(["auth", "verified"])->name("admin.")->prefix("admin")->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");
    Route::resource('messages', MessageController::class)->parameters(['messages' => 'message:slug']);
    Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $token = $gateway->ClientToken()->generate();

    Route::resource('sponsors', SponsorController::class);

    Route::resource('services', ServiceController::class)->parameters(['services' => 'services:slug']);
});
Route::post("/checkout", function (Request $request) {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request["amount"];
    $nonce = $request["payment_method_nonce"];

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back()->with("success_message", "Transaction successfull. The ID is:" . $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");
        return back()->withErrors("An error occurred with the message:" . $result->message);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
