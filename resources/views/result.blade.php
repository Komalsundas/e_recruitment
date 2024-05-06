@extends('layouts.app2')
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BTL_eRecruitment</title>
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
                                
                                    <h3 class="text-center">Results</h3><br>
                                
                                <div class="container">
                                    @if(!is_null($vacancies) && count($vacancies) > 0)
    <div class="row">
        @foreach($vacancies as $vacancy)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vacancy->position }}</h5>
                        <p class="card-text">Slots: {{ $vacancy->slot }}</p>
                        <a href="{{ route('viewresult', $vacancy->id) }}" class="btn btn-primary">Candidates</a> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No candidates available.</p>
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