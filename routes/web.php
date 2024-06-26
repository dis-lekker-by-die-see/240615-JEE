<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KamiDashboardController;
use App\Http\Controllers\OrganizerDashboardController;
use App\Http\Controllers\ClubDashboardController;
use App\Http\Controllers\RiderDashboardController;

use App\Http\Controllers\QueryController;
//use App\Http\Controllers\RegisterNewUserController;


Route::get('/test-app-name', function () {
    return config('app.name');
    return env('APP_NAME', 'Default from env function');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::match(['get', 'post'], '/db-test', function (Request $request) {
    try {
        // Attempt to connect to the database
        DB::connection()->getPdo();

        // Add this in a route or controller
        Log::info('DB Host:', ['host' => config('database.connections.mysql.host')]);

        // Fetch list of tables
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables); // Flatten array

        // Initialize results and error message
        $results = collect();
        $errorMessage = null;

        // Handle table selection form submission
        if ($request->isMethod('post') && $request->has('table-submit')) {
            $table = $request->input('table');

            if (!empty($table)) {
                // Sanitize table name to prevent SQL injection
                $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

                // Base query string
                $queryString = "SELECT * FROM {$table}";

                // Log the final query string before execution
                Log::info('Final query string: ' . $queryString);

                // Execute the query
                try {
                    $results = collect(DB::select($queryString));
                } catch (\Exception $e) {
                    Log::error('Error executing query: ' . $queryString . ' | Error: ' . $e->getMessage());
                    $errorMessage = 'Error executing query: ' . $e->getMessage();
                }
            } else {
                Log::error('Table name is empty or invalid');
                $errorMessage = 'Table name is empty or invalid';
            }
        }
        // Handle raw SQL query form submission
        if ($request->isMethod('post') && $request->has('raw-query-submit')) {
            $rawQuery = trim($request->input('raw_query', ''));

            // Log the raw query
            Log::info('Raw query: ' . $rawQuery);

            // Execute the raw query
            try {
                $results = collect(DB::select($rawQuery));
            } catch (\Exception $e) {
                Log::error('Error executing raw query: ' . $rawQuery . ' | Error: ' . $e->getMessage());
                $errorMessage = 'Error executing query: ' . $e->getMessage();
            }
        }
        return view('db-test', [
            'tables' => $tables,
            'results' => $results,
            'selectedTable' => $request->input('table', ''),
            'rawQuery' => $request->input('raw_query', ''),
            'errorMessage' => $errorMessage
        ]);

    } catch (\Exception $e) {
        Log::error('Could not connect to the database. Error: ' . $e->getMessage());
        return 'Could not connect to the database. Error: ' . $e->getMessage();
    }
});

// Routes for authenticated and verified users
//Route::middleware(['auth', 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        //$role = auth()->user()->role;
        //$role = auth()->user()->roles->pluck('role_name')->first();
        $role = auth()->user()->role->role_name ?? null;
        switch ($role) {
            case 'kami':
                return redirect()->route('kami.dashboard');
            case 'organizer':
                return redirect()->route('organizer.dashboard');
            case 'club':
                return redirect()->route('club.dashboard');
            case 'rider':
                return redirect()->route('rider.dashboard');
            default:
                abort(403, 'Unauthorized action.');
        }
    })->name('dashboard');

    // kami.query //////////////////////////////////////////////////////////
    Route::middleware('role:kami')->group(function () {
        Route::get('/kami/dashboard', [KamiDashboardController::class, 'index'])->name('kami.dashboard');
    });
    Route::get('/kami/query', [QueryController::class, 'index'])->name('query');
    Route::post('/kami/query', [QueryController::class, 'executeQuery'])->name('query.execute');

    // organizer.query //////////////////////////////////////////////////////////
    Route::middleware('role:organizer')->group(function () {
        Route::get('/organizer/dashboard', [OrganizerDashboardController::class, 'index'])->name('organizer.dashboard');
    });

    // club.query //////////////////////////////////////////////////////////
    //Route::middleware(['role:club', 'verified'])->group(function () { // use this line during production
    Route::middleware('role:club')->group(function () {
        Route::get('/club/dashboard', [ClubDashboardController::class, 'index'])->name('club.dashboard');
    });

    // rider.query //////////////////////////////////////////////////////////
    //Route::middleware(['role:rider', 'verified'])->group(function () { // use this line during production
    Route::middleware('role:rider')->group(function () {
        Route::get('/rider/dashboard', [RiderDashboardController::class, 'index'])->name('rider.dashboard');
    });
});

// // Registration routes
// Route::get('register', [RegisterNewUserController::class, 'create'])->name('register');
// Route::post('register', [RegisterNewUserController::class, 'store']);






require __DIR__.'/auth.php';
