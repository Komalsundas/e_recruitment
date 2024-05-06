@extends('layouts.app2')
@section('content')
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    </head>

    <body>
        <div class="div1">
            <div class="row">
                <div class="col-md-12">
                    @if ($shortlistedCandidates && count($shortlistedCandidates) > 0)
                        <table border="1" id="shortlisted_can" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    @auth
                                        <th class="text-white">Name</th>
                                    @endauth
                                    <th class="text-white">CID</th>
                                    @auth
                                        <th class="text-white">Contact</th>
                                    @endauth
                                    <th class="text-white">Position</th>
                                    <th class="text-white">Status</th> <!-- Status column -->
                                    @auth
                                        <th class="text-white">Email</th>
                                    @endauth
                                    <th class="text-white">Actions</th> <!-- Add Actions column -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shortlistedCandidates as $app)
                                    <tr>
                                        @auth
                                            <td>{{ isset($app->name) ? $app->name : 'N/A' }}</td>
                                        @endauth
                                        <td>{{ $app->cid }}</td>
                                        @auth
                                            <td>{{ isset($app->contact) ? $app->contact : 'N/A' }}</td>
                                        @endauth
                                        <td>{{ $app->position }}</td>
                                        <td>
                                            @if ($app->shortlisted)
                                                Shortlisted
                                            @else
                                                Pending
                                            @endif
                                        </td>
                                        @auth
                                            <td>{{ isset($app->email) ? $app->email : 'N/A' }}</td>
                                        @endauth
                                        <td class="d-flex align-items-center">
                                            @if (!$app->selected)
                                            <!-- Check if the applicant is not selected -->
                                            <form id="select-form-{{ $app->id }}" method="POST" action="{{ route('select', $app->id) }}">
                                                @csrf
                                                <button type="button" class="btn btn-primary btn-sm select-btn mr-2"
                                                    onclick="confirmSelect({{ $app->id }})">
                                                    <i class="far fa-edit"></i> Select
                                                </button>
                                            </form>
                                            <div id="selected-message-{{ $app->id }}" class="d-none align-items-center mr-2">
                                                <span class="text-success mr-1">&#10003;</span> Selected
                                            </div>
                                        @else
                                            <!-- Display "Selected" for already selected candidates -->
                                            <div id="selected-message-{{ $app->id }}" class="d-flex align-items-center mr-2">
                                                <span class="text-success mr-1">&#10003;</span> Selected
                                            </div>
                                        @endif
                                        
                                        <!-- Standby button -->
                                        @if (!$app->standby)
                                            <form id="standby-form-{{ $app->id }}" method="POST" action="{{ route('standby', $app->id) }}">
                                                @csrf
                                                <button type="button" class="btn btn-warning btn-sm standby-btn"
                                                    onclick="confirmStandby({{ $app->id }})">
                                                    <i class="far fa-clock"></i> Standby
                                                </button>
                                                <div id="standby-message-{{ $app->id }}" class="d-none align-items-center mr-2">
                                                    <span class="text-warning mr-1">&#10003;</span> Standby
                                                </div>
                                            </form>
                                        @else
                                            <!-- Display "Standby" message for already standby candidates -->
                                            <div id="standby-message-{{ $app->id }}" class="d-flex align-items-center mr-2">
                                                <span class="text-warning mr-1">&#10003;</span> Standby
                                            </div>
                                        @endif
                                        

                                            <style>
                                                .view-btn-small {
                                                    padding: 0.25rem 0.5rem;
                                                    /* Adjust padding to make the button smaller */
                                                    font-size: 0.75rem;
                                                    /* Adjust font size to make the text smaller */
                                                    width: 80px;
                                                    /* Adjust width as needed */
                                                }
                                            </style>

                                            <!-- View button with smaller size -->
                                            {{-- <button class="btn btn-info btn-sm view-btn-small ml-2">
                                                <i class="far fa-eye"></i> View
                                            </button> --}}
                                        </td>

                                        <script>
                                            function confirmSelect(id) {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: 'Do you want to select this candidate?',
                                                    icon: 'question',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Yes, select!',
                                                    cancelButtonText: 'No, cancel!',
                                                    reverseButtons: true
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // If user clicks Yes, submit the select form
                                                        document.getElementById('select-form-' + id).submit();
                                                    }
                                                });
                                            }
                                        
                                            function confirmStandby(id) {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: 'Do you want to put this candidate on standby?',
                                                    icon: 'question',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Yes, standby!',
                                                    cancelButtonText: 'No, cancel!',
                                                    reverseButtons: true
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // If user clicks Yes, submit the standby form
                                                        document.getElementById('standby-form-' + id).submit();
                                                    }
                                                });
                                            }
                                        
                                            // After form submission, update UI to display messages
                                            document.addEventListener('DOMContentLoaded', function () {
                                                @foreach ($shortlistedCandidates as $app)
                                                    @if ($app->selected)
                                                        document.getElementById('select-form-{{ $app->id }}').classList.add('d-none');
                                                        document.getElementById('selected-message-{{ $app->id }}').classList.remove('d-none');
                                                    @endif
                                                    @if ($app->standby)
                                                        document.getElementById('standby-form-{{ $app->id }}').classList.add('d-none');
                                                        document.getElementById('standby-message-{{ $app->id }}').classList.remove('d-none');
                                                    @endif
                                                @endforeach
                                            });
                                        </script>
                                        

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @auth
                            <div class="mt-4" id="excel_button_wrapper">
                                <!-- Show the export button only if the user is logged in -->
                                {{-- <button id="excel_button" class="btn btn-success">Exportt as Excel</button> --}}
                            </div>
                        @endauth
                    @else
                        <div class="alert alert-info mt-4" role="alert">
                            <h4 class="alert-heading">No Shortlisted Candidates Yet!</h4>
                            <p class="mb-0">It looks like there are no candidates shortlisted for this position at the
                                moment. Check back later or consider adding new candidates to the shortlist.</p>
                        </div>
                    @endif
                </div>
                <br>
                {{-- <div style="text-align: center;">
                    <a href="{{ route('updateresult', [$app->id]) }}" class="btn btn-primary">Update Result</a>
                </div> --}}
                
                <div style="text-align: center;">
                    <button class="btn btn-primary" onclick="confirmUpdateResult('{{ route('updateresult', [$app->id]) }}')">Update Result</button>
                </div>
                
                
            </div>
        </div>


        <!-- DataTables JS, Buttons JS, and their dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                @auth
                // Initialize DataTables and add the export button if the user is logged in
                var table = $('#shortlisted_can').DataTable({
                    dom: 'Bfrtip', // Add Buttons to the DOM
                    buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export as Excel',
                        className: 'btn btn-success', // Apply Bootstrap styling
                        title: 'Shortlisted Candidates'
                    }]
                });

                // Manually move the button below the table
                $('#excel_button_wrapper').append($('.dt-buttons'));
            @endauth
            });
        </script>
        <script>
    function confirmUpdateResult(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update the result?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

    </body>

    </html>
@endsection
