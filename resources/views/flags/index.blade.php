<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flags</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img.flag {
            width: 42px;
        }
        .emoji-flag {
            font-size: 60px; /* Set the font size to 42px */
        }
    </style>
</head>
<body>
    <h1>Flags</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Country Code</th>
                <th>Emoji Flag</th>
                <th>Flag 1x1</th>
                <th>Flag 1x1 Path</th>
                <th>Flag 4x3</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->country_code }}</td>
                    <td class="emoji-flag">{{ $country->country_emoji }}</td>
                    <td><img class="flag" src="{{ asset($country->country_flag_1x1) }}" alt="{{ $country->country_name }} flag 1x1"></td>
                    <td>{{ asset($country->country_flag_1x1) }}</td>
                    <td><img class="flag" src="{{ asset($country->country_flag_4x3) }}" alt="{{ $country->country_name }} flag 4x3"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
