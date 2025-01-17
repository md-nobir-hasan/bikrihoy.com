<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipping Label</title>
    <style>
        @page {
            size: 75mm 50mm;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            width: 75mm;
            height: 50mm;
            font-family: Arial, sans-serif;
        }
        .label {
            width: 100%;
            height: 100%;
            padding: 2mm;
            box-sizing: border-box;
            border: 1px solid #000;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2mm;
            padding-bottom: 1mm;
            border-bottom: 1px solid #000;
        }
        .logo {
            width: 20mm;
            height: auto;
            max-height: 15mm;
        }
        .shipping-details {
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
            position: relative;
        }
        .shipping-details::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
            width: 1px;
            background: #000;
        }
        .from-section, .to-section {
            width: 47%;
            padding: 0 1mm;
        }
        .section-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 1mm;
        }
        .customer-name {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 1mm;
            text-transform: uppercase;
        }
        .customer-phone {
            font-size: 9pt;
            margin-bottom: 1mm;
        }
        .customer-address {
            font-size: 8pt;
            line-height: 1.2;
        }
        .invoice-number {
            position: absolute;
            top: 2mm;
            right: 2mm;
            font-size: 8pt;
            font-weight: bold;
            padding: 0.5mm 1mm;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    @foreach($orders as $order)
        @php
            $excelData = $order->getFormattedExcelData();
            $invoiceId = $excelData['Invoice ID'][0] ?? '';
            $company = companyInfo();
        @endphp
        <div class="label">
            <div class="invoice-number">#{{ $invoiceId }}</div>

            <div class="logo-container">
                <img src="{{ asset($company->logo ?? 'assets/backend/images/logo.png') }}"
                     alt="Logo"
                     class="logo">
            </div>

            <div class="shipping-details">
                <div class="from-section">
                    <div class="section-title">From:</div>
                    {{ $company->title ?? '' }}<br>
                    {{ $company->address ?? '' }}
                </div>
                <div class="to-section">
                    <div class="section-title">To:</div>
                    <div class="customer-name">
                        {{ $excelData['Name'][0] ?? '' }},
                    </div>
                    <div class="customer-phone">
                        {{ $excelData['Phone'][0] ?? '' }},
                    </div>
                    <div class="customer-address">
                        {{ $excelData['Address'][0] ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
