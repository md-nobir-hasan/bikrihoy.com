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
            font-family: Arial, sans-serif;
            width: 75mm;
        }
        .label {
            width: 71mm;
            height: 46mm;
            padding: 2mm;
            page-break-after: always;
            box-sizing: border-box;
            background: #fff;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .label:last-child {
            page-break-after: auto;
        }
        .brand-header {
            display: flex;
            align-items: center;
            gap: 2mm;
            padding-bottom: 2mm;
            border-bottom: 1.5px solid #e0e0e0;
        }
        .logo-container {
            width: 15mm;
            height: 15mm;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .company-info {
            flex: 1;
        }
        .company-name {
            font-size: 9pt;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5mm;
        }
        .company-contact {
            font-size: 6pt;
            color: #666;
            line-height: 1.2;
        }
        .main-content {
            flex: 1;
            padding: 2mm 0;
            position: relative;
        }
        .invoice-box {
            position: absolute;
            top: 1mm;
            right: 0;
            background: #f8f9fa;
            padding: 1mm 2mm;
            border-radius: 2mm;
            border: 1px solid #dee2e6;
        }
        .invoice-label {
            font-size: 6pt;
            color: #666;
        }
        .invoice-number {
            font-size: 8pt;
            font-weight: bold;
            color: #333;
        }
        .customer-info {
            margin-top: 6mm;
        }
        .customer-name {
            font-size: 11pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 1mm;
        }
        .customer-phone {
            font-size: 9pt;
            color: #444;
            margin-bottom: 1mm;
        }
        .customer-address {
            font-size: 8pt;
            line-height: 1.3;
            color: #333;
            padding-left: 2mm;
            border-left: 2px solid {{ companyInfo()->color ?? '#007bff' }};
            margin-top: 2mm;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            padding-top: 2mm;
            border-top: 1px dashed #e0e0e0;
        }
        .qr-code {
            width: 12mm;
            height: 12mm;
        }
        .date-info {
            font-size: 6pt;
            color: #666;
            text-align: right;
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
            <div class="brand-header">
                <div class="logo-container">
                    <img src="{{ asset($company->logo ?? 'assets/backend/images/logo.png') }}"
                         alt="{{ $company->title ?? 'Company' }} Logo"
                         class="logo">
                </div>
                <div class="company-info">
                    <div class="company-name">{{ $company->title ?? 'Company Name' }}</div>
                    <div class="company-contact">
                        {{ $company->phone ?? '' }}<br>
                        {{ $company->email ?? '' }}
                    </div>
                </div>
            </div>

            <div class="main-content">
                <div class="invoice-box">
                    <div class="invoice-label">Invoice ID</div>
                    <div class="invoice-number">#{{ $invoiceId }}</div>
                </div>

                <div class="customer-info">
                    <div class="customer-name">
                        {{ $excelData['Name'][0] ?? '' }}
                    </div>
                    <div class="customer-phone">
                        {{ $excelData['Phone'][0] ?? '' }}
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
