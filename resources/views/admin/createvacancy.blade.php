@extends('layouts.app2')

@section('content')

<!--additional-->
<!-- Include Bootstrap CSS -->

<!-- Include jQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Include jQuery and jQuery UI JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Include timepicker-addon JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

<!-- Include the datepicker library CSS and JavaScript files -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        flatpickr('.datetime', {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});


        $('#minQuali').change(function() {
            var selectedQualification = $(this).val();
            if (selectedQualification === '1') { // If Class 10 is selected
                $('.class10textbox').show();
                $('.classxiitextbox').show();
                $('.degreetextbox').show();
            } else if (selectedQualification === '2') { // If Class XII is selected
                $('.class10textbox').show();
                $('.classxiitextbox').show();
                $('.degreetextbox').show();
            } else if (selectedQualification === '3') { // If Degree is selected
                $('.class10textbox').show();
                $('.classxiitextbox').show();
                $('.degreetextbox').show();
            } else if (selectedQualification === '4') { // If Degree is selected
                $('.class10textbox').show();
                $('.classxiitextbox').show();
                $('.degreetextbox').hide();
            } else if (selectedQualification === '5') { // If Degree is selected
                $('.class10textbox').show();
                $('.classxiitextbox').show();
                $('.degreetextbox').hide();
            } else if (selectedQualification === '6') { // If Degree is selected
                $('.class10textbox').show();
                $('.classxiitextbox').hide();
                $('.degreetextbox').hide();
            } else if (selectedQualification === '7') { // If Degree is selected
                $('.class10textbox').hide();
                $('.classxiitextbox').hide();
                $('.degreetextbox').hide();
            } else if (selectedQualification === '8') { // If Degree is selected
                $('.class10textbox').hide();
                $('.classxiitextbox').hide();
                $('.degreetextbox').hide();
            } else { // If no option selected or option other than above
                $('.class10textbox').hide();
                $('.classxiitextbox').hide();
                $('.degreetextbox').hide();
            }
        });
    });
</script>

<style>
    .form-control:focus {
        border: 2px solid var(--success) !important;
        box-shadow: unset !important;
    }
    
</style>

<div class="div1"></div>

<div class="col-md-8 mx-auto pb-5" style="margin-bottom: 88px;">

    <h3 class="display-6">Create Vacancy</h3>
    <div class="border border-success mt-2" style="width: 167px; border-width: 1.5px !important;"></div>

    <form action="{{ route('save-vacancy')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mt-4">
            <div class="col-md-6 mb-4">
                <label for="position" class="form-label fw-bold">Position</label>
                <input type="text" class="form-control form-control" name="position" id="position" required>
            </div>
            <div class="col-md-6 mb-4">
                <label for="minQuali" class="form-label fw-bold">Minimum Qualification</label>
                <select class="form-select form-select-sm form-control" name="minQuali" id="minQuali" required>
                    <option value="">Select Minimum Qualification</option>
                    @foreach($minQuali as $res)
                    <option value="{{$res->id}}">{{$res->qualification}}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-4 class10textbox" style="display: none;">
                        <label for="class10marks" class="form-label fw-bold">Class 10%</label>
                        <input type="text" class="form-control form-control" name="class10marks" id="class10marks">
                    </div>
                    <div class="col-md-4 classxiitextbox" style="display: none;">
                        <label for="class12marks" class="form-label fw-bold">Class 12%</label>
                        <input type="text" class="form-control form-control" name="class12marks" id="class12marks">
                    </div>
                    <div class="col-md-4 degreetextbox" style="display: none;">
                        <label for="degreemarks" class="form-label fw-bold">Degree/Diploma %</label>
                        <input type="text" class="form-control form-control" name="degreemarks" id="degreemarks">
                    </div>
                </div>
            </div>
            
        
            <div class="col-md-6 mb-4">
                <label for="course" class="form-label fw-bold">Course Specific</label>
                <textarea type="text" class="form-control form-control" name="course" id="course" required></textarea>
            </div>
        
            <div class="col-md-6 mb-4">
                <label for="empType" class="form-label fw-bold">Employment Type</label>
                <select class="form-select form-select-sm form-control" name="empType" id="empType" required>
                    <option value="">Select Employment Type</option>
                    @foreach($empType as $key)
                    <option value="{{$key->id}}">{{$key->employType}}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-6 mb-4">
                <label for="slot" class="form-label fw-bold">Slots</label>
                <input type="number" class="form-control form-control" name="slot" id="slot" required>
            </div>
        
            <div class="col-md-6 mb-4">
                <label for="remuneration" class="form-label fw-bold">Remuneration</label>
                <textarea type="text" class="form-control form-control" name="remuneration" id="remuneration" required></textarea>
            </div>
        
            <div class="col-md-6 mb-4">
                <label for="grade" class="form-label fw-bold">Grade</label>
                <textarea type="text" class="form-control form-control" name="grade" id="grade" required></textarea>
            </div>
        
            <div class="col-md-6">
                <div>
                    <x-input-label for="dateline" :value="__('Application Dateline')" class="form-label fw-bold small" />
                    <input id="dateline" name="dateline" type="text" class="datetime form-control mt-1 block w-full" required autocomplete="dateline">
                    <x-input-error class="mt-2" :messages="$errors->get('dateline')" />
                </div>
                
            </div>
        
            <div class="col-md-6 mb-4">
                <label for="tor" class="form-label fw-bold">TOR</label>
                <input type="file" class="form-control" id="tor" name="tor"  accept=".pdf" required>
            </div>
        
            <div class="col-md-2">
                <div class="text-right mt-2">
                    <label for="tor" class="form-label fw-bold"></label>
                    <button type="submit" class="btn btn-success px-5" style="width: unset; border-radius: 4px !important;" id="submitBtn">SAVE</button>
                </div>
            </div>
        </div>
        
        

    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '{{ session('title') }}',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = "{{ route('show-vacancy')}}";
                }
            });
        });
    </script>
    @endif
</div>
@endsection