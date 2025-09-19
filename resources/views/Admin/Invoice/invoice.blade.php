<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ChromoXpert Diagnostics - Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fff;
            color: #000;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            margin: 2px 0;
        }
        .details {
            margin-bottom: 30px;
        }
        .details p {
            margin: 5px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .summary {
            margin-top: 20px;
            font-size: 14px;
        }
        .summary p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }
        @media print {
            body {
                margin: 0;
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

        <div class="details">
            <p><strong>Invoice No:</strong> {{ $appointmentDetails->appointment_code ?? "" }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointmentDetails->appointment_date . ' ' . $appointmentDetails->appointment_time)->format('d M Y, g:i A') }}</p>
            <p><strong>Pet ID:</strong> {{ $appointmentDetails->pet->pet_code ?? "" }}</p>
            <p><strong>Lab ID:</strong> {{ $appointmentDetails->branch->branch_code ?? "" }}</p>
            <p><strong>Pet Name:</strong> {{ $appointmentDetails->pet->name ?? "" }}</p>
            <p><strong>Owner Name:</strong> {{ $appointmentDetails->pet->petparent->name ?? "" }}</p>
            <p><strong>Contact:</strong> {{ $appointmentDetails->pet->petparent->mobile ?? "" }}</p>
            <p><strong>Species:</strong> {{ $appointmentDetails->pet->species ?? "" }}</p>
            <p><strong>Age:</strong> {{ $appointmentDetails->pet->age ?? "" }}</p>
            <p><strong>Referred By:</strong> {{ $appointmentDetails->refereeDoctor->doctor_name ?? "Self" }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Department</th>
                    <th>Test Name</th>
                    <th>Price (Rs)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @if(!empty($appointmentDetails->tests) && $appointmentDetails->tests->count())
                    @foreach ($appointmentDetails->tests as $index => $test)
                        @php $totalAmount += $test->base_price; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $test->department->department_name ?? 'N/A' }}</td>
                            <td>{{ $test->name }}</td>
                            <td>{{ number_format($test->base_price, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">No tests available.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        @php
            $discount = $appointmentDetails->discount ?? 0;
            $amountPaid = $appointmentDetails->subtotal ?? 0;
            $payableAmount =$appointmentDetails->total ?? 0;
            $dueAmount = $payableAmount - $amountPaid;
        @endphp

        <div class="summary">
            <p><strong>Total Amount (Rs):</strong> {{ number_format($totalAmount, 2) }}</p>
            {{-- <p><strong>Discount (₹):</strong> {{ number_format($discount, 2) }}</p> --}}
            {{-- <p><strong>Amount Payable (₹):</strong> {{ number_format($payableAmount, 2) }}</p> --}}
            <p><strong>Amount Paid (Rs):</strong> {{ number_format($amountPaid, 2) }}</p>
            <p><strong>Due Amount (Rs):</strong> {{ number_format($dueAmount, 2) }}</p>
        </div>

        <div class="footer">
            <div>
                <p>Print Date: {{ \Carbon\Carbon::now()->format('d-M-Y h:i A') }}</p>
            </div>
            <div style="text-align: right;">
                <p>__________________________</p>
                <p>Authorized Signatory</p>
            </div>
        </div>
    </div>
</body>

</html>
