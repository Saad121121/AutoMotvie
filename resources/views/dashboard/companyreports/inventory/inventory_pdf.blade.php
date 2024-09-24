<!DOCTYPE html>
<html>

<head>
    <title>Inventory Report</title>
</head>

<body>
    <h1>Showroom Inventory Report</h1>
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 8px;">S.No</th>
                <th style="border: 1px solid black; padding: 8px;">VIN</th>
                <th style="border: 1px solid black; padding: 8px;">Make</th>
                <th style="border: 1px solid black; padding: 8px;">Model</th>
                <th style="border: 1px solid black; padding: 8px;">Year</th>
                <th style="border: 1px solid black; padding: 8px;">Color</th>
                <th style="border: 1px solid black; padding: 8px;">Engine Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['S.No'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['VIN'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['Make'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['Model'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['Year'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['Color'] }}</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $row['Engine Type'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
