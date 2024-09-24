<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <h1>Vehicle Report</h1>
    <table>
        <thead>
            <tr>
                <th>VIN</th>
                <th>Service Count</th>
                <th>Total Estimated Cost</th>
                <th>Owner</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->vin }}</td>
                    <td>{{ $vehicle->service_count }}</td>
                    <td>Rs{{ number_format($vehicle->total_estimated_cost, 2) }}</td>
                    <td>{{ $vehicle->owner ? $vehicle->owner->name : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
