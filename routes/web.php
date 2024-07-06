<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\KamiDashboardController;
use App\Http\Controllers\AssociationDashboardController;
use App\Http\Controllers\ClubDashboardController;
use App\Http\Controllers\RiderDashboardController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\AssociationController;

/////////////////////////////////////////////////////////////////////////////////

Route::get('/test-app-name', function () {
    return config('app.name');
    return env('APP_NAME', 'Default from env function');
});

Route::get('/flags', [CountryController::class, 'index'])->name('flags.index');

/////////////////////////////////////////////////////////////////////////////////

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role->role_name ?? null;
        switch ($role) {
            case 'kami':
                return redirect()->route('kami.dashboard');
            case 'association':
                return redirect()->route('association.dashboard');
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

    // association.query //////////////////////////////////////////////////////////
    Route::middleware('role:association')->group(function () {
        Route::get('/association/dashboard', [AssociationDashboardController::class, 'index'])->name('association.dashboard');
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

//////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth', 'role:club'])->group(function () {
    Route::get('/club/dashboard', [ClubController::class, 'dashboard'])->name('club.dashboard');
    Route::get('/club/details', [ClubController::class, 'show'])->name('club.details'); // New route for club details
    Route::post('/club/details', [ClubController::class, 'store'])->name('club.store'); // New route for storing club details
    Route::get('/club/riders', [ClubController::class, 'clubRiders'])->name('club.riders');

    //Route::post('/club/riders', [ClubController::class, 'storeRider'])->name('club.storeRider'); // New route for storing rider
    Route::post('/club/storeRider', [ClubController::class, 'storeRider'])->name('club.storeRider'); // New route for storing new rider details


    Route::post('/club/approve/{rider_id}', [ClubController::class, 'approveRider'])->name('club.approveRider');
    Route::post('/club/decline/{rider_id}', [ClubController::class, 'declineRider'])->name('club.declineRider');
});

//////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('/rider/dashboard', [RiderController::class, 'show'])->name('rider.dashboard');
    Route::post('/rider/dashboard', [RiderController::class, 'store'])->name('rider.dashboard.store');
});

//////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth', 'role:association'])->group(function () {
    Route::get('/association/dashboard', [AssociationController::class, 'dashboard'])->name('association.dashboard');
    Route::post('/association/approve/{club_id}', [AssociationController::class, 'approveClub'])->name('association.approveClub');
    Route::post('/association/decline/{club_id}', [AssociationController::class, 'declineClub'])->name('association.declineClub');
});

//////////////////////////////////////////////////////////////////////////////////




require __DIR__.'/auth.php';
