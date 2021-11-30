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


        .products_table {
            margin-bottom: 30px;
        }

        .products_table table {
            width: 100%;
            border-collapse: collapse;
        }

        .products_table table tr th {

            /*border: 1px solid #000;*/
        }

        .products_table table tr td {
            /*border: 1px solid #000;*/
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

        }

        #qr-block {
            margin-left: 100px;
            font-size: right;
            display: block;
            width: 100%;
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

        .dashboard-css-custom {
            position: fixed;
            top: 170px;
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
            border: 1px solid #000;
            min-height: 91px;
            min-height: 100px;
        }

        .text-description-area p {
            padding: 6px 15px 0px 22px;
            font-style: italic;
        }

        #descriptionarea-table {
            width: 100%;
            border: 0px solid #000;
            border-bottom-width: 1px;
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
            font-style: italic;
            line-height: 14px;
            font-weight: 300;
            font-size: 13px;
        }
    </style>
</head>

<body>


<div class="main">


    <div class="header" style="display: flex; margin-bottom: 20px;">

        <img id="logo" src="{{ asset('uploads/lab/'.$report->lab->logo) }}">
        <div id="qr-block" style="margin-left: 100px;">
            {!! QrCode::generate(url('test-result-using-qr-code/'.$report->id.'/'.uniqid().time().'/'.md5($report->id)) ) !!}
        </div>

    </div>

    {{--    {{ dd($report) }}--}}

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
    <h2 style="text-align: center; text-decoration: underline; padding: 0px; margin: 5px;">Molecular Biology</h2>
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
            <p>**Specimen type: Nasopharyngeal Swab on Viral Transport Media</p>
            <p>**Test Methodology:</p>
            <p>
                In vitro diagnostic assay intended for Real-timePCR based detection of new SARS-CoV-2 RNA virus for
                confirmation of COVID-19 disease in
                patients with suspect viral infection.
                It is a real time PCR based technique based upon simultaneous examination of ORF1ab/RDrP and N-genes.
                The test is performed on real-time PCR detection system and NX-Viral RNA extraction kit to provide
                high-yield and quality RNA from clinical
                samples.
            </p>
            <p>
                **Results Interpretation:
            </p>
            <p>
                -Not Detected (Negative) : Not detected indicates that SARS-CoV-2 RNA is either not present in the
                specimen
                or is present at a concentration
                below the assay's lower limit of detection. This result may be influenced by the stage of the infection
                and
                the quality of the specimen collected
                for testing. Repeat test if deemed necessary after 72 hours
                -Detected (Positive) : Detected indicates that SARS-CoV-2 RNA is present in this specimen. Results
                should be
                interpreted in the context of all
                available laboratory and clinical findings.
            </p>
            <p>
                -Presumptive positive : Presumptive positive indicates that only one of multiple genes is detected. Low
                viral load possible. Please send a repeat
                sample after 72- 96 hours and correlate clinically.

            </p>

            <p>
                **Limitations:
            </p>
            <ol>
                <li>As all diagnostic tests, a definitive clinical diagnosis should not be based on the result of a
                    single
                    test
                    but should only be made after all clinical
                    and laboratory findings have been evaluated. Collection of multiple specimens from the same patient
                    may
                    be
                    necessary to detect the virus
                </li>
                <li>A false negative result may occur if a specimen is improperly collected, transported or handled.
                    False
                    negative results may also occur if
                    amplification inhibitors are present in the specimen or if inadequate numbers of organisms are
                    present
                    in the
                    specimen.
                </li>
                <li>If the virus mutates in the rRT-PCR target region, 2019-nCoV may not be detected or may be
                    detectedless
                    predictably. Inhibitors or other types
                    of interference may produce a false negative result.
                </li>
                <li>This test cannot rule out diseases caused by other bacterial or viral pathogens.</li>
            </ol>

            <p> **Disclaimer: This assay has been validated and its performance characteristics have been determined by
                Eurofins
                Biomnis Middle East ;
                Molecular Biology Department</p>
            <p> **REFERENCES:</p>
            <ol>
                <li>Clinical Laboratory Standards Institute (CLSI), "Collection, Transport, Preparation and Storage of
                    Specimens
                    for Molecular Methods: Proposed
                    Guideline," MM13-A
                </li>
                <li>Interim Laboratory Biosafety Guidelines for Handling and Processing Specimens Associated with
                    Coronavirus
                    Disease 2019 (COVID-19).
                    https://www.cdc.gov/coronavirus/2019-ncov/lab/lab biosafety-guidelines.html
                </li>
            </ol>
        </div>
    </div>
    <p style="text-align: center; font-weight: 700; font-style: italic;">End of Report</p>

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
                <img src="{{ asset('uploads/lab/'.$report->lab_director_signature) }}"
                     style="width: 100px; height: 50px;margin-top: 15px;" alt="">

                <br>
                Approved By:
                {{ $report->lab->lab_director }}
                <br>
                Lab Director/Clinical Pathologist
                <br>
                {{ $report->lab->director_contact }}
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

    <p style="margin-top: 20px ;font-weight: 700; text-align: center;">
        Tel: {{ $report->lab->phone }}, Fax: {{ $report->lab->fax }}, P.O Box :212821,
        Addess: {{ $report->lab->address }}

    </p>
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
