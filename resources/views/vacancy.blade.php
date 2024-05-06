@extends('layouts.app2')
@section('content')
<style>
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
</style>

<div class="div1">
    <div class="row no-gutters">
        <div class="col-md-12">
            @if($vacancies->isEmpty())
                <div class="alert alert-info mt-4" role="alert">
                    <h4 class="alert-heading">No Current Vacancy</h4>
                    <p class="mb-0">It looks like there are no vacancies available at the moment. Check back later or consider other opportunities.</p>
                </div>
            @else
                <b>
                    <p class="text-center"><b>Vacancy Announcement </b></p>
                </b>
                <p class="text-center">Bhutan Telecom Limited is pleased to announce vacancies as listed below for immediate
                    recruitment and
                    appointment.</p>
                <p class="text-center"><b>Candidates are allowed to apply for one post only  <span style="color: red;">*</span></b></p>
                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Position</th>
                                <th scope="col">Slots</th>
                                <th scope="col">Minimum Qualification</th>
                                <th scope="col">Remuneration</th>
                                <th scope="col">Employment Type</th>
                                <th scope="col">TOR</th>
                                <th scope="col" style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacancies as $vacancy)
                                <tr>
                                    {{-- <th scope="row">{{$vacancy->id}}</th> --}}
                                    <td>{{$vacancy->position}}</td>
                                    <td>{{$vacancy->slot}}</td>
                                    <td>{{$vacancy->qualification}}( in {{$vacancy->course}}), Minimum
                                        {{$vacancy->criteria}}</td>
                                    <td>{{$vacancy->remuneration}}</td>
                                    <td>{{$vacancy->employType}}</td>
                                    <td><i class="fa fa-download"></i>
                                        <a href="{{ asset('storage/'. $vacancy->tor) }}" target="_blank">TOR for {{$vacancy->position}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('form', $vacancy->id) }}" class="icon-button">
                                            <i class="icon far fa-edit"></i>
                                            Apply
                                        </a>
                                    </td>
                                    {{-- <td>
                                        <button type="submit" class="btn btn-success btn-sm" value="1" name="flag">
                                            <i class="far fa-edit"></i>
                                            <a href="{{ route('form') }}" style="color: white; text-decoration: none;">Apply</a>
                                        </button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
