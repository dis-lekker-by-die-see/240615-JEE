 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta charset="UTF-8">
     <title>DB Test</title>
     <style>
        .query-container {
            margin: 2%;
        }
        .raw_query {
            font-size: 1.3em;
            padding: 8px;
        }
         .table-container {
             overflow-x: auto;
         }
         table {
             width: 100%;
             border-collapse: collapse;
         }
         th, td {
             border: 1px solid #ccc;
             padding: 8px;
             text-align: left;
         }
     </style>
 </head>
 <body>
    <h1>Database Query Page</h1>
    <div class="query-container">
        <form method="post" action="/db-test">
            @csrf
            <label for="table">View all columns and rows from TABLE : </label>
            <select name="table" id="table">
                @foreach ($tables as $table)
                    <option value="{{ $table }}" {{ $selectedTable == $table ? 'selected' : '' }}>
                        {{ $table }}
                    </option>
                @endforeach
            </select>
            <button type="submit" name="table-submit">Submit</button>
        </form>
    
        <h5>or<br></h5>
        <form method="post" action="/db-test">
            @csrf
            <label for="raw_query">SQL Query:<br></label>
            <textarea class="raw_query" name="raw_query" id="raw_query" rows="4" cols="50" placeholder="e.g., SELECT * FROM table_name">{{ $rawQuery }}</textarea>
            <button class="raw-query-submit" type="submit" name="raw-query-submit">Run Query</button>
        </form>
        @if ($errorMessage)
            <div style="color: red;">
                <strong>Error:<br></strong> {{ $errorMessage }}
            </div>
        @endif
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
 </body>
 </html>
 