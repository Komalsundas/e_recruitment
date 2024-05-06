@extends('layouts.app2')

@section('content')
    <div class="div1">
        @if (count($applicants) > 0)
            <table border="1" id="show_result" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        @auth
                        <th>Name</th>
                        @endauth
                        <th>CID</th>
                        <th>Position</th>
                        @auth
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Class X %</th>
                        <th>Class XII %</th>
                        <th>Degree %</th>
                        <th>Final Score</th>
                        @endauth
                        <th>Status</th>
                    </tr>
                </thead>  
                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr>
                            @auth
                            <td>{{ isset($applicant->name) ? $applicant->name : 'N/A' }}</td>
                            @endauth
                            <td>{{ $applicant->cid }}</td>
                            <td>{{ $applicant->position }}</td>
                            @auth
                            <td>{{ isset($applicant->contact) ? $applicant->contact : 'N/A' }}</td>
                            <td>{{ isset($applicant->email) ? $applicant->email : 'N/A' }}</td>
                            <td>{{ isset($applicant->x_percentage) ? $applicant->x_percentage : 'N/A' }}</td>
                            <td>{{ isset($applicant->xii_percent) ? $applicant->xii_percent : 'N/A' }}</td>
                            <td>{{ isset($applicant->degree_percentage) ? $applicant->degree_percentage : 'N/A' }}</td>
                            <td>{{ isset($applicant->final_score) ? $applicant->final_score : 'N/A' }}</td>
                            @endauth
                            <td>{{ $applicant->status }}</td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info mt-4" role="alert">
                <h4 class="alert-heading">No Applicants Yet!</h4>
                <p class="mb-0">There are currently no applicants. Feel free to check back later or add new applicants.</p>
            </div>
        @endif
    </div>
    <div>
        <br>
    </div>
@endsection
