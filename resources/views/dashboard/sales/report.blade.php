<!DOCTYPE html>
<html>

<head>
    <title>Sale Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 15px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
        }

        h4,
        h5 {
            margin: 0 0 10px 0;
        }

        p {
            margin: 5px 0;
        }

        .strong {
            font-weight: bold;
        }

        .section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section div {
            width: 48%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f5f5f5;
        }

        .notes {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Sale Details</h4>
            </div>
            <div class="card-body">
                <div class="section">
                    <div>
                        <h5>Customer Information</h5>
                        <p><span class="strong">Customer ID:</span> {{ $sale->customer_id }}</p>
                        <p><span class="strong">Full Name:</span> {{ $sale->full_name }}</p>
                        <p><span class="strong">Contact Information:</span> {{ $sale->contact_info }}</p>
                        <p><span class="strong">Driver's License Number:</span> {{ $sale->driver_license }}</p>
                        <p><span class="strong">Customer Type:</span> {{ $sale->customer_type }}</p>
                    </div>
                    <div>
                        <h5>Vehicle Details</h5>
                        <p><span class="strong">Make:</span> {{ $sale->make }}</p>
                        <p><span class="strong">Model:</span> {{ $sale->model }}</p>
                        <p><span class="strong">Year:</span> {{ $sale->year }}</p>
                        <p><span class="strong">VIN:</span> {{ $sale->vin }}</p>
                        <p><span class="strong">Color:</span> {{ $sale->color }}</p>
                        <p><span class="strong">Mileage:</span> {{ $sale->mileage }}</p>
                        <p><span class="strong">Condition:</span> {{ $sale->condition }}</p>
                        <p><span class="strong">Additional Features:</span> {{ $sale->additional_features }}</p>
                    </div>
                </div>
                <div class="section">
                    <div>
                        <h5>Sales Details</h5>
                        <p><span class="strong">Sales Order ID:</span> {{ $sale->invoice_number }}</p>
                        <p><span class="strong">Sales Date:</span> {{ $sale->sales_date }}</p>
                        <p><span class="strong">Salesperson Name:</span> {{ $sale->sales_person_name }}</p>
                        <p><span class="strong">Payment Method:</span> {{ $sale->payment_method }}</p>
                        <p><span class="strong">Financing Details:</span> {{ $sale->financing_details }}</p>
                        <p><span class="strong">Trade-in Details:</span> {{ $sale->trade_in_details }}</p>
                        <p><span class="strong">Discounts/Offers:</span> {{ $sale->discounts_offers }}</p>
                        <p><span class="strong">Total Price:</span> ${{ number_format($sale->total_price, 2) }}</p>
                    </div>
                    <div>
                        <h5>Warranty and Service</h5>
                        <p><span class="strong">Warranty Type:</span> {{ $sale->warranty_type }}</p>
                        <p><span class="strong">Warranty Duration:</span> {{ $sale->warranty_duration }}</p>
                        <p><span class="strong">Service Plan:</span> {{ $sale->service_plan }}</p>
                        <p><span class="strong">Scheduled Delivery Date:</span> {{ $sale->scheduled_delivery_date }}
                        </p>
                    </div>
                </div>
                <div class="section">
                    <div>
                        <h5>Documentation and Compliance</h5>
                        <p><span class="strong">Documents Required:</span> {{ $sale->documents_required }}</p>
                        <p><span class="strong">Signed Contract:</span> {{ $sale->signed_contract }}</p>
                        <p><span class="strong">Regulatory Compliance:</span> {{ $sale->regulatory_compliance }}</p>
                    </div>
                    <div>
                        <h5>Delivery Information</h5>
                        <p><span class="strong">Delivery Method:</span> {{ $sale->delivery_method }}</p>
                        <p><span class="strong">Delivery Address:</span> {{ $sale->delivery_address }}</p>
                        <p><span class="strong">Delivery Status:</span> {{ $sale->delivery_status }}</p>
                    </div>
                </div>
                <div class="notes">
                    <h5>Notes and Additional Information</h5>
                    <p><span class="strong">Special Instructions:</span> {{ $sale->special_instructions }}</p>
                    <p><span class="strong">Comments:</span> {{ $sale->comments }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
