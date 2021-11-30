<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Print File- {{  str_pad($report->id,7,"0",STR_PAD_LEFT) }}</title>
    <link rel="shortcut icon" href="https://fashionoptics.store/wp-content/themes/fashion/assets/images/favicon.png"/>
    <style type="text/css">

        body {
            background: #ccc;
            font-size: 14px;
            font-family: Arial;
        }

        .main {
            width: 900px;
            min-height: 1000px;
            padding: 35px 40px;
            background: #fff;
            margin: 50px auto 20px;
        }


        .header h1 {
            margin: 0px;
        }

        .header h3 {
            font-size: 16px;
        }

        .address h4 {
            text-align: center;
            margin: 0px;
            padding: 4px;
        }


        .page_title h2 {
            text-align: center;
        }


        .products_table table {
            width: 100%;
            border-collapse: collapse;
        }

        .products_table table tr th {
        }

        .products_table table tr td {
            text-align: center;

        }

        td.border-less {
            border: none !important;
        }

        .calculation {
            width: 100%;
            overflow: hidden;
        }

        .command_section span input {

            padding: 5px;
            width: 50px;
            height: 30px;
            display: inline-block;

        }

        table.bottom tr td {
            /*border: 1px solid #000;*/
        }

        .table td, .table th {
            padding: 5px;
            vertical-align: top;
            /*border: 1px solid #000;*/
        }

        #barcode-div img {
            width: 200px;
            height: 50px;
        }

        #logo {
            width: 140px;
            height: 100%;
        }

        #qr-block {
            font-size: 14px;
            display: block;
            width: 35%;
            text-align: left;
            float: left;
        }
        #barcode-block{
            display: block;
            width: 35%;
            float: left;
            margin: 0 auto;
        }

        #qr-block img {
        }

        #qr-block svg {
            float: right;
        }


        .print-css-custom {
            position: fixed;
            top: 130px;
            right: 0px;
            height: 30px;
            width: 80px;
            z-index: 1004;
            text-align: center;
            background-color: #CD2128;
            cursor: pointer;
            padding: 5px 10px;
        }


        .td-text-bold {
            font-weight: 700;
        }

        .text-description-area {
            min-height: 91px;
            min-height: 100px;
        }

        .text-description-area p {
            padding: 6px 15px 0px 22px;

        }

        #descriptionarea-table {
            width: 100%;
            border: 0px solid #000;
            border-collapse: collapse;
        }

        #descriptionarea-table tr {

        }

        #descriptionarea-table td {

            padding: 10px;
            text-align: center;
        }

        #description-content ol,
        #description-content ul,
        #description-content p {
            line-height: 14px;
            font-weight: 300;
            font-size: 13px;
            margin: 2px;
        }

        .client-block {
        }

        .client-block-left {
            width: 45%;
            float: left;
        }

        .client-block-right {
            width: 45%;
            float: right;
        }
    </style>
</head>

<body>


<div class="main">


    <div class="header" style="display: flex; margin-bottom: 20px;">

        <div id="qr-block">
            <h2 class="text-align:left;">DIAGNOSTIC REPORT</h2>
        </div>

        <div id="barcode-block">
            <?php
            echo '<img style="width: 250px; height: 45px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($report->id, 'C39+',3,33) . '" alt="barcode"   />';

            ?>
        </div>

        <div id="logo-block">
            <img id="logo" src="{{ asset('uploads/lab/'.$report->lab->logo) }}">
        </div>

    </div>

    <div class="client-block">
        <div class="client-block-left">
            <p><strong>CLIENT CODE</strong>&nbsp; 2110 </p>
            <p><strong>CLIENT NAME </strong> &nbsp;&nbsp; AVANEE HEALTH CARE -OTHERS</p>
        </div>
        <div class="client-block-right">

            SRL DIAGNOSTICS FZ-LL &C, DUBAI <br>
            AL RAZI, BLD NO., UNIT 1018 & 1019, BLOCK E, DUBAI <br>
            Tel 04 4483100
        </div>
    </div>

    <div class="calculation">


        <table class="bottom table" style="width: 100%;">
            <tbody>
            <tr>
                <td width="20%" class="td-text-bold">Name</td>
                <td width="40%">: {{ $report->patient_name }}</td>
                <td class="td-text-bold">Lab ID</td>
                <td width="20%">: {{ $report->lab_id }}</td>

            </tr>
            <tr>
                <td width="20%" class="td-text-bold">MRN</td>
                <td width="40%">: {{ $report->mrn }}</td>
                <td class="td-text-bold">Reference No</td>
                <td width="20%">: {{ $report->reference }}</td>

            </tr>

            <tr>
                <td width="20%" class="td-text-bold">Sample No</td>
                <td width="40%">: {{ $report->sample }}</td>
                <td class="td-text-bold">Age/Y</td>
                <td width="20%">: {{ date('Y',strtotime($report->date_of_birth)) }}</td>
            </tr>

            <tr>
                <td width="20%" class="td-text-bold">ID</td>
                <td width="40%">: {{ $report->patient_id }}</td>
                <td class="td-text-bold">Gender</td>
                <td width="20%">: {{ $report->gender }}</td>
            </tr>

            <tr>
                <td width="20%" class="td-text-bold">Registration Date</td>
                <td width="40%">: {{ $report->registration_date }}</td>
                <td class="td-text-bold">Collection Date</td>
                <td width="20%">: {{ $report->collection_date }}</td>
            </tr>

            <tr>
                <td width="20%" class="td-text-bold">Reporting Date</td>
                <td width="40%">: {{ $report->reporting_date }}</td>

            </tr>
            <tr>
                <td width="20%" class="td-text-bold">Location</td>
                <td width="40%">: {{ $report->location }}</td>

            </tr>
            <tr>
                <td class="td-text-bold">Ref. By Dr.</td>
                <td width="20%">: @if(!empty($report->ref_docor)) {{ $report->ref_doctor }} @else - @endif</td>
            </tr>
            </tbody>
        </table>

        <table>

        </table>
    </div>
    <hr>
    <h2 style=" margin: 5px;
    border: 3px solid #ddd;
    border-radius: 25px;
    padding: 6px;
    text-decoration: underline;">Molecular Biology</h2>
    <div class="text-description-area">
        <table id="descriptionarea-table" class="text-center">
            <tr>
                <td><strong>Test</strong></td>
                <td><strong>Result</strong></td>
                <td><strong>Reference Range</strong></td>
                <td><strong>Methodology</strong></td>
            </tr>


        </table>
        <table style="width: 100%">
            <tr>
                <td style="">{{ $report->test_name }}</td>
                <td>{{ $report->detection_status }}</td>
                <td>{{ $report->reference_range }}</td>
                <td style="text-align: center;"> {{ $report->methodology }}</td>
            </tr>
        </table>
        <div id="description-content">
            <p>Reference Range: Not Detected</p>
            <p> Methodology: RT PCR</p>
            <p>
                This test is a qualitative PCR test. Not detected indicates that SARS-CoV-2 RNA is either not present in
                the
                specimen or is present at a concentration below the assays lower limit of detection. This result may be
                influenced by the stage of the infection
                and the quality of the specimen collected for testing. Repeat test if deemed necessary after 72 hours.
            </p>
            <p>Remarks:</p>
            <p>Real Time PCR COVID-19 Detection Kit is a real time PCR based in-vitro diagnostic medical device that is
                designed to detect the infection of Novel Corona Virus -SARS COV-2 (COVID19) through simultaneous
                examination of the ORF1ab and N-gene using the nucleic acid extracted fromoropharyngeal or
                nasopharyngeal
                smears.</p>
            <p>Limit of Detection (Analytical Sensitivity) is LOD 200 copies / mL</p>
            <p> Kindly note all detected cases are to be immediately notified to the local regulatory health authorities
                &
                requires clinical correlation and further evaluation as indicated. Interpretation of results should be
                correlated with patient history and clinical presentation.</p>
            <p>
                Note: Reporting of test should be in-line with DHA rules and regulations for COVID-19 testing. Ref:-
                NCEMA
                guidelines for COVID 19 Reporting
            </p>
        </div>
    </div>
    <p style="text-align: center;
    font-weight: 700;
    color: darkgreen;
    margin-top: 43x !important;
    margin-top: 92px;">Final Report</p>

    <table style="width: 100%;">

        <tr>
            <td style="font-weight: 700;">
                <img src="{{ asset('uploads/lab/'.$report->lab_manager_signature) }}"
                     style="width: 100px; height: 50px;margin-top: 15px;" alt="">


                <br>
                Lab Manager
                <br>
                {{ $report->lab->manager_contact }}
            </td>
            <td style="text-align: right; font-weight: 700;">
                {!! QrCode::generate(url('test-result-using-qr-code/'.$report->id.'/'.uniqid().time().'/'.md5($report->id)) ) !!}
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;">
        <tr style="margin-top: 10px;">
            <td><strong>Sample Type : Nasopharyngeal</strong></td>
        </tr>
        <tr style="margin-top: 10px;">
            <td><strong>Printed By: Automatic Printing</strong></td>
            <td><strong>Printed Date: {{ date('d/m/Y h:i') }}</strong></td>
        </tr>
    </table>

</div>

<script>

    function printFunction() {

        const printButton = document.getElementById("printbutton");

        const backButton = document.getElementById('backbutton');

        backButton.style.visibility = 'hidden';

        printButton.style.visibility = 'hidden';

        window.print();

        printButton.style.visibility = 'visible';

        backButton.style.visibility = 'visible';

    }

    function goBack() {
        window.history.back();
    }


    // change
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#print-action').click(function () {
            $(this).css('display', 'none');
            $('#print-dashboard').css('display', 'none');
            window.print();

        });

        window.onafterprint = function (e) {
            $(window).off('mousemove', window.onafterprint);
            $('#print-action').css('display', 'block');
            $('#print-dashboard').css('display', 'block');
        };

        setTimeout(function () {
            $(window).one('mousemove', window.onafterprint);
        }, 1);
    });
</script>

<!--<a  href="#"  onclick="goBack()" class="btn btn-success">Back</a>-->
<div class="print-css-custom" id="print-action" style="margin-bottom: 10px;">
    <div href="#" style="color: #fff;" onclick="printAction()">Print</div>
</div>
<!--<a  href="#"  onclick="goBack()" class="btn btn-success">Back</a>-->


</body>


</html>
