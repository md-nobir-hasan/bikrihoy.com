<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipping Label</title>
    <style>
        @page {
            size: 50mm 70mm;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            width: 50mm;
            height: 70mm;
            font-family: Arial, sans-serif;
        }
        .label {
            position: relative;
            width: 100%;
            height: 100%;
            /* padding: 1mm; */
            box-sizing: border-box;
            /* border: 1px solid #000; */
            /* border-bottom: none;
            padding-top: 0px; */
        }
        .logo-container {
            text-align: center;
            margin-bottom: 1mm;
            border-bottom: 1px solid #000;
            font-size: 15pt;
            font-weight: bold;
        }
        .logo-container img{
            height: 45px;
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
            word-break: break-word;
            padding: 0 1mm;
            border-bottom: 1px solid #000;
            padding-bottom: 1mm;
            padding-left: 1mm;
            min-height: 33mm;
            margin-top: 2mm;
            font-size: {{ $styles['fontSize'] ?? '9' }}pt;
            font-weight: {{ $styles['fontWeight'] ?? 'bold' }};
            line-height: {{ $styles['lineHeight'] ?? '1.4' }};
            overflow: {{ $styles['textOverflow'] ?? 'visible' }};
        }

        .qr-section{
            display: flex;
            flex-direction: row;
            /* gap: 10px; */
            align-items: space-between;
            font-size: 10pt;
            padding-top: 2px;
            padding-left: 1mm;
            margin-top: 2mm;
        }

        .qr-section img{
            height: 55px;
        }

        .company-info{
            display: flex;
            flex-direction: column;
            align-items: space-between;
            font-weight: bold;
            font-size: 8pt;
            margin-left: 1mm;
            line-height: 1.4;
        }
        .sub-text{
            font-size: 6pt;
            font-weight: normal;
            line-height: 1.5;
            margin-left: 2px;
            padding-left: 3px;
            border-left: 1px solid #000;
        }
        .font-weight-bold{
            font-weight: bold;
        }
        .mt-1mm{
            margin-top: 1mm;
        }
        .page-number{
            border: 1px solid;
            border-radius: 100%;
            padding: 1px;
        }
        .m-auto{
            margin: auto;
        }
        .mb-2mm{
            margin-bottom: 2mm;
        }
    </style>
</head>
<body>
    @foreach($groupedData as $data)
        @php
            $excelData = $data['excelData'];
            $invoiceId = $excelData['Invoice'] ?? ($excelData['Invoice ID'] ?? '');
            $company = $site_info;
            $companyContact = $site_contact_info;
        @endphp
        <div class="label">
            {{-- <div class="invoice-number">#{{ $invoiceId }}</div> --}}

            <div class="logo-container">
                <img src="{{ asset('images/default/label-print-logo.jpeg') }}" alt="CASIO" class="logo-img">
            </div>

            {{-- <div class="shipping-details"> --}}
                <div class="to-section">
                    <div style="margin-bottom: 2mm;">
                        <span class="font-weight-bold">Name</span> : {{ $excelData['Name'] ?? '' }}
                    </div>
                    <div style="margin-bottom: 2mm;">
                        <span class="font-weight-bold">Phone</span> : {{ $excelData['Phone'] ?? '' }}
                    </div>
                    <div style="margin-bottom: 2mm;">
                        <span class="font-weight-bold">Address</span> : {{ $excelData['Address'] ?? '' }}
                    </div>
                    <div class="mb-2mm">
                        <span class="font-weight-bold">Amount</span> : {{ $excelData['Amount'] ?? '' }} Tk
                    </div>
                </div>
            {{-- </div> --}}

            <div class="qr-section">
                <img src="{{ asset('images/default/qr.jpeg') }}" class="qr-code">
                <div class="company-info">
                    <div class="company-name">Tech-Soi</div>
                    <div class="company-address">Bikrihoy.Com</div>
                    <div class="company-phone">{{$companyContact->phone}}</div>
                    <div class="m-auto">
                       <span class="page-number">{{ $excelData['SerialNumber'] ?? $loop->iteration }}</span>
                    </div>
                </div>
                <div class="sub-text msg">
                    Allah Always
                    <br>
                    Be With Us
                    <br>
                    Be Positive
                    <br>
                    Never Give Up
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
