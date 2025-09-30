<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ChromoXpert Diagnostics - Test Report</title>
    <style>
        @page {
            size: A4;
            margin: 0.5cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .container {
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
            page-break-after: always;
        }
        
        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
        }
        
        .header h2 {
            font-size: 16px;
            margin: 3px 0;
        }
        
        .header p {
            font-size: 9px;
            margin: 2px 0;
        }
        
        .report-info table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 10px;
        }
        
        .report-info td {
            border: none;
            padding: 0 5px 0 0;
            vertical-align: top;
        }
        
        .info-group {
            width: 100%;
        }
        
        .info-item {
            margin: 2px 0;
            font-size: 9px;
            line-height: 1.3;
            padding: 2px 0;
        }
        
        table.tests {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 10px;
        }
        
        .tests th, .tests td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        
        .tests th {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        
        .comment {
            margin: 10px 0;
            font-style: italic;
            color: #333;
            font-size: 10px;
            padding: 8px;
            background-color: #f8f8f8;
            border-radius: 4px;
        }
        
        .signature-section {
            margin-top: 15px;
            border-top: 1px solid #000;
            padding-top: 8px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        
        .signature {
            text-align: right;
        }
        
        .signature img {
            height: 50px;
            margin-bottom: 5px;
        }
        
        .signature p {
            margin: 2px 0;
            font-size: 9px;
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
    @foreach ($reports as $report)
        <div class="container">
            <div class="header">
                <img src="{{ public_path('package_assets/images/logo.png') }}" alt="ChromoXpert Diagnostics Logo" style="height: 50px; margin-bottom: 5px;">
                <h2>ChromoXpert Diagnostics</h2>
                <p>Advanced Diagnostic Testing for Pets</p>
                <p>Navi Mumbai, India | Helpline: 7506193580</p>
                <p>Email: info@chromoxpert.com | Web: www.chromoxpert.com</p>
            </div>

            <div class="report-info">
                <table>
                    <tr>
                        <td style="width: 33%;">
                            <div class="info-group">
                                <div class="info-item"><strong>Pet ID:</strong> {{ $report['appointment']->pet->pet_code ?? 'N/A' }}</div>
                                <div class="info-item"><strong>Lab ID:</strong> {{ $report['appointment']->branch->lab_code ?? 'N/A' }}</div>
                                <div class="info-item"><strong>Report Date:</strong> {{ now()->format('d-M-Y') }}</div>
                            </div>
                        </td>
                        <td style="width: 33%;">
                            <div class="info-group">
                                <div class="info-item"><strong>Pet Name:</strong> {{ $report['appointment']->pet->name ?? 'N/A' }}</div>
                                <div class="info-item"><strong>Owner Name:</strong> {{ $report['appointment']->pet->petParent->name ?? 'N/A' }}</div>
                                <div class="info-item"><strong>Contact:</strong> {{ $report['appointment']->pet->petParent->mobile ?? 'N/A' }}</div>
                            </div>
                        </td>
                        <td style="width: 33%;">
                            <div class="info-group">
                                <div class="info-item"><strong>Species:</strong> {{ $report['appointment']->pet->species ?? 'N/A' }}</div>
                                <div class="info-item"><strong>Age:</strong> {{ $report['appointment']->pet->age ?? 'N/A' }} {{ $report['appointment']->pet->age_unit ?? 'days' }}</div>
                                <div class="info-item"><strong>Referred By:</strong> {{ $report['appointment']->refereeDoctor->doctor_name ?? 'N/A' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <table class="tests">
                <thead>
                    <tr>
                        <th>Test</th>
                        <th>Result</th>
                        <th>Unit</th>
                        <th>Normal Range</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report['test']->parameters as $parameter)
                        @if($parameter->row_type === 'title')
                            <tr>
                                <td colspan="5" style="text-align: left; font-weight: bold;">
                                    {{ $parameter->title ?? $parameter->name ?? 'Parameter Title' }}
                                </td>
                            </tr>
                        @elseif($parameter->row_type === 'component')
                            @php
                                $component = $report['testResult']->components->where('component_id', $parameter->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $parameter->name ?? 'Parameter Name' }}</td>
                                <td>{{ $component ? $component->result : 'N/A' }}</td>
                                <td>{{ $parameter->unit ?? 'N/A' }}</td>
                                <td>{{ $parameter->reference_range ?? $parameter->normal_range ?? 'N/A' }}</td>
                                <td>{{ $component ? $component->result_status : 'N/A' }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="comment">
                Comment: {{ $report['testResult']->comment ?? 'No comment available' }}
            </div>

            <div class="signature-section">
                <div class="signature">
                    <img src="{{ public_path('package_assets/images/doctor_signature.png') }}" alt="Doctor Signature"/>
                    <p>__________________________</p>
                    <p>Reviewed by: Dr. {{ $report['testResult']->signed_by_id ? ($report['testResult']->signedBy->name ?? 'N/A') : 'N/A' }}</p>
                    <p>Internal Diagnostic Specialist</p>
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>