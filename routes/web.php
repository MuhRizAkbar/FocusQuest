<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// 1. Public Player Routes
Route::get('/', function () { return view('welcome'); });
Route::get('/game', function () { return view('game'); });
Route::get('/results', function () { return view('mainpage'); });

// Public Data Save Route (Aman dengan CSRF Token)
Route::post('/save-results', [AdminController::class, 'saveResults'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// 2. Admin Authentication Routes
Route::get('/login', function () {
    if (session('is_admin')) return redirect('/admin');
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// 3. Protected Admin UI Routes (Membutuhkan Login)
Route::get('/admin', function () {
    if (!session('is_admin')) return redirect('/login')->withErrors(['password' => 'Harap login.']);
    return view('admin'); 
});

Route::get('/admin/export', function () {
    if (!session('is_admin')) return redirect('/login')->withErrors(['password' => 'Harap login.']);
    return app(AdminController::class)->exportCsv(); 
});

Route::get('/admin/raw-data', function () {
    if (!session('is_admin')) return redirect('/login')->withErrors(['password' => 'Harap login.']);
    return view('raw-data'); 
});

// 4. Protected Admin Data Fetch Routes (Membutuhkan Login)
Route::get('/dashboard-data', function () {
    if (!session('is_admin')) return response()->json(['error' => 'Unauthorized'], 401);
    return app(AdminController::class)->getDashboardData(); 
});

Route::get('/raw-data-api', function () {
    if (!session('is_admin')) return response()->json(['error' => 'Unauthorized'], 401);
    return app(AdminController::class)->getRawDataAPI(); 
});