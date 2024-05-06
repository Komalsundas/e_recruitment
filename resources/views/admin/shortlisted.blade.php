@extends('layouts.app2')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-recruitment</title>
    <!-- CSS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<!--Content-->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="content">
                        </section>
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <h3 class="text-center">Shortlisted Candidate</h3><br>
                                <div class="container">
                                    @if (count($vacancies) > 0)
                                        <div class="row">
                                            @foreach ($vacancies as $vacancy)
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $vacancy->position }}</h5>
                                                            <p class="card-text">Slots: {{ $vacancy->slot }}</p>
                                                            <a href="{{ route('viewshortlisted', $vacancy->id) }}"
                                                                class="btn btn-primary">Shortlisted Candidates</a>
                                                            <br>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPanelModal{{ $vacancy->id }}">
                                                                Add Panel
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="addPanelModal{{ $vacancy->id }}" tabindex="-1" role="dialog" aria-labelledby="addPanelModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="addPanelModalLabel">Add Panel</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Your panel registration form goes here -->
                                                                            <form action="{{ route('addPanel') }}" method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
                                                                                <div class="form-group">
                                                                                    <label for="name{{ $vacancy->id }}">Name</label>
                                                                                    <input type="text" class="form-control" id="name{{ $vacancy->id }}" name="name" placeholder="Enter Name" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="email{{ $vacancy->id }}">Email</label>
                                                                                    <input type="email" class="form-control" id="email{{ $vacancy->id }}" name="email" placeholder="Enter Email" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="panel_contact{{ $vacancy->id }}">Panel Contact</label>
                                                                                    <input type="text" class="form-control" id="panel_contact{{ $vacancy->id }}" name="panel_contact" placeholder="Enter Panel Contact" required>
                                                                                </div>
                                                                                <!-- Add more fields as needed -->
                                                                                <button type="submit" class="btn btn-primary">Add Panel</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <hr>
                                                            <!-- Display Panels -->
                                                            {{-- <h5>Panels:</h5>
                                                            <ul>
                                                                @foreach($vacancy->panels as $panel)
                                                                <li>{{ $panel->username }}</li>
                                                                @endforeach
                                                            </ul> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No Shortlisted.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</body>

</html>
