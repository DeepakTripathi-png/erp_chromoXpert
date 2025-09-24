<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ChromoXpert Diagnostics - Invoice</title>
    <style>
        @page {
            size: A5;
            margin: 0.5cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
            font-size: 11px;
            line-height: 1.2;
        }
        
        .container {
            width: 100%;
            max-width: 14.8cm;
            margin: 0 auto;
            padding: 8px;
            box-sizing: border-box;
        }
        
        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
        }
        
        .header h2 {
            font-size: 16px;
            margin: 0 0 3px 0;
        }
        
        .header p {
            font-size: 9px;
            margin: 1px 0;
        }
        
        .invoice-info table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 8px;
        }
        
        .invoice-info td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        
        .info-group {
            width: 100%; /* Full width within td */
        }
        
        .info-item {
            margin: 3px 0;
            font-size: 10px;
            line-height: 1.3;
            padding: 1px 0;
        }
        
        table.tests {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 8px;
        }
        
        .tests th, .tests td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        
        .tests th {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        
        .tests td.price {
            text-align: right;
        }
        
        .amount-summary {
            margin-top: 10px;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        
        .amount-item {
            margin: 3px 0;
            display: flex;
            justify-content: space-between;
            width: 200px;
            margin-left: auto;
        }
        
        .footer {
            margin-top: 15px;
            font-size: 9px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px solid #000;
            padding-top: 8px;
        }
        
        .footer .signature {
            text-align: right;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .container {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>ChromoXpert Diagnostics</h2>
            <p>Advanced Diagnostic Testing for Pets</p>
            <p>Navi Mumbai, India | Helpline: 7506193580</p>
            <p>Email: info@chromoxpert.com | Web: http://chromoxpert.com/</p>
        </div>

        <div class="invoice-info">
            <table>
                <tr>
                    <td style="width: 50%;">
                        <!-- Left column -->
                        <div class="info-group">
                            <div class="info-item"><strong>Invoice No:</strong> {{ $appointmentDetails->invoice_no ?? 'APT' . str_pad($appointmentDetails->id, 3, '0', STR_PAD_LEFT) }}</div>
                            <div class="info-item"><strong>Date:</strong> {{ $appointmentDetails->appointment_date ?? now()->format('d M Y, h:i A') }}</div>
                            <div class="info-item"><strong>Pet ID:</strong> {{ $appointmentDetails->pet->pet_id ?? 'N/A' }}</div>
                            <div class="info-item"><strong>Lab ID:</strong> {{ $appointmentDetails->branch->lab_id ?? 'N/A' }}</div>
                        </div>
                    </td>
                    <td style="width: 50%;">
                        <!-- Right column -->
                        <div class="info-group">
                            <div class="info-item"><strong>Pet Name:</strong> {{ $appointmentDetails->pet->name ?? 'N/A' }}</div>
                            <div class="info-item"><strong>Owner Name:</strong> {{ $appointmentDetails->pet->petParent->name ?? 'N/A' }}</div>
                            <div class="info-item"><strong>Contact:</strong> {{ $appointmentDetails->pet->petParent->contact ?? 'N/A' }}</div>
                            <div class="info-item"><strong>Species:</strong> {{ $appointmentDetails->pet->species ?? 'N/A' }}</div>
                            <div class="info-item"><strong>Age:</strong> {{ $appointmentDetails->pet->age ?? 'N/A' }} {{ $appointmentDetails->pet->age_unit ?? 'days' }}</div>
                            <div class="info-item"><strong>Referred By:</strong> {{ $appointmentDetails->refereeDoctor->name ?? 'N/A' }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="tests">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Department</th>
                    <th>Test Name</th>
                    <th>Price (Rs)</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; $srNo = 1; @endphp
                @foreach($appointmentDetails->tests ?? [] as $test)
                    <tr>
                        <td>{{ $srNo++ }}</td>
                        <td>{{ $test->department->department_name ?? 'N/A' }}</td>
                        <td>{{ $test->name ?? 'N/A' }}</td>
                        <td class="price">{{ number_format($test->base_price ?? 0, 2) }}</td>
                    </tr>
                    @php $total += $test->base_price ?? 0; @endphp
                @endforeach
                @if(empty($appointmentDetails->tests))
                    <tr>
                        <td colspan="4">No tests found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="amount-summary">
            <div class="amount-item">
                <strong>Payable Amount (Rs):</strong> 
                <span>{{ number_format($total, 2) }}</span>
            </div>
            <div class="amount-item">
                <strong>Amount Paid (Rs):</strong> 
                <span>{{ number_format($appointmentDetails->paid_amount ?? $total, 2) }}</span>
            </div>
            <div class="amount-item">
                <strong>Due Amount (Rs):</strong> 
                <span>{{ number_format($total - ($appointmentDetails->paid_amount?? $total), 2) }}</span>
            </div>
        </div>

        <div class="footer">
            <div>
                <p>Print Date: {{ now()->format('d-M-Y h:i A') }}</p>
            </div>
            <div class="signature">
                <p>__________________________</p>
                <p>Authorized Signatory</p>
            </div>
        </div>
    </div>
</body>
</html>