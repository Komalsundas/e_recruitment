@extends('layouts.app2')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- DataTables js and css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    {{-- 
    <style>
        .custom-card {
            border: 1px solid #584a4a;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            /* Increased shadow size */
            transition: 0.3s;
            padding: 20px;
            width: 8000px;
        }

        .custom-card:hover {
            box-shadow: 0 12px 20px 0 rgba(0, 0, 0, 0.2);
            /* Increased shadow size on hover */
        }

        .form-control {
            border: 1px solid #a3a3a3;
            /* Border for the input fields */
            padding: 10px;
            border-radius: 5px;
            /* Rounded corners for the input fields */
            transition: 0.3s;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Add box shadow for a 3D effect */
        }
    </style> --}}
    {{-- <style>
        .icon-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 5px 5px;
            border-radius: 5px;
            font-size: 15px;
        }

        .icon-button:hover {
            background-color: #08b116;
        }

        .icon {
            margin-right: 2px;
            font-size: 15px;
        }
    </style> --}}

    <style>
        select {
            height: auto;
            overflow: auto;
        }
    </style>


    <script type="text/javascript">
        $(function() {
            var years = $(".completion_year");
            var currentYear = (new Date()).getFullYear();
            for (var i = currentYear; i >= 2000; i--) {
                var option = $("<option />");
                option.html(i);
                option.val(i);
                years.append(option);
            }
        });
    </script>

    <!--Body:Content-->
    <div class="div1  d-flex align-items-start">
        <ul class="nav nav-tabs mb-3 mr-4 py-4 px-3 d-flex flex-column" id="myTab0" role="tablist"
            style="background-color: rgba(0,0,0,0.05); border-radius: 4px; white-space: nowrap;
        position: sticky; top: 110px; z-index: 1;">
            <li class="nav-item active mb-2" role="presentation">
                <button class="nav-link text-left w-100" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                    type="button" role="tab" aria-controls="home" aria-selected="true"
                    style="font-family: Georgia, serif;">
                    Applicant <br>Information
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-left w-100 " id="education-tab" data-bs-toggle="tab"
                    data-bs-target="#education" type="button" role="tab" aria-controls="education"
                    aria-selected="false" style="font-family: Georgia, serif;">
                    Eduaction
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-left w-100" id="employement-tab" data-bs-toggle="tab"
                    data-bs-target="#employement" type="button" role="tab" aria-controls="employement"
                    aria-selected="false" style="font-family: Georgia, serif;">
                    Previous <br> Employement
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-left w-100" id="training-tab" data-bs-toggle="tab" data-bs-target="#training"
                    type="button" role="tab" aria-controls="training" aria-selected="false"
                    style="font-family: Georgia, serif;">
                    Experience/ <br>Training
                </button>
            </li>
        </ul>
        <br>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" id="job-form">
            @csrf
            <div class="tab-content px-4 py-3" id="myTabContent0"
                style="background-color: rgba(0,0,0,0.05); border-radius: 4px;">

                <!-- Applicant Information -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <fieldset class="border p-2"
                        style="max-width: 9020px; border-width: 2px !important; border-color: rgb(137, 133, 133) !important;">
                        <legend class="float-none w-auto p-2"
                            style="font-weight: bold; font-size: 16px; font-family: 'Georgia, serif';">PERSONAL DETAILS
                        </legend>
                        <div class="row g-1">
                            <input type="hidden" class="form-control form-control-sm" id="vacancy_id" name="vacancy_id"
                                value="{{ $vacancy_id }}">
                            <div class="col-md-3">
                                <label for="fullName" class="form-label fw-bold small">Full Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="fullName" name="name"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="cid" class="form-label fw-bold small">CID<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="cid" name="cid"
                                    required maxlength="11">
                                <small id="cidHelpBlock" class="form-text text-danger" style="display: none;">CID should
                                    be 11 digits.</small>

                                @error('cid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <script>
                                document.getElementById('cid').addEventListener('input', function() {
                                    var cidInput = this.value;
                                    var cidHelpBlock = document.getElementById('cidHelpBlock');
                                    var cidField = document.getElementById('cid');
                                    var proceedButton = document.getElementById('proceedButton');

                                    if (cidInput.length < 11) {
                                        cidHelpBlock.style.display = 'block';
                                        proceedButton.disabled = true;
                                    } else {
                                        cidHelpBlock.style.display = 'none';
                                        // Make AJAX request to check for duplicate CID
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '/checkcid');
                                        xhr.setRequestHeader('Content-Type', 'application/json');
                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                if (response.status === 'duplicate') {
                                                    // Handle duplicate CID case
                                                    cidField.setCustomValidity(
                                                        'This CID is already associated with an existing applicant.');
                                                    proceedButton.disabled = true;
                                                } else {
                                                    // Handle unique CID case
                                                    cidField.setCustomValidity('');
                                                    proceedButton.disabled = false;
                                                }
                                            } else {
                                                // Handle error case
                                                console.error('Request failed. Status:', xhr.status);
                                            }
                                        };
                                        xhr.send(JSON.stringify({
                                            cid: cidInput
                                        }));
                                    }
                                });
                            </script>



                            <div class="col-md-3">
                                <label for="dob" class="form-label fw-bold small">DOB <span
                                        style="color: red;">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-sm" id="dob"
                                        name="dob" required>
                                </div>
                            </div>
                            <script>
                                $(function() {
                                    $("#dob").datepicker({
                                        changeMonth: true,
                                        changeYear: true,
                                        yearRange: "c-100:c", // Show 100 years before and after the current year
                                        dateFormat: "yy-mm-dd" // Set date format
                                    });
                                });
                            </script>
                            <div class="col-md-3">
                                <label for="gender" class="form-label fw-bold small">Gender<span
                                        style="color: red;">*</span></label>
                                <select class="form-select form-select-sm" id="gender" name="gender" required>
                                    <option selected>Select One</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="contactNumber" class="form-label fw-bold small">Contact No(B-no only )<span
                                        style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text" style="font-size: x-small;">975</div>
                                    <input type="text" class="form-control form-control-sm" id="contactNumber"
                                        name="contact" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="acontact" class="form-label fw-bold small">Alternate Contact Number <span
                                        style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text" style="font-size: x-small;">975</div>
                                    <input type="text" class="form-control form-control-sm" id="acontact"
                                        name="acontact" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label fw-bold small">Email<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="email" name="email"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="passport" class="form-label fw-bold small">Passport size Photo<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="coverLetter"
                                    accept="image/png, image/jpeg" name="passport_photo" required>
                            </div>
                        </div><br>
                    </fieldset>
                    <br>

                    <fieldset class="border p-2"
                        style="max-width: 9020px; border-width: 2px !important; border-color: rgb(137, 133, 133)!important;">
                        <legend class="float-none w-auto p-2"
                            style="font-weight: bold; font-size: 16px; font-family: 'Georgia, serif';">ADDRESS
                        </legend>
                        <div class="row g-1">

                            <div class="col-md-3">
                                <label for="dzongkhag" class="form-label fw-bold small">Dzongkhag</label>
                                <input type="text" class="form-control form-control-sm" id="dzongkhag"
                                    name="dzongkhag" placeholder="Enter Dzongkhag" style="height: 40px;">
                            </div>
                            <div class="col-md-3">
                                <label for="gewog" class="form-label fw-bold small">Gewog</label>
                                <input type="text" class="form-control form-control-sm" id="gewog" name="gewog"
                                    placeholder="Enter Gewog" style="height: 40px;">
                            </div>
                            <div class="col-md-3">
                                <label for="village" class="form-label fw-bold small">Village</label>
                                <input type="text" class="form-control form-control-sm" id="village" name="village"
                                    placeholder="Enter Village" style="height: 40px;">
                            </div>
                            <div class="col-md-3">
                                <label for="present_address" class="form-label fw-bold small">Present Address</label>
                                <textarea class="form-control form-control-sm" id="present_address" name="present_address" style="height: 40px;"></textarea>
                            </div>
                        </div><br>
                    </fieldset>
                    <br>

                    <!-- Your other fieldset for document attachment goes here -->
                    <br>
                    <fieldset class="border p-2"
                        style="max-width: 9020px; border-width: 2px !important; border-color: rgb(137, 133, 133) !important;">
                        <legend class="float-none w-auto p-2"
                            style="font-weight: bold; font-size: 16px; font-family: 'Georgia, serif';">DOCUMENTS TO BE
                            ATTACHED</legend>
                        <p style="font-size: 15px; font-family: 'Georgia, serif; color: #555; margin-left: 20px;">
                            &#8226; Only PDF files are allowed. <br>
                            &#8226;Maximum file size limit: 500 KB.
                        </p>
                        <div class="row g-1">
                            <div class="col-md-3">
                                <label for="coverletter" class="form-label fw-bold small">Cover Letter<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="coverletter"
                                    name="coverletter" accept=".pdf" required>
                                <small class="text-danger" id="coverLetterError" style="display: none;">File size exceeds
                                    500 KB.</small>
                            </div>
                            <div class="col-md-3">
                                <label for="cidAttachment" class="form-label fw-bold small">CID <span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="cidAttachment"
                                    name="cidcopy" accept=".pdf" required>
                                <small class="text-danger" id="cidAttachmentError" style="display: none;">File size
                                    exceeds 500 KB.</small>
                            </div>
                            <div class="col-md-3">
                                <label for="cvAttachment" class="form-label fw-bold small">CV<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="cvAttachment"
                                    name="cv" accept=".pdf" required>
                                <small class="text-danger" id="cvAttachmentError" style="display: none;">File size
                                    exceeds 500 KB.</small>
                            </div>
                            <div class="col-md-3">
                                <label for="medicalCertificate" class="form-label fw-bold small">Medical Certificate<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="medicalCertificate"
                                    name="mc" accept=".pdf" required>
                                <small class="text-danger" id="medicalCertificateError" style="display: none;">File size
                                    exceeds 500 KB.</small>
                            </div>
                            <div class="col-md-3">
                                <label for="noc" class="form-label fw-bold small">Security Clearance <span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control form-control-sm" id="noc" name="noc"
                                    required accept=".pdf">
                                <small class="text-danger" id="nocError" style="display: none;">File size exceeds 500
                                    KB.</small>
                            </div>
                        </div><br>
                        <br>
                        <!-- Add a "Proceed" button here -->
                        <div style="text-align: right;">
                            <button type="button" class="btn btn-success btn-sm" id="proceedButton"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #4CAF50; color: white;">Next</button>
                        </div>
                </div>

                <!-- Education -->
                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                    <fieldset class="border p-2"
                        style="max-width: 9020px; border-width: 2px !important; border-color: rgb(137, 133, 133) !important;">
                        <legend class="float-none w-auto p-2"
                            style="font-weight: bold; font-size: 16px; font-family: 'Georgia, serif';">EDUCATION DETAILS
                        </legend>

                        <!-- for only class X  -->
                        @if (in_array($minQualification, [1, 2, 3, 4, 5, 6]))
                            <div id="classXFields">
                                <!-- Your Class X form fields here -->
                                <p>Class X</p>
                                <div class="form-row align-items-center">
                                    <div class="col-5">
                                        <label for="schoolName" class="form-label fw-bold small">School Name</label>
                                        <input type="text" class="form-control mb-2" id="schoolName"
                                            placeholder="Enter school name" name="x_institute">
                                    </div>
                                    <div class="col-3">
                                        <label for="x_year" class="form-label fw-bold small">Completion year</label>
                                        <input type="text" class="form-control mb-2" id="x_year"
                                            placeholder="Enter Completion year" name="x_year">
                                    </div>
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="x_marksheet" class="form-label fw-bold small align-self-start">Class X
                                            marksheet<span style="color: red;">*</span></label>
                                        <input type="file" class="form-control form-control-sm align-self-end"
                                            id="x_marksheet" placeholder="Select Marksheet" name="x_marksheet" required>
                                        <small class="text-danger" id="x_marksheetError" style="display: none;">File size
                                            exceeds
                                            500 KB.</small>
                                    </div>
                                </div>
                                <p style="font-size: 15px; font-family: 'Georgia, serif; colo: #555; margin-left: 20px;">
                                    &#8226; Percentage is calculated based on English + best 4 subjects.<br>
                                    &#8226; Please input the subject mark as 0 if you have not taken the subject.<br>
                                    &#8226; In some of the subjects put overall marks in one of the subjects and enter '0'
                                    for
                                    the remaining subject.

                                </p>
                                <div class="row g-2">
                                    <div class="col-md-1">
                                        <label for="subject" class="form-label fw-bold small">Subject</label>
                                        <label for="subject" class="form-label fw-bold small">Marks</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="eng" class="form-label fw-bold small">English</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="eng"
                                            name="x_eng">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="dzo" class="form-label fw-bold small">Dzongkha</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="dzo"
                                            name="x_dzo">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="mat" class="form-label fw-bold small">Math</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="mat"
                                            name="x_mat">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="phy" class="form-label fw-bold small">Phy/Che/Bio </label>
                                        <input type="text" class="form-control form-control-sm xmark" id="phy"
                                            name="x_phy">
                                    </div>

                                    <div class="col-md-1">
                                        <label for="eco" class="form-label fw-bold small">Economics</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="eco"
                                            name="x_eco">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="his" class="form-label fw-bold small">His/Geo</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="his"
                                            name="x_his">
                                    </div>

                                    <div class="col-md-1 text-center">
                                        <label for="it" class="form-label fw-bold small">IT</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="it"
                                            name="x_it">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <label for="ent" class="form-label fw-bold small">EVS</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="ent"
                                            name="x_ent">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <label for="agfs" class="form-label fw-bold small">AGFS</label>
                                        <input type="text" class="form-control form-control-sm xmark" id="agfs"
                                            name="x_agfs">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="percentage" class="form-label fw-bold small">Percentage</label>
                                        <input type="text" class="form-control form-control-sm xmark"
                                            id="x_percentage" readonly name="x_percentage">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endif

                        <!-- Class X and XII -->

                        @if (in_array($minQualification, [1, 2, 3, 4, 5]))
                            <div id="classXIIFields">
                                <div id="classXIIFields">

                                    <p>CLASS XII</p>
                                    <div class="form-row align-items-center">
                                        <div class="col-5">
                                            <label for="schoolName" class="form-label fw-bold small">School Name</label>
                                            <input type="text" class="form-control mb-2" id="schoolName"
                                                placeholder="Enter school name" name="xii_institute">
                                        </div>
                                        <div class="col-3">
                                            <label for="xii_year" class="form-label fw-bold small">Completion year</label>
                                            <input type="text" class="form-control mb-2" id="xii_year"
                                                placeholder="Enter Completion year" name="xii_year">
                                        </div>
                                        <div class="col-md-4 d-flex flex-column">
                                            <label for="xii_marksheet"
                                                class="form-label fw-bold small align-self-start">Class
                                                XII
                                                marksheet<span style="color: red;">*</span></label>
                                            <input type="file" class="form-control form-control-sm align-self-end"
                                                id="xii_marksheet" placeholder="Select Marksheet" name="xii_marksheet"
                                                required>
                                            <small class="text-danger" id="xii_marksheetError"
                                                style="display: none;">File size exceeds
                                                500 KB.</small>
                                        </div>


                                    </div>
                                    <p
                                        style="font-size: 15px; font-family: 'Georgia, serif; color: #555; margin-left: 20px;">
                                        &#8226; Percentage is calculated based on English + best 3 subjects.<br>
                                        &#8226; Please input the subject mark as 0 if you have not taken the subject.
                                    </p>
                                    <br>
                                    <legend class="float-none w-auto p-1"
                                        style="font-weight: bold; font-size: 13px; font-family: 'Georgia, serif;">STREAM
                                    </legend>
                                    <div class="d-flex" style="gap: 0;">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input stream" type="radio" name="stream"
                                                id="scienceRadio" value="S" onclick="showField('S')">
                                            <label class="form-check-label" for="scienceRadio">Science</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input stream" type="radio" name="stream"
                                                id="commerceRadio" value="C" onclick="showField('C')">
                                            <label class="form-check-label" for="commerceRadio">Commerce</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input stream" type="radio" name="stream"
                                                id="artsRadio" value="A" onclick="showField('A')">
                                            <label class="form-check-label" for="artsRadio">Arts</label>

                                        </div>

                                    </div>

                                    <!-- Forms for each stream -->
                                    <div class="row g-2">
                                        <div class="col-md-1">
                                            <label for="subject" class="form-label fw-bold small">Subject</label>
                                            <label for="marks" class="form-label fw-bold small">Marks</label>
                                        </div>
                                        <div class="col-md-1" id="eng_div">
                                            <label for="eng" class="form-label fw-bold small ">English</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_eng" name='xii_eng'>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="dzo" class="form-label fw-bold small">Dzongkha</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_dzo" name='xii_dzo'>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="mat" class="form-label fw-bold small">Math</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_mat" name='xii_mat'>
                                        </div>
                                        <div class="col-md-1" id="phy_div">
                                            <label for="phy" class="form-label fw-bold small">Physic</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_phy" name='xii_phy'>
                                        </div>
                                        <div class="col-md-1" id="che_div">
                                            <label for="che" class="form-label fw-bold small">Chemistry</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_che" name='xii_che'>
                                        </div>
                                        <div class="col-md-1" id="bio_div">
                                            <label for="bio" class="form-label fw-bold small">Biology</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_bio" name='xii_bio'>
                                        </div>
                                        <div class="col-md-1 text-center">
                                            <label for="it" class="form-label fw-bold small">IT</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_it" name='xii_it'>
                                        </div>
                                        <div class="col-md-1" id="com_div">
                                            <label for="com" class="form-label fw-bold small">Commerce</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_com" name='xii_com'>
                                        </div>
                                        <div class="col-md-1" id="eco_div">
                                            <label for="eco" class="form-label fw-bold small">Economic</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_eco" name='xii_eco'>
                                        </div>
                                        <div class="col-md-1" id="acc_div">
                                            <label for="acc" class="form-label fw-bold small">Accountancy</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_acc" name='xii_acc'>
                                        </div>
                                        <div class="col-md-1" id="geo_div">
                                            <label for="geo" class="form-label fw-bold small">Geography</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_geo" name='xii_geo'>
                                        </div>
                                        <div class="col-md-1" id="his_div">
                                            <label for="his" class="form-label fw-bold small">History</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_his" name='xii_his'>
                                        </div>
                                        <div class="col-md-1" id="media_div">
                                            <label for="media" class="form-label fw-bold small">Media</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_media" name='xii_media'>
                                        </div>
                                        <div class="col-md-1" id="rigzhung_div">
                                            <label for="rigzhung" class="form-label fw-bold small">Rigzhung</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_rigzhung" name='xii_rigzhung'>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="percentage" class="form-label fw-bold small">Percentage</label>
                                            <input type="text" class="form-control form-control-sm marks"
                                                id="xii_percent" name='xii_percent' readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <script>
                                        function showField(radio_val) {
                                            clearField();
                                            if (radio_val == "C") {
                                                $('#com_div').show();
                                                $('#eco_div').show();
                                                $('#acc_div').show();

                                                $('#phy_div').hide();
                                                $('#che_div').hide();
                                                $('#bio_div').hide();
                                                $('#geo_div').hide();
                                                $('#his_div').hide();
                                                $('#media_div').hide();
                                                $('#rigzhung_div').hide();

                                            } else if (radio_val == "A") {
                                                $('#com_div').hide();
                                                $('#eco_div').show();
                                                $('#acc_div').hide();
                                                $('#phy_div').hide();
                                                $('#che_div').hide();
                                                $('#bio_div').hide();

                                                $('#geo_div').show();
                                                $('#his_div').show();
                                                $('#media_div').show();
                                                $('#rigzhung_div').show();


                                            } else {
                                                $('#com_div').hide();
                                                $('#eco_div').hide();
                                                $('#acc_div').hide();
                                                $('#geo_div').hide();
                                                $('#his_div').hide();
                                                $('#media_div').hide();
                                                $('#rigzhung_div').hide();


                                                $('#phy_div').show();
                                                $('#che_div').show();
                                                $('#bio_div').show();
                                            }

                                            function clearField() {
                                                $('#xii_eng').val('');
                                                $('#xii_dzo').val('');
                                                $('#xii_mat').val('');
                                                $('#xii_phy').val('');
                                                $('#xii_che').val('');
                                                $('#xii_bio').val('');
                                                $('#xii_it').val('');
                                                $('#xii_com').val('');
                                                $('#xii_eco').val('');
                                                $('#xii_acc').val('');
                                                $('#xii_geo').val('');
                                                $('#xii_his').val('');
                                                $('#xii_media').val('');
                                                $('#xii_rigzhung').val('');
                                                $('#xii_percent').val('');
                                            }
                                        }
                                    </script>

                                </div>
                        @endif

                        {{-- for all three qualification --}}
                        @if (in_array($minQualification, [1, 2, 3, 4]))
                            <div id="degreeFields">


                                {{-- For Class Degree --}}
                                <legend class="float-none w-auto p-1"
                                    style="font-weight: bold; font-size: 13px; font-family: 'Georgia, serif;">
                                    DEGREE/DIPLOMA/VTI
                                </legend>
                                <div class="form-row align-items-center">
                                    <div class="col-4">
                                        <label for="university" class="form-label fw-bold small">University/ College
                                            Name</label>
                                        <input type="text" class="form-control mb-2" id="schoolName"
                                            placeholder="Enter university name" name="degree_institute">
                                    </div>
                                    <div class="col-3">
                                        <label for="courseName" class="form-label fw-bold small">Course Name</label>
                                        <input type="text" class="form-control mb-2" id="Please"
                                            placeholder="Enter course name" name="degree_course">
                                    </div>
                                    <div class="col-2">
                                        <label for="degree_year" class="form-label fw-bold small">Completion year</label>
                                        <input type="text" class="form-control mb-2" id="degree_year"
                                            placeholder="Enter Completion year" name="degree_year">
                                    </div>

                                    <div class="col-md-1">
                                        <label for="percentage" class="form-label fw-bold small">Percentage</label>
                                        <input type="text" class="form-control form-control-sm marks"
                                            id="degree_percentage" name='degree_percentage'>
                                    </div>
                                    <div class="col-md-3 d-flex flex-column">
                                        <label for="marksheetAttachment"
                                            class="form-label fw-bold small align-self-start">Degree/Diploma/VTI
                                            Marksheet <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control form-control-sm align-self-end"
                                            id="degree_marksheet" placeholder="Select Marksheet" name="degree_marksheet"
                                            required>
                                        <small class="text-danger" id="degree_marksheetError" style="display: none;">File
                                            size exceeds
                                            500 KB.</small>

                                    </div>
                                </div>
                            </div>
                        @endif
                        <br>

                        <!--check marks for criteria not met. -->
                       
                      
                        @if ($errors->has('criteria'))
                        <div class="alert alert-danger">
                            {{ $errors->first('criteria') }}
                        </div>
                    @endif
                    
                    

                        <script>
                            $(document).ready(function() {
                                // Function to compare marks with criteria and display error messages
                                function compareMarksWithCriteria() {
                                    // Retrieve the marks criteria from the server-side
                                    @if (session('marks_criteria'))
                                        var marksCriteria = @json(session('marks_criteria'));
                                    @endif

                                    // Retrieve applicant's marks from the input fields
                                    var class10Marks = parseFloat($('#x_percentage').val());
                                    var class12Marks = parseFloat($('#xii_percent').val());
                                    var degreeMarks = parseFloat($('#degree_percentage').val());

                                    // Check if each mark meets the criteria and display error messages
                                    if (marksCriteria && class10Marks < marksCriteria.class10) {
                                        $('#x_percentageError').show();
                                    } else {
                                        $('#x_percentageError').hide();
                                    }
                                    if (marksCriteria && class12Marks < marksCriteria.class12) {
                                        $('#xii_percentError').show();
                                    } else {
                                        $('#xii_percentError').hide();
                                    }
                                    if (marksCriteria && degreeMarks < marksCriteria.degree) {
                                        $('#degree_percentageError').show();
                                    } else {
                                        $('#degree_percentageError').hide();
                                    }
                                }

                                // Call the function when the page loads
                                compareMarksWithCriteria();

                                // Bind the function to input change event to dynamically check marks against criteria
                                $('.marks').on('input', function() {
                                    compareMarksWithCriteria();
                                });
                            });
                        </script>
                        <!-- No Qualification Message -->

                        @if (in_array($minQualification, [7, 8]))
                            <div id="noQualificationMessage">
                                The user is not obligated to possess any specific qualifications for this task. Academic
                                credentials are not a prerequisite for user involvement.
                            </div>
                        @endif

                        <div class="col-md-3">
                            <label for="final_score" class="form-label fw-bold small">Final Score</label>
                            <input type="text" class="form-control form-control-sm marks" id="final_score"
                                name="final_score" readonly>
                        </div>
                        <div style="text-align: right;">
                            <button type="button" class="btn btn-secondary" id="backToApplicantInfo"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #7d7d7d; color: white;">Previous</button>

                            <button type="button" class="btn btn-success" id="nextToEmployement"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #4CAF50; color: white;">Next</button>
                        </div>
                    </fieldset>

                </div>
                <!-- JavaScript to check file size -->
                <script>
                    document.getElementById('coverletter').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('coverLetterError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('coverLetterError').style.display = 'none';
                        }
                    });

                    document.getElementById('cidAttachment').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('cidAttachmentError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('cidAttachmentError').style.display = 'none';
                        }
                    });

                    document.getElementById('cvAttachment').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('cvAttachmentError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('cvAttachmentError').style.display = 'none';
                        }
                    });

                    document.getElementById('medicalCertificate').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('medicalCertificateError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('medicalCertificateError').style.display = 'none';
                        }
                    });

                    document.getElementById('x_marksheet').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('x_marksheetError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('x_marksheetError').style.display = 'none';
                        }
                    });

                    document.getElementById('xii_marksheet').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('xii_marksheetError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('xii_marksheetError').style.display = 'none';
                        }
                    });
                    document.getElementById('degree_marksheet').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('degree_marksheetError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('degree_marksheetError').style.display = 'none';
                        }
                    });


                    document.getElementById('noc').addEventListener('change', function(event) {
                        var file = this.files[0];
                        if (file && file.size > 500 * 1024) {
                            document.getElementById('nocError').style.display = 'block';
                            this.value = ''; // Clear the file input
                        } else {
                            document.getElementById('nocError').style.display = 'none';
                        }
                    });
                </script>

                </fieldset>
                <script>
                    // Function to check file size
                    function checkFileSize(inputId) {
                        var fileInput = document.getElementById(inputId);
                        if (fileInput.files.length > 0) {
                            var fileSize = fileInput.files[0].size; // Size in bytes
                            var maxSize = 1024 * 1024; // 1MB in bytes
                            if (fileSize > maxSize) {
                                alert('File size should not exceed 1MB.');
                                fileInput.value = ''; // Clear the file input
                                return false; // Prevent form submission
                            }
                        }
                        return true; // Proceed with form submission
                    }

                    // Event listener for form submission
                    document.getElementById('yourFormId').addEventListener('submit', function(event) {
                        // Check file sizes before form submission
                        var coverLetterValid = checkFileSize('coverLetter');
                        var cidAttachmentValid = checkFileSize('cidAttachment');
                        var cvAttachmentValid = checkFileSize('cvAttachment');
                        var medicalCertificateValid = checkFileSize('medicalCertificate');
                        var nocValid = checkFileSize('noc');
                        var x_marksheetValid = checkFileSize('x_marksheet');
                        var xii_marksheetValid = checkFileSize('xii_marksheet');
                        var degree_marksheetValid = checkFileSize('degree_marksheet');

                        // If any file size exceeds the limit, prevent form submission
                        if (!coverLetterValid || !cidAttachmentValid || !cvAttachmentValid || !medicalCertificateValid || !
                            nocValid || !x_marksheetValid || !xii_marksheetValid || !degree_marksheetValid) {
                            event.preventDefault();
                        }
                    });
                </script>

                <!-- Previous Employment -->
                <div class="tab-pane fade" id="employement" role="tabpanel" aria-labelledby="employement-tab">
                    <div class="container mt-4">
                        <p>Employement History</p>
                        <div class="table-responsive">
                            <table class="table table-bordered experienceTable" id="experienceTable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Company</th>
                                        <th scope="col">Position</th>
                                        <th scope="col" colspan="2" class="text-center">Period</th>
                                        <th scope="col">Place</th>
                                        {{-- <th scope="col">Reason to Change</th> --}}
                                        <th scope="col">Supporting Dcouments(IF ANY)</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input class="form-control" type="text" name="company[]"
                                                placeholder="Company">
                                        </td>
                                        <td><input class="form-control" type="text" name="position[]"
                                                placeholder="Position"></td>
                                        <td><input class="form-control datepicker" type="text" name="from[]"
                                                placeholder="From">
                                        </td>
                                        <td><input class="form-control datepicker" type="text" name="to[]"
                                                placeholder="To">
                                        </td>
                                        <td><input class="form-control" type="text" name="place[]"
                                                placeholder="Place">
                                        </td>
                                        <td><input type="file" class="form-control-file" name="document[]"></td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="text-left">
                            <button class="btn btn-primary btn-sm" id="insertRowExp">
                                <i class="fas fa-plus"></i> <span
                                    style="font-family: 'Georgia', serif; font-weight: bold; font-size: 12px;">Add
                                    More</span>
                            </button>
                        </div>
                        <div class="text-right mt-2">
                            <button type="button" class="btn btn-secondary" id="backToEducation"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #7d7d7d; color: white;">Previous</button>

                            <button type="button" class="btn btn-success" id="nextToTraining"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #4CAF50; color: white;">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Training History -->
                <div class="tab-pane fade" id="training" role="tabpanel" aria-labelledby="training">
                    <div class="container mt-4">
                        <p>Training/Certificates</p>
                        <div class="table-responsive">
                            <table class="table table-bordered trainingTable" id="trainingTable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Training</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Certificates</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input class="form-control" type="text" name="training[]"
                                                placeholder="Training">
                                        </td>
                                        <td><input class="form-control" type="text" name="country[]"
                                                placeholder="Country">
                                        </td>
                                        <td><input class="form-control datepicker" type="text" name="sdate[]"
                                                placeholder="Start Date">
                                        </td>
                                        <td><input class="form-control datepicker" type="text" name="edate[]"
                                                placeholder="End Date">
                                        <td><input type="file" class="form-control-file" name="certificates[]">
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="text-left">
                            <button class="btn btn-primary btn-sm" id="addTraining">
                                <i class="fas fa-plus"></i> <span
                                    style="font-family: 'Georgia', serif; font-weight: bold; font-size: 12px;">Add
                                    More</span>
                            </button>
                        </div>

                        <script>
                            // Function to save checkbox state in localStorage
                            function saveCheckboxState(checkboxId) {
                                const checkbox = document.getElementById(checkboxId);
                                localStorage.setItem(checkboxId, checkbox.checked);
                            }

                            // Function to load checkbox state from localStorage
                            function loadCheckboxState(checkboxId) {
                                const checkbox = document.getElementById(checkboxId);
                                const savedState = localStorage.getItem(checkboxId);

                                if (savedState === 'true') {
                                    checkbox.checked = true;
                                } else {
                                    checkbox.checked = false;
                                }
                            }

                            // Load checkbox states on page load
                            loadCheckboxState('flexCheckDefault');
                            loadCheckboxState('flexCheckChecked');
                        </script>
                        <div class="text-right mt-2">
                            <button type="button" class="btn btn-secondary" id="backToEmployement"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #7d7d7d; color: white;">Previous</button>

                            <button type="button" class="btn btn-success" id="openPreviewBtn"
                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #42a81c; color: white;"
                                onclick="showPreviewModal()">
                                Done
                            </button>

                            <!-- Preview Modal -->
                            <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <!-- Adjusted modal width to modal-lg -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="previewFormContent" style="text-align: left;">
                                            <!-- Content will be dynamically populated here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" id="openModalBtn"
                                                style="font-family: Georgia, serif; font-size: 13px; width: 65px; padding: 5px 10px; border-radius: 5px; background-color: #4CAF50; color: white;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function showPreviewModal() {
                                    // Get form values using form ID
                                    var formValues = $('#job-form').serializeArray();

                                    // Filter out unwanted fields (e.g., token and vacancy_id)
                                    formValues = formValues.filter(function(field) {
                                        return field.name !== '_token' && field.name !== 'vacancy_id';
                                    });

                                    // Generate HTML content for preview
                                    var previewContent = '<ul>';
                                    $.each(formValues, function(index, field) {
                                        previewContent += '<li><strong>' + field.name + ':</strong> ' + field.value + '</li>';
                                    });
                                    previewContent += '</ul>';

                                    // Include document files
                                    var fileInputs = $('#job-form :file');
                                    fileInputs.each(function() {
                                        var file = this.files[0];
                                        if (file) {
                                            // Display file name and add a link to view/download the file
                                            previewContent += '<p><strong>' + $(this).attr('name') + ':</strong> <a href="' + URL
                                                .createObjectURL(file) + '" target="_blank">' + file.name + '</a></p>';
                                        }
                                    });

                                    // Set the preview content in the modal
                                    $('#previewFormContent').html(previewContent);

                                    // Show the modal
                                    $('#previewModal').modal('show');
                                }
                            </script>

                        </div>

                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="disclaimerModal" tabindex="-1" role="dialog"
                    aria-labelledby="disclaimerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content" style="background-color: #ccc;"> <!-- Set background color to gray -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="disclaimerModalLabel"
                                    style="font-family: 'Georgia, serif; font-weight: bold;">Affirmation</h5>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your disclaimer content here -->
                                {{-- <h5>Affirmation</h5> --}}
                                <ul style="font-family: 'Georgia, serif; font-size: 14px;">
                                    <li> Not Convicted of a criminal offence</li>
                                    <li> Not Terminated or compulsorily retired from any agency except in case
                                        of insolvency</li>
                                    <li> Not Adjudged medically unfit for employment by a registered medical
                                        practitioner</li>
                                </ul>
                                <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="agreeCheckbox">
                                    <label class="form-check-label"
                                        style="font-family: 'Georgia, serif; font-size: 18px; margin-left: 5px;"
                                        for="agreeCheckbox">
                                        I certify that my answers are true and complete to the best of my
                                        knowledge, and I have not furnished fake/forged testimonials/documents.
                                    </label>
                                </div>
                                <p style="font-family: 'Georgia, serif; font-size: 18px; margin-top: 10px;">
                                    If this application leads to employment, I understand that false or
                                    misleading information in my application or interview may result in my
                                    release.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary d-none" id="submitForm">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '{{ session('title') }}',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('vacancy') }}";
                    }
                });
            });
        </script>
    @endif
    </div>
    <br>
    <script>
        $(document).ready(function() {
            $("#openModalBtn").click(function() {
                $("#disclaimerModal").modal("show");
            });
        });
    </script>
    {{-- script for submit buttom --}}
    <script>
        $("#agreeCheckbox").change(function() {
            if ($(this).is(":checked")) {
                $("#submitForm").removeClass("d-none");
            } else {
                $("#submitForm").addClass("d-none");
            }
        });
    </script>
    <!-- script for adding new row in exprience-->
    <script>
        $(function() {
            // Update date picker for new rows
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });

            $("#insertRowExp").on("click", function(event) {
                event.preventDefault();

                var newRow = $("<tr>");
                var cols = '';
                cols +=
                    '<td><input class="form-control rounded-4" type="text" name="company[]" placeholder="Company"></td>';
                cols +=
                    '<td><input class="form-control rounded-4" type="text" name="position[]" placeholder="Position"></td>';
                cols +=
                    '<td><input class="form-control rounded-4 datepicker" type="text" name="from[]" placeholder="From"></td>';
                cols +=
                    '<td><input class="form-control rounded-4 datepicker" type="text" name="to[]" placeholder="To"></td>';
                cols +=
                    '<td><input class="form-control rounded-4" type="text" name="place[]" placeholder="Place"></td>';
                // cols +=
                //     '<td><input class="form-control rounded-4" type="text" name="reason[]" placeholder="Reason to Change"></td>';
                cols += '<td><input type="file" class="form-control-file" name="document[]"></td>';
                cols +=
                    '<td><button class="btn btn-danger btn-sm del-Exp"><i class="fas fa-trash"></i></button</td>';
                newRow.append(cols);
                $("#experienceTable").append(newRow);

                // Update date picker for new rows
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
            });
            // Remove row when delete btn is clicked
            $("table").on("click", ".del-Exp", function(event) {
                $(this).closest("tr").remove();
            });
        });
    </script>
    <!-- script for adding new row in training-->
    <script>
        $(function() {
            // Update date picker for new rows
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
            $("#addTraining").on("click", function(event) {
                event.preventDefault();

                var newRow = $("<tr>");
                var cols = '';
                cols +=
                    '<td><input class="form-control rounded-4" type="text" name="training[]" placeholder="Training"></td>';
                cols +=
                    '<td><input class="form-control rounded-4" type="text" name="country[]" placeholder="Country"></td>';
                cols +=
                    '<td><input class="form-control rounded-4 datepicker" type="text" name="sdate[]" placeholder="start date"></td>'; // Change "period" to "from_period"
                cols +=
                    '<td><input class="form-control rounded-4 datepicker" type="text" name="edate[]" placeholder="end date"></td>'; // Add "to_period" field
                cols += '<td><input type="file" class="form-control-file" name="certificates[]"></td>';
                cols +=
                    '<td><button class="btn btn-danger btn-sm del-training"><i class="fas fa-trash"></i></button</td>';
                // Insert the columns inside a row
                newRow.append(cols);
                $("#trainingTable").append(newRow);

                // Update date picker for new rows
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });


            });

            // Remove row when delete btn is clicked
            $("table").on("click", ".del-training", function(event) {
                $(this).closest("tr").remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // to check science radio by default
            $("#scienceRadio").prop("checked", true);
            var stream_val = $('input[name="stream"]:checked').val();
            if (stream_val == "S") {
                $('#com_div').hide();
                $('#eco_div').hide();
                $('#acc_div').hide();
                $('#geo_div').hide();
                $('#his_div').hide();
                $('#media_div').hide();
                $('#rigzhung_div').hide();
            }

            $("#dob").datepicker({
                dateFormat: "dd/mm/yy", // Set the desired date format
                changeMonth: true,
                changeYear: true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to check if the CID already exists
            function checkcid() {
                var cid = $('#cid').val();
                $.ajax({
                    url: '{{ route('checkcid') }}', // Replace with your route to check CID
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'cid': cid
                    },
                    success: function(response) {
                        if (response.status === 'duplicate') {
                            $('#cidHelpBlock').text('CID already exists').show();
                            $('#proceedButton').prop('disabled', true);
                        } else {
                            $('#cidHelpBlock').hide();
                            $('#proceedButton').prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // You can handle the error case here, such as displaying an alert message
                    }
                });
            }

            // Attach onchange event listener to the CID input field
            $('#cid').on('change', function() {
                checkcid();
            });

            // Proceed button click event
            $('#proceedButton').click(function() {
                if ($('#job-form').valid()) {
                    // Check CID before proceeding
                    checkcid();
                    // If CID is valid, proceed to the next tab
                    if (!$('#cidHelpBlock').is(':visible')) {
                        $('#education-tab').tab('show');
                    } else {
                        // Show a message indicating CID already exists
                        alert('CID already exists');
                    }
                }
            });
        });
    </script>


    <script>
        $('#backToEducation').click(function() {
            if ($('#job-form').valid()) {
                $('#education-tab').tab('show');
            }
        });

        $('#nextToEmployement').click(function() {
            if ($('#job-form').valid()) {
                $('#employement-tab').tab('show');
            }
        });

        $('#nextToTraining').click(function() {
            if ($('#job-form').valid()) {
                $('#training-tab').tab('show');
            }
        });

        $('#backToEmployement').click(function() {
            if ($('#job-form').valid()) {
                $('#employement-tab').tab('show');
            }
        });

        $('#backToApplicantInfo').click(function() {
            if ($('#job-form').valid()) {
                $('#home-tab').tab('show');
            }
        });
    </script>
    <script>
        // Add this script after your existing JavaScript code

        // Function to validate minimum qualification criteria and display message
        function validateQualificationCriteria() {
            try {
                var xPercentage = parseFloat($('#x_percentage').val()) || 0;
                var xiiPercentage = parseFloat($('#xii_percent').val()) || 0;
                var degreePercentage = parseFloat($('#degree_percentage').val()) || 0;
                var $minQualification = {{ $minQualification }};
                var message = '';

                // Check minimum qualification criteria
                if ($minQualification == 6 && xPercentage < 60) {
                    message += "You did not meet the minimum Class 10 marks requirement.\n";
                } else if ($minQualification == 5 && (xPercentage < 60 || xiiPercentage < 65)) {
                    message += "You did not meet the minimum Class 10 or Class 12 marks requirement.\n";
                } else if ($minQualification >= 1 && (xPercentage < 60 || xiiPercentage < 65 || degreePercentage < 70)) {
                    message += "You did not meet the minimum qualification criteria.\n";
                }

                // Display message if criteria not met
                if (message !== '') {
                    alert(message);
                }
            } catch (error) {
                console.error("Error in validateQualificationCriteria:", error);
            }
        }

        // Call the validation function on form submission
        $('#submitButton').on('click', function() {
            calculateFinalPercentage(); // Calculate final percentage
            validateQualificationCriteria(); // Validate qualification criteria
        });
    </script>
    {{-- script for marks calculation --}}
    <script>
        $(document).ready(function() {
            // Listen for changes in the input fields
            $('.xmark').on('input', function() {
                // Get the marks for English and all subjects
                var eng = parseFloat($('#eng').val()) || 0;
                var dzo = parseFloat($('#dzo').val()) || 0;
                var mat = parseFloat($('#mat').val()) || 0;
                var phy = parseFloat($('#phy').val()) || 0;
                var che = parseFloat($('#che').val()) || 0;
                var bio = parseFloat($('#bio').val()) || 0;
                var eco = parseFloat($('#eco').val()) || 0;
                var his = parseFloat($('#his').val()) || 0;
                var geo = parseFloat($('#geo').val()) || 0;
                var it = parseFloat($('#it').val()) || 0;
                var ent = parseFloat($('#ent').val()) || 0;
                var agfs = parseFloat($('#agfs').val()) || 0;


                // Sort the subject marks in descending order
                var subjects = [dzo, mat, phy, che, bio, eco, his, geo, it, ent, agfs];
                subjects.sort(function(a, b) {
                    return b - a;
                });

                // Calculate the total of the best four subjects
                var total = eng + subjects.slice(0, 4).reduce(function(a, b) {
                    return a + b;
                }, 0);

                // Calculate the percentage
                var percentage = (total / 500) * 100; // Assuming total marks for all subjects are 500

                // Set the calculated percentage in the 'percent' input field
                $('#x_percentage').val(percentage.toFixed(2)); // Rounded to two decimal places
            });
        });
    </script>
    <!--For class 12 science-->
    <script>
        $(document).ready(function() {
            // Listen for changes in the input fields
            $('.marks').on('input', function() {
                // Get the marks for English and all subjects
                var eng = parseFloat($('#xii_eng').val()) || 0;
                var dzo = parseFloat($('#xii_dzo').val()) || 0;
                var mat = parseFloat($('#xii_mat').val()) || 0;
                var phy = parseFloat($('#xii_phy').val()) || 0;
                var che = parseFloat($('#xii_che').val()) || 0;
                var bio = parseFloat($('#xii_bio').val()) || 0;
                var it = parseFloat($('#xii_it').val()) || 0;
                var geo = parseFloat($('#xii_geo').val()) || 0;
                var his = parseFloat($('#xii_his').val()) || 0;
                var com = parseFloat($('#xii_com').val()) || 0;
                var acc = parseFloat($('#xii_acc').val()) || 0;
                var eco = parseFloat($('#xii_eco').val()) || 0;
                var media = parseFloat($('#xii_media').val()) || 0;
                var rigzhung = parseFloat($('#xii_rigzhung').val()) || 0;

                var stream_val = $('input[name="stream"]:checked').val();
                if (stream_val == 'S') {
                    // Sort the subject marks in descending order
                    var subjects = [dzo, mat, phy, che, bio, it];
                } else if (stream_val == 'C') {
                    var subjects = [dzo, mat, com, eco, acc, it];
                } else {
                    var subjects = [dzo, mat, geo, his, eco, it, media, rigzhung];
                }

                subjects.sort(function(a, b) {
                    return b - a;
                });

                // Calculate the total of the best four subjects
                var total = eng + subjects.slice(0, 3).reduce(function(a, b) {
                    return a + b;
                }, 0);

                // Calculate the percentage
                var percentage = (total / 400) * 100; // Assuming total marks for all subjects are 500

                // Set the calculated percentage in the 'scipercent' input field
                $('#xii_percent').val(percentage.toFixed(2)); // Rounded to two decimal places
            });
        });
    </script>
    <script>
        function calculateFinalPercentage() {
            try {
                var xPercentage = parseFloat($('#x_percentage').val()) || 0;
                var xiiPercentage = parseFloat($('#xii_percent').val()) || 0;
                var degreePercentage = parseFloat($('#degree_percentage').val()) || 0;
                var $minQualification = {{ $minQualification }};
                var finalScore = 0;

                if ($minQualification == 6) {
                    finalScore = 1.0 * xPercentage;
                } else if ($minQualification == 5) {
                    finalScore = 0.5 * xPercentage + 0.5 * xiiPercentage;
                } else {
                    // Fix: remove var keyword to update the existing finalScore variable
                    finalScore = 0.3 * xPercentage + 0.3 * xiiPercentage + 0.4 * degreePercentage;
                }

                // Display the final score
                $('#final_score').val(finalScore.toFixed(2));
            } catch (error) {
                console.error("Error in calculateFinalPercentage:", error);
            }
        }
        // Event listener for input changes
        $('.xmark, .marks, #degree_percentage').on('change', calculateFinalPercentage);
    </script>
    {{-- </div> --}}

    <script>
        // Function to check if all required fields in the Applicant Information tab are filled
        function areFieldsFilled() {
            var fields = document.querySelectorAll('#home [required]');
            for (var i = 0; i < fields.length; i++) {
                if (fields[i].value.trim() === '') {
                    return false;
                }
            }
            return true;
        }

        // Function to enable or disable the tabs based on whether the fields are filled
        function toggleTabs() {
            var tabs = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
            tabs.forEach(function(tab) {
                var tabId = tab.getAttribute('aria-controls');
                if (tabId === 'home') return; // Skip the Applicant Information tab
                if (areFieldsFilled()) {
                    tab.removeAttribute('disabled');
                } else {
                    tab.setAttribute('disabled', 'disabled');
                }
            });
        }

        // Add event listener for changes in the Applicant Information tab
        var homeTab = document.querySelector('#home-tab');
        homeTab.addEventListener('click', function() {
            // Toggle the other tabs when the Applicant Information tab is clicked
            toggleTabs();
        });

        // Initialize tab status
        toggleTabs();
    </script>
    <script>
        document.getElementById('cid').addEventListener('input', function() {
            var cidInput = this.value;
            var cidHelpBlock = document.getElementById('cidHelpBlock');

            if (cidInput.length < 11) {
                cidHelpBlock.style.display = 'block';
            } else {
                cidHelpBlock.style.display = 'none';
            }
        });
    </script>
@endsection
