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
            border-bottom: none;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2mm;
            padding-bottom: 1mm;
            border-bottom: 1px solid #000;
            font-size: 15pt;
            font-weight: bold;
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
            font-size: 9pt;
            margin-bottom: 1mm;
        }
        .customer-name {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 1mm;
            text-transform: uppercase;
        }
        .customer-phone {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 1mm;
        }
        .customer-address {
            font-size: 10pt;
            line-height: 1.1;
            font-weight: bold;
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
        .from-address {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 1mm;
        }
        .word-wrap {
            word-wrap: break-word;
        }
        .line-height{
            line-height: 1.4 !important;
        }
        .underline{
            text-decoration: underline;
            text-decoration-thickness: 2px;
        }
        .to-section {
            width: 47%;
            word-break: break-word;
            padding: 0 1mm;
            font-size: {{ $styles['fontSize'] ?? '9' }}pt;
            font-weight: {{ $styles['fontWeight'] ?? 'bold' }};
            line-height: {{ $styles['lineHeight'] ?? '1.1' }};
            overflow: {{ $styles['textOverflow'] ?? 'visible' }};
        }
    </style>
</head>
<body>
    @foreach($groupedData as $data)
        @php
            $excelData = $data['excelData'];
            $invoiceId = $excelData['Invoice ID'] ?? '';
            $company = companyInfo();
        @endphp
        <div class="label">
            <div class="invoice-number">#{{ $invoiceId }}</div>
            
            <div class="logo-container">
                {{$company->title}}
            </div>

            <div class="shipping-details">
                <div class="from-section">
                    <div class="section-title underline">From:</div>
                    <div class="from-address word-wrap line-height">
                    {{ $company->title ?? '' }}<br>
                    {{ $company->address ?? '' }}
                    </div>
                </div>
                <div class="to-section">
                    <div class="section-title underline">To:</div>

                    {{-- class="customer-name word-wrap line-height" --}}
                    <div>
                        {{ $excelData['Name'] ?? '' }},
                    </div>

                    {{-- class="customer-phone word-wrap line-height" --}}
                    <div >
                        {{ $excelData['Phone'] ?? '' }},
                    </div>

                    {{-- class="customer-address word-wrap line-height" --}}
                    <div>
                        {{ $excelData['Address'] ?? '' }}
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
