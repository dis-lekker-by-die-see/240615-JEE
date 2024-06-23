<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueryController extends Controller
{
    // public function index()
    // {
    //     return view('kami.query');
    // }

    public function index(Request $request)
    {
        try {
            // Attempt to connect to the database
            DB::connection()->getPdo();

            // Log the DB host
            Log::info('DB Host:', ['host' => config('database.connections.mysql.host')]);

            // Fetch list of tables
            $tables = DB::select('SHOW TABLES');
            $tables = array_map('current', $tables); // Flatten array

            return view('kami.query', [
                'tables' => $tables,
                'results' => collect(),
                'selectedTable' => '',
                'rawQuery' => '',
                'errorMessage' => null
            ]);
        } catch (\Exception $e) {
            Log::error('Could not connect to the database. Error: ' . $e->getMessage());
            return 'Could not connect to the database. Error: ' . $e->getMessage();
        }
    }

    public function executeQuery(Request $request)
    {
        try {
            DB::connection()->getPdo();
            $tables = DB::select('SHOW TABLES');
            $tables = array_map('current', $tables); // Flatten array

            $results = collect();
            $errorMessage = null;

            if ($request->has('table-submit')) {
                $table = $request->input('table');
                if (!empty($table)) {
                    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
                    $queryString = "SELECT * FROM {$table}";
                    Log::info('Final query string: ' . $queryString);

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

            if ($request->has('raw-query-submit')) {
                $rawQuery = trim($request->input('raw_query', ''));
                Log::info('Raw query: ' . $rawQuery);

                try {
                    $results = collect(DB::select($rawQuery));
                } catch (\Exception $e) {
                    Log::error('Error executing raw query: ' . $rawQuery . ' | Error: ' . $e->getMessage());
                    $errorMessage = 'Error executing query: ' . $e->getMessage();
                }
            }

            return view('kami.query', [
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
    }




}
