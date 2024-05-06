@extends('layouts.app2')
@section('content')
    <!-- Include the datepicker library CSS and JavaScript files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-TQVYFAdVlQTd5C5Vl9EJLlP6tVT+oJ9y" crossorigin="anonymous">

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-eMNCOFYrNE5a6BWPItzNBwyNXlZKCD4SIUibotznbkFxg3Dv1kob6tF5Al1VScQV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6XnHiBBjvqkOGmfCdu1JqownxDMG7Pbo" crossorigin="anonymous"></script>





    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#dateline").datepicker({
                dateFormat: "dd/mm/yy", // Set the desired date format
                changeMonth: true,
                changeYear: true,
            });
        });
    </script>

    <div class="div1"></div>
    <div class="container">
       
        <fieldset class="border p-2">
            <legend class="float-none w-auto p-2">Edit Vacancy</legend>

            <form action="{{ route('update-vacancy', ['id' => $vacancy->id]) }}" method="post" enctype="multipart/form-data">

                @csrf
                @if ($vacancy)
        <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
    {{-- @endif --}}
                    {{-- <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}"> --}}

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="position" class="form-label fw-bold small">Position</label>
                        <input type="text" class="form-control form-control-sm" name="position" id="position"
                            value="{{ $vacancy->position }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="minQuali" class="form-label fw-bold small">Minimum Qualification</label>
                        <select class="form-select form-select-sm form-control" name="minQuali" id="minQuali" required>
                            <option value="">Select Minimum Qualification</option>
                            @foreach ($minQuali as $res)
                                <option value="{{ $res->id }}"
                                    {{ $vacancy->minQualification == $res->id ? 'selected' : '' }}>{{ $res->qualification }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="course" class="form-label fw-bold small">Course Specific</label>
                        <textarea type="text" class="form-control form-control-sm" name="course" id="course" required>{{ $vacancy->course }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="criteria" class="form-label fw-bold small">Shortlisting Criteria</label>
                        <textarea type="text" class="form-control form-control-sm" name="criteria" id="criteria" required>{{ $vacancy->criteria }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="empType" class="form-label fw-bold small">Employment Type</label>
                        <select class="form-select form-select-sm form-control" name="empType" id="empType" required>
                            <option value="">Select Employment Type</option>
                            @foreach ($empType as $key)
                                <option value="{{ $key->id }}" {{ $vacancy->empType == $key->id ? 'selected' : '' }}>
                                    {{ $key->employType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="slot" class="form-label fw-bold small">Slots</label>
                        <input type="number" class="form-control form-control-sm" name="slot" id="slot"
                            value="{{ $vacancy->slot }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="remuneration" class="form-label fw-bold small">Remuneration</label>
                        <textarea type="text" class="form-control form-control-sm" name="remuneration" id="remuneration" required>{{ $vacancy->remuneration }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="grade" class="form-label fw-bold small">Grade</label>
                        <textarea type="text" class="form-control form-control-sm" name="grade" id="grade" required>{{ $vacancy->grade }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="dateline" class="form-label fw-bold small">Application Dateline</label>
                        <div class="input-group date">
                            <span class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control form-control-sm" name="dateline" id="dateline"
                                value="{{ $vacancy->dateline }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tor" class="form-label fw-bold small">TOR</label>
                        <input type="file" class="form-control" id="tor" name="tor" >
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn-success" id="submitBtn">Save</button>
                </div>
                @endif 
            </form>

            <br>
            <!-- Delete Button -->
            {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>

                        </div>
                    </div>
                </div>
            </div> --}}
            <script>
                $(document).ready(function () {
                    var rowToDelete;
            
                    // Show delete modal when delete button is clicked
                    $(".deleteRow").on("click", function () {
                        $("#deleteModal").modal("show");
            
                        // Get the row to be deleted (you might need to adjust this based on your HTML structure)
                        rowToDelete = $(this).closest("tr");
                    });
            
                    // Handle deletion on modal confirmation
                    $("#confirmDelete").on("click", function () {
                        // Show a success message (you might want to customize this)
                        alert("Deleted successfully");
            
                        // Explicitly submit the form for deletion
                        $("#deleteForm").submit();
            
                        // Optional: If you want to remove the row without waiting for the form submission
                        // rowToDelete.remove();
                        // $("#deleteModal").modal("hide");
                    });
                });
            </script>
            
    
            <form action="{{ route('delete-vacancy', $vacancy->id) }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger" id="deleteBtn" data-toggle="modal" data-target="#deleteModal">
                    Delete
                </button>
            </form>
            
            
            
        </fieldset>
    </div>
@endsection