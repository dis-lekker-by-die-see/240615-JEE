
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Query') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("This is the Query page inside the kami directory.") }}
                </div>
                <div class="container">
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
{{-- 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Query') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errorMessage)
                        <div style="color: red;">
                            <strong>Error:<br></strong> {{ $errorMessage }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('query.execute') }}">
                        @csrf
                        <div>
                            <label for="table">View all columns and rows from TABLE:</label>
                            <select name="table" id="table">
                                @foreach ($tables as $table)
                                    <option value="{{ $table }}" {{ $selectedTable == $table ? 'selected' : '' }}>
                                        {{ $table }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" name="table-submit">Submit</button>
                        </div>
                    </form>

                    <h5>or<br></h5>
                    <form method="post" action="{{ route('query.execute') }}">
                        @csrf
                        <div>
                            <label for="raw_query">SQL Query:<br></label>
                            <textarea name="raw_query" id="raw_query" rows="4" cols="50" placeholder="e.g., SELECT * FROM table_name">{{ $rawQuery }}</textarea>
                            <button type="submit" name="raw-query-submit">Run Query</button>
                        </div>
                    </form>

                    @if ($results->isNotEmpty())
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        @foreach ((array) $results->first() as $key => $value)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            @foreach ((array) $result as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Query') }}
        </h2>
    </x-slot>

    <style>
        body {
            color: #333;
        }
        .container {
            margin: 2%;
        }
        .query-container {
            margin: 20px 0;
        }
        .raw_query {
            font-size: 1.1em;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }
        /* th {
            background-color: #f2f2f2;
        } */
        .table-submit, .raw-query-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* button:hover {
            background-color: #45a049;
        } */
        .error-message {
            color: red;
            margin-top: 10px;
        }
        select {
            background-color: #f2f2f2;
            color: #333;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errorMessage)
                        <div class="error-message">
                            <strong>Error:<br></strong> {{ $errorMessage }}
                        </div>
                    @endif

                    <div class="query-container">
                        <form method="post" action="{{ route('query.execute') }}">
                            @csrf
                            <div>
                                <label for="table">View all columns and rows from TABLE:</label>
                                <select name="table" id="table">
                                    @foreach ($tables as $table)
                                        <option value="{{ $table }}" {{ $selectedTable == $table ? 'selected' : '' }}>
                                            {{ $table }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="table-submit" type="submit" name="table-submit">Submit</button>
                            </div>
                        </form>

                        <h5>or<br></h5>
                        <form method="post" action="{{ route('query.execute') }}">
                            @csrf
                            <div>
                                <label for="raw_query">SQL Query:<br></label>
                                <textarea class="raw_query" name="raw_query" id="raw_query" rows="4" placeholder="e.g., SELECT * FROM table_name">{{ $rawQuery }}</textarea>
                                <button class="raw-query-submit" type="submit" name="raw-query-submit">Run Query</button>
                            </div>
                        </form>
                    </div>

                    @if ($results->isNotEmpty())
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        @foreach ((array) $results->first() as $key => $value)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            @foreach ((array) $result as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
