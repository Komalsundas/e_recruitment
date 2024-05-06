@extends('layouts.app2')
@section('content')
    <html lang="en">
 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>
    <body>
        <div class="div1">
            {{-- <h2>Applicant Information</h2> --}}

            <div class="row">
                <div class="col-md-12">
                    @if ($applicant && count($applicant) > 0)
                        <table border="1" id="show_can" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>CID</th>
                                    <th>Contact</th>
                                    <th>Position</th>
                                    <th>Course</th>
                                    <th>Email</th>
                                    <th>Class X %</th>
                                    <th>Class XII %</th>
                                    <th>Degree %</th>
                                    <th>Final Score</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applicant as $app)
                                    <tr>
                                        <td>{{ $app->name }}</td>
                                        <td>{{ $app->cid }}</td>
                                        <td>{{ $app->contact }}</td>
                                        <td>{{ $app->position }}</td>
                                        <td>
                                            <!-- Add a loop to display the course name -->
                                            @foreach ($education as $edu)
                                                @if ($edu->applicant_id == $app->id && $edu->grade == 15)
                                                    {{ $edu->course_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $app->email }}</td>
                                        <td>{{ $app->x_percentage }}</td>
                                        <td>{{ $app->xii_percent }}</td>
                                        <td>{{ $app->degree_percentage }}</td>
                                        <td>{{ $app->final_score }}</td>
                                        <td>
                                            @if ($app->shortlisted)
                                                Shortlisted
                                            @else
                                                Pending
                                            @endif

                                        </td>
                                        <td>
                                            <style>
                                                /* Override button width */
                                                .btn-sm {
                                                    width: 95px;
                                                    /* Reset width */
                                                }
                                            </style>

                                            <div class="d-flex">
                                                <div class="mr-2">
                                                    <button type="button" class="btn btn-success btn-sm" value="1"
                                                        name='flag'>
                                                        <i class="far fa-edit"></i>
                                                        <a href="{{ route('view-candidate', $app->id) }}"
                                                            style="color: white; text-decoration: none;">View</a>
                                                    </button>
                                                </div>
                                                @if (!$app->shortlisted)
                                                    <!-- Check if the applicant is not shortlisted -->
                                                    <form method="POST" action="{{ route('shortlist', $app->id) }}"
                                                        id="shortlistForm{{ $app->id }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm shortlist-btn"
                                                            value="1" name='flag'
                                                            data-applicant-id="{{ $app->id }}">
                                                            <i class="far fa-edit"></i> Shortlist
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Display a checkmark or a new line for shortlisted candidates -->
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-success mr-1">&#10003;</span> Shortlisted
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-4" id="excel_button_wrapper"></div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center"> <!-- Adjust col-md-* according to your layout -->
                                <form method="POST" action="{{ route('complete-assessment') }}"
                                    id="completeAssessmentForm">
                                    @csrf
                                    <input type="hidden" name="vacancy_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-success">Assessment Complete</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mt-4" role="alert">
                            <h4 class="alert-heading">No Applicants Yet!</h4>
                            <p class="mb-0">There are currently no applicants. Feel free to check back later or add new
                                applicants.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and Popper.js (Optional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>


        <script>
            $(document).ready(function() {

                var table = $('#show_can').DataTable({
                    dom: 'Bfrtip', // Add Buttons to the DOM
                    buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export as excel',
                        className: 'btn btn-success', // Apply Bootstrap styling
                        title: 'Candidates'
                    }],
                    order: [
                        [8, 'desc']
                    ] // Assuming 'final_score' is the 6th column (index 5)
                });

                // Manually move the button below the table
                $('#excel_button_wrapper').append($('.dt-buttons'));

                // Add click event listener to the assessment complete button
                $('#completeAssessmentForm').submit(function(event) {
                    event.preventDefault(); // Prevent default form submission
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Once completed, you will not be able to undo this action!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, complete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user clicks Yes, submit the form
                            this.submit();
                        } else if (
                            // Read more about handling dismissals below
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            Swal.fire(
                                'Cancelled',
                                'Your assessment completion has been cancelled :)',
                                'error'
                            )
                        }
                    });
                });

                // Add click event listener to the Shortlist buttons
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
            });
        </script>
        <!-- Add this script at the bottom of your blade file, before the closing </body> tag -->
        <div><br><br><br></div>
    </body>

    </html>
@endsection
