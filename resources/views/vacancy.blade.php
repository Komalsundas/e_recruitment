@extends('layouts.app2')
{{-- This is my new changes --}}
<div class="div1 text-center">
    <div class="row no-gutters">
        <div class="col-md-12">
            <b>
                <p>Vacancy Announcement</p>
            </b>
            <p>Bhutan Telecom Limited is pleased to announce vacancies as listed below for immediate recruitment and
                appointment.</p>
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
                            <td>{{$vacancy->minQualification}}</td>
                            <td>{{$vacancy->remuneration}}</td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm" value="1" name="flag">
                                    <i class="far fa-edit"></i>
                                    <a href="{{ route('form') }}" style="color: white; text-decoration: none;">Apply</a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>