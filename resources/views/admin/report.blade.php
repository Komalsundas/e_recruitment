@extends('layouts.app2')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>
</head>
<body>
    <div class="div1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Generate Report') }}</div>

                        <div class="card-body">
                            <form action="{{ route('generateReport') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="start_date">{{ __('Start Date') }}</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            value="{{ old('start_date') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_date">{{ __('End Date') }}</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            value="{{ old('end_date') }}">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Generate') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($allVacancies) && $allVacancies->isNotEmpty())
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="htmltable" class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Position') }}</th>
                                                <th>{{ __('Slots') }}</th>
                                                <th>{{ __('Total Applicants') }}</th>
                                                <th>{{ __('Terms of Reference') }}</th> <!-- Add this column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allVacancies as $vacancy)
                                                <tr>
                                                    <td>{{ $vacancy->position }}</td>
                                                    <td>{{ $vacancy->slot }}</td>
                                                    <td>{{ $vacancy->applicants_count }}</td>
                                                    <td>
                                                        @if ($vacancy->tor)
                                                            <a href="{{ asset('storage/'. $vacancy->tor) }}" target="_blank">View ToR</a>
                                                        @else
                                                            No ToR available
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="alert alert-info" role="alert">
                            {{ __('No vacancies available within the specified date range.') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Add an Export Button -->
    <div class="text-center mt-3">
        <button id="exporttable" class="btn btn-success">Export to Excel</button>
    </div>

    <script>
        $(function() {
            $("#exporttable").click(function(e){
                var table = $("#htmltable");
                if(table && table.length){
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        fileext: ".excel",
                        title: "Report",
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: false
                    });
                }
            });
        });
    </script>
    
</body>
</html>
@endsection
