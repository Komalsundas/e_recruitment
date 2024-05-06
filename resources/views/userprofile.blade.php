@extends('layouts.app2')
@section('content')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    </head>

    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- User Profile Card -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <!-- Display the user's profile picture here if available -->
                                    <img class="profile-user-img img-fluid"
                                        src="{{ asset('storage/' . $applicant->passport_photo) }}"
                                        alt="User profile picture" style="width: 45mm; height: 45mm; object-fit: cover;">
                                </div>
                                <br>
                                <p class="text-muted text-center">Basic Information</p>
                                <h4 class="profile-username text-center">{{ $applicant->name }}</h4>
                                <p class="text text-center">Post applied: {{ $applicant->position }}</p>
                                <hr>
                                <p class="text">CID: {{ $applicant->cid }}</p>
                                <p class="text">Mobile No: {{ $applicant->contact }}</p>
                                <p class="text">DOB: {{ $applicant->dob }}</p>
                                <p class="text">Gender: {{ $applicant->gender }}</p>
                                <p class="text">Email: {{ $applicant->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#education"
                                            data-toggle="tab">Education</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#training" data-toggle="tab">Training</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#employment"
                                            data-toggle="tab">Employment</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#documents"
                                            data-toggle="tab">Documents</a></li>
                                    <!-- Add a new tab for Remarks -->
                                    <li class="nav-item"><a class="nav-link" href="#remarks" data-toggle="tab">Remarks</a>
                                    </li>


                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="education">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="container" style="width: 130%; margin: 0 10%;">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="invoice p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-11 table-responsive">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Name of institute</th>
                                                                                    <th>Qualification</th>
                                                                                    <th>Course</th>
                                                                                    <th>Eng</th>
                                                                                    <th>Dzo</th>
                                                                                    <th>Mat</th>
                                                                                    <th>Phy</th>
                                                                                    <th>Che</th>
                                                                                    <th>Bio</th>
                                                                                    <th>IT</th>
                                                                                    <th>Eco</th>
                                                                                    <th>His</th>
                                                                                    <th>Geo</th>
                                                                                    <th>Com</th>
                                                                                    <th>Acc</th>
                                                                                    <th>Ent</th>
                                                                                    <th>Agfs</th>
                                                                                    <th>Media</th>
                                                                                    <th>Rigzhung</th>
                                                                                    <th>Aggregate</th>
                                                                                    <th>Certificate</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($education as $edu)
                                                                                    <tr>
                                                                                        <td>{{ $edu->institute }}</td>
                                                                                        @if ($edu->grade == 10)
                                                                                            <td>{{ 'Class X' }}</td>
                                                                                        @elseif($edu->grade == 12)
                                                                                            <td>{{ 'Class XII' }}</td>
                                                                                        @elseif($edu->grade == 15)
                                                                                            <td>{{ 'Bachelors Degree' }}
                                                                                            </td>
                                                                                        @endif
                                                                                        <td>{{ $edu->course_name }}</td>
                                                                                        <td>{{ $edu->eng }}</td>
                                                                                        <td>{{ $edu->dzo }}</td>
                                                                                        <td>{{ $edu->math }}</td>
                                                                                        <td>{{ $edu->phy }}</td>
                                                                                        <td>{{ $edu->che }}</td>
                                                                                        <td>{{ $edu->bio }}</td>
                                                                                        <td>{{ $edu->it }}</td>
                                                                                        <td>{{ $edu->eco }}</td>
                                                                                        <td>{{ $edu->his }}</td>
                                                                                        <td>{{ $edu->geo }}</td>
                                                                                        <td>{{ $edu->com }}</td>
                                                                                        <td>{{ $edu->acc }}</td>
                                                                                        <td>{{ $edu->ent }}</td>
                                                                                        <td>{{ $edu->agfs }}</td>
                                                                                        <td>{{ $edu->media }}</td>
                                                                                        <td>{{ $edu->rigzhung }}</td>
                                                                                        <td>{{ $edu->aggregate }}</td>
                                                                                        <td>
                                                                                            <a href="{{ asset('storage/' . $edu->marksheet) }}"
                                                                                                target="_blank">Marksheet</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Shortlist Button -->
                                                            @if (!$applicant->shortlisted)
                                                                <form method="POST"
                                                                    action="{{ route('shortlist', $applicant->id) }}"
                                                                    id="shortlistForm{{ $applicant->id }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm shortlist-btn"
                                                                        value="1" name='flag'
                                                                        data-applicant-id="{{ $applicant->id }}">
                                                                        <i class="far fa-edit"></i> Shortlist
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <br>
                                                            <form id="remarksForm"
                                                                action="{{ route('save-remarks', $applicant->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="remark">Add Remark:</label>
                                                                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Remark</button>
                                                            </form>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="training">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="container" style="width: 130%; margin: 0 10%;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="invoice p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-12 table-responsive">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Training Documents</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        @foreach ($trainings as $training)
                                                                                            <a href="{{ asset('storage/' . $training->certificates) }}"
                                                                                                target="_blank">View</a><br>
                                                                                        @endforeach
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="employment">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="container" style="width: 130%; margin: 0 10%;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="invoice p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-12 table-responsive">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Employment Documents</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        @foreach ($employments as $employment)
                                                                                            <a href="{{ asset('storage/' . $employment->document) }}"
                                                                                                target="_blank">View</a><br>
                                                                                        @endforeach
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add a new tab pane for Remarks -->
                                    <div class="tab-pane" id="remarks">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="container" style="width: 130%; margin: 0 -15%;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="invoice p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-12 table-responsive">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Remarks</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @forelse ($remarks as $remark)
                                                                                    <tr>
                                                                                        <td>{{ $remark->remark }}</td>
                                                                                    </tr>
                                                                                @empty
                                                                                    <tr>
                                                                                        <td>No remarks found</td>
                                                                                    </tr>
                                                                                @endforelse
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="documents">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="container" style="width: 130%; margin: 0 -15%;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="invoice p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-12 table-responsive">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Cover Letter</th>
                                                                                    <th>CID Copy</th>
                                                                                    <th>CV</th>
                                                                                    <th>MC</th>
                                                                                    <th>NOC</th>
                                                                                    {{-- <th>Training Certificate</th> --}}
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $applicant->coverletter) }}"
                                                                                            target="_blank">View</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $applicant->cidcopy) }}"
                                                                                            target="_blank">View</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $applicant->cv) }}"
                                                                                            target="_blank">View</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $applicant->mc) }}"
                                                                                            target="_blank">View</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $applicant->noc) }}"
                                                                                            target="_blank">View</a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Add a click event listener to the Shortlist buttons
        $('.shortlist-btn').click(function(event) {
            event.preventDefault(); // Prevent default form submission
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to shortlist this candidate?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, shortlist!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user clicks Yes, submit the shortlist form
                    var formId = $(this).closest('form').attr('id');
                    $('#' + formId).submit();
                    // Show success message after shortlisting
                    Swal.fire({
                        title: 'Success',
                        text: 'Shortlisted successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else if (
                    // Read more about handling dismissals below
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'Cancelled',
                        'Shortlisting cancelled :)',
                        'error'
                    )
                }
            });
        });
    </script>
    
    <div><br><br></div>
@endsection
