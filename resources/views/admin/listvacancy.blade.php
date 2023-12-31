@extends('layouts.app2')

@section('content')
<div class="div1"></div>
<div class="row no-gutters">
    <div class="col-md-12 ">
        <b>
            <p class="text-center">Vacancy List</p>
        </b>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Position</th>
                        <th scope="col">Slots</th>
                        <th scope="col">Minimum Qualification</th>
                        <th scope="col">Remuneration</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($vacancies as $vacancy)
                    <tr>
                        <th scope="row">{{$vacancy->id}}</th>
                        <td>{{$vacancy->position}}</td>
                        <td>{{$vacancy->slot}}</td>
                        <td>{{$vacancy->qualification}} in {{$vacancy->course}}</td>
                        <td>{{$vacancy->remuneration}}
                        <td>

                            <button type="button" class="btn btn-success btn-sm" value="1" name='flag'>
                                <i class="far fa-edit"></i>
                                <a href="{{ route('view-vacancy', $vacancy->id) }}"
                                    style="color: white; text-decoration: none;">Edit</a>
                            </button>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection