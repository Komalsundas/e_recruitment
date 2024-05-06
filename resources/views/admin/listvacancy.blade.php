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
                            <th scope="col">Grade</th>
                            <th scope="col">ToR</th>
                            <th scope="col" style="text-align: center;">Action</th>

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <th scope="row">{{ $vacancy->id }}</th>
                                <td>{{ $vacancy->position }}</td>
                                <td>{{ $vacancy->slot }}</td>
                                <td>{{ $vacancy->qualification }} in {{ $vacancy->course }}</td>
                                <td>{{ $vacancy->remuneration }}
                                <td>{{ $vacancy->grade }}
                                    <td><i class="fa fa-download"></i>
                                        <a href="{{ asset('storage/'. $vacancy->tor) }}" target="_blank">TOR for {{$vacancy->position}}
                                        </a>
                                    </td>
                                    
                                <td style="text-align: center;">
                                    <div style="display: inline-block;">
                                        <button type="button" class="btn btn-success btn-sm" value="1" name='flag'>
                                            <i class="far fa-edit"></i>
                                            <a href="{{ route('view-vacancy', $vacancy->id) }}"
                                                style="color: white; text-decoration: none;">Edit</a>
                                        </button>
                                        <!-- Add the delete button here -->
                                        <form action="{{ route('delete-vacancy', $vacancy->id) }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection